<?php

namespace App\Http\Requests\API\newssubscribe;

use App\Http\Requests\API\BaseApiRequest;

class AddNewsSubscribeRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|required|unique:news_subscribes',
            'name'=>'string|max:256|nullable'
        ];
    }
}
