<?php

namespace App\Http\Requests\promotion;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromotionRequest extends FormRequest
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
            'promotion_title' => 'required|max:255',
            'promotion_description' => 'required|max:255',
            'promotion_url' => 'required|max:255',
            'status'=>'required',
            'promotion_image' => 'required|mimetypes:image/png,image/jpeg,image/svg|max:5120',
        ];
    }
}
