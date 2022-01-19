<?php

namespace Modules\Masters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemMasterSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:items_master,name',
            'unit_id' => 'required|integer|exists:units_master,id',
            'item_group_id' => 'required|integer|exists:items_group_master,id',
            'hsn_id' => 'required|integer|exists:hsn_master,id',
            'opening_balance' => 'numeric',
            'purchase_price' => 'numeric',
            'sale_price' => 'numeric',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Item Name is required',
            'name.string' => 'Item Name must be a string',
            'name.max' => 'Item Name must be less than 255 characters',
            'name.unique' => 'Item Name must be unique',
            'unit_id.required' => 'Unit is required',
            'unit_id.integer' => 'Unit must be an integer',
            'unit_id.exists' => 'Unit must be an existing unit',
            'item_group_id.required' => 'Item Group is required',
            'item_group_id.integer' => 'Item Group must be an integer',
            'item_group_id.exists' => 'Item Group must be an existing item group',
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
