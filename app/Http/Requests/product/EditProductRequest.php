<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'product_name' => 'required|max:255',
            'product_description' => 'required',
            'link_url_shopee'=>'url',
            'link_url_tokopedia'=>'url',
            'status'=>'required',
            'image_path' => '|mimetypes:image/png,image/jpeg,image/svg|max:5120',

        ];
    }
}
