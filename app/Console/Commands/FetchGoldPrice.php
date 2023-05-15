<?php

namespace App\Console\Commands;

use App\Exceptions\BusinessException;
use App\Services\Contract\GoldService;
use Illuminate\Console\Command;

class FetchGoldPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:gold-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch gold price';

    protected $goldService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GoldService $goldService)
    {   
        $this->goldService = $goldService;
        parent::__construct();
    }


    public function handle()
    {
        $this->info('Start Fetching Gold');
        try {
            $this->goldService->fetchGoldPrice();
            $this->info('Complete fetching Gold');
        } catch(BusinessException $e) {
            $this->info($e->getMessage());
        } finally {
            $this->info('Finish Fetching Gold');
        }
    }
}
