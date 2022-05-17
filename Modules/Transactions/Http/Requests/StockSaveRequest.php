<?php

namespace Modules\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class StockSaveRequest extends FormRequest
{
    private mixed $account_id;

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
            'purchase_date' => 'required|after_or_equal:'.$fromDate.'|before_or_equal:'. $toDate,
            'bill_products' => 'required',
            'invoice_number' => 'required',
            'company_state_code' => '',
            'total_amount' => '',
            'total_discount' => '',
            'total_net_amount' => '',
            'cgst' => '',
            'sgst' => '',
            'igst' => '',
            'tcs' => '',
            'round_off_type' => '',
            'round_off_value' => '',
            'grand_total_amount' => '',
            'party_name' => '',
            'address' => '',
            'address2' => '',
            'country_id' => '',
            'state_id' => '',
            'city_id' => '',
            'pin_code' => '',
            'gstin' => '',
            'mobile' => ''
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
