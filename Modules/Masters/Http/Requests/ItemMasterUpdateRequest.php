<?php

namespace Modules\Masters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemMasterUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units_master,id',
            'item_group_id' => 'required|integer|exists:items_group_master,id',
            'hsn_id' => 'required|integer|exists:hsn_master,id',
            'opening_balance' => 'numeric',
            'purchase_price' => 'numeric',
            'sale_price' => 'numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Item Name is required',
            'unit_id.required' => 'Unit is required',
            'unit_id.exists' => 'Unit does not exists',
            'item_group_id.required' => 'Item Group is required',
            'item_group_id.exists' => 'Item Group does not exists',
            'hsn_id.required' => 'HSN is required',
            'hsn_id.integer' => 'HSN must be an integer',
            'hsn_id.exists' => 'HSN must be an existing HSN',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
