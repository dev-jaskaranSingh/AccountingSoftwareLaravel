<?php

namespace Modules\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class PurchaseSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
   {

       $fromDate = Session::get('company')->from_date;
       $toDate = Session::get('company')->to_date;
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