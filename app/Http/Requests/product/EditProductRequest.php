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
            'product_summary' => 'max:100',
            'product_description' => 'required',
            'link_url_shopee'=>'url|nullable',
            'link_url_tokopedia'=>'url|nullable',
            'status'=>'required',
            'image_path' => 'mimetypes:image/png,image/jpeg,image/svg|max:5120',
            'product_sale.weight' => 'required|numeric|between:0.01,99.99',
            'product_sale.cost' => 'required|numeric|between:1000,99999',
            'product_additional_info.*.label' => 'required',
            'product_additional_info.*.value' => 'required',
            'product_additional_info.*.mode' => 'required',
            'product_additional_info.*.id' => 'nullable',
        ];
    }
}
