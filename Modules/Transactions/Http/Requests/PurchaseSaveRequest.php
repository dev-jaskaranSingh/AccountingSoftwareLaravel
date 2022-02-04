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
       $dates = [Session::get('company')->to_date, Session::get('company')->from_date];
        return [
            'account_id' => 'required',
            'invoice_number' => 'required',
            'bill_date' => 'required',
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
