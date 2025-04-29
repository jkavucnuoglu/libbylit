<?php

namespace App\Domains\Supplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'tax_id' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:suppliers,email, ' . $this->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|array',
            'address.address_line_1' => 'required_if:address,not_null|string|max:255',
            'address.address_line_2' => 'nullable|string|max:255',
            'address.city' => 'required_if:address,not_null|string|max:100',
            'address.state' => 'required_if:address,not_null|string|max:100',
            'address.postal_code' => [
                'required_if:address,not_null',
                'regex:/^\d{5}(-\d{4})?$/',
            ],
            'address.country' => 'required_if:address,not_null|string|max:100',
            'url' => 'nullable|string|max:255',
        ];
    }
}
