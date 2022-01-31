<?php

namespace Modules\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'account_id' => 'required',
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'shipped_to' => 'required',
            'bill_products' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'account_id.required' => 'Party is required',
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
