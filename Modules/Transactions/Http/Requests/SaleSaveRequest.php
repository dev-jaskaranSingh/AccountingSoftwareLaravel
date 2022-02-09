<?php

namespace Modules\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class SaleSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $fromDate = authCompany()->from_date;
        $toDate = authCompany()->to_date;

        return [
            'account_id' => 'required',
            'bill_date' => 'required|after_or_equal:'.$fromDate.'|before_or_equal:'. $toDate,
            'bill_products' => 'required',
            'company_state_code' => '',
            'total_amount' => '',
            'total_discount' => '',
            'total_net_amount' => '',
            'cgst' => '',
            'sgst' => '',
            'igst' => '',
            'grand_total_amount' => '',
            'tcs' => '',
            'shipped_to' => '',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'account_id.required' => 'Party is required',
            'bill_date.required' => 'Bill date is required',
            'bill_date.after_or_equal' => 'Bill date should be greater than or equal to '.authCompany()->from_date,
            'bill_date.before_or_equal' => 'Bill date should be less than or equal to '.authCompany()->to_date,
            'bill_products.required' => 'Bill products are required',
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
