<?php
namespace App\Domains\Material\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:materials,name'
            ],
            'supplier_id' => [
                'required',
                'exists:suppliers,id'
            ],
            'sku' => [
                'required',
                'string',
                'max:50',
                'unique:materials,sku'
            ],
            'upc' => [
                'required',
                'string',
                'max:50',
                'unique:materials,upc'
            ],
            'category' => [
                'nullable',
                'string',
                'max:255'
            ],
            'image' => [
                'nullable',
                'string'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'min_stock' => [
                'nullable',
                'integer'
            ],
            'max_stock' => [
                'nullable',
                'integer'
            ],
            'stock_unit' => [
                'nullable',
                'string',
                'max:50'
            ],
            'width' => [
                'nullable',
                'numeric'
            ],
            'height' => [
                'nullable',
                'numeric'
            ],
            'depth' => [
                'nullable',
                'numeric'
            ],
            'dimension_unit' => [
                'nullable',
                'string',
                'max:50'
            ],
            'weight' => [
                'nullable',
                'numeric'
            ],
            'weight_unit' => [
                'nullable',
                'string',
                'max:50'
            ],
            'price' => [
                'required',
                'numeric',
                'string'
            ],
            'active' => [
                'nullable',
                'boolean'
            ],
            'taxable' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
