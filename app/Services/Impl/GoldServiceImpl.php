<?php

namespace App\Services\Impl;

use App\Exceptions\BusinessException;
use App\Models\GoldPrice;
use App\Services\Contract\GoldService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class GoldServiceImpl implements GoldService 
{   
    private const ONE_TROY_OUNCE_TO_GRAM = 31.10;
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false ]);;
    }

    public function getGolds() {
        
    }

    public function fetchGoldPrice() {
        try {
            $response = $this->client->get(config('gold.url'));
            $body = $response->getBody();
            $data = json_decode($body);
            $newGold['goldPriceIDR'] = $data->items[0]->xauPrice;
            $newGold['goldPriceUSD'] = $data->items[1]->xauPrice;
            $newGold['goldPriceIDRGram']= $newGold['goldPriceIDR'] / self::ONE_TROY_OUNCE_TO_GRAM;

            $gold = new GoldPrice();
            $gold->fill($newGold);
            $gold->save();
        
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
                $statusCode = $response->getStatusCode();

                $message = $statusCode . $response . $body;
                throw new BusinessException( $message, $e);
            } else {
                throw new BusinessException("Failed get request from gold api", $e);
            }
        } catch (\Exception $e) {
            Log::debug($e);
            // Handle any other type of exception
            throw new BusinessException("Failed fetch gold api", $e);
        }
    }
}
