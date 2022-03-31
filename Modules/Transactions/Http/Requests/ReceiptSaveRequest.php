<?php

namespace Modules\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ReceiptSaveRequest extends FormRequest
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
            'first_account_id' => 'required',
            'second_account_id' => 'required',
            'date' => 'required',
            'instr_type' => 'required',
            'instrument_no' => '',
            'instrument_date' => 'required|after_or_equal:'.$fromDate.'|before_or_equal:'. $toDate,
            'amount' => 'required',
            'narration' => ''
        ];
    }


    public function messages()
    {
        return [
            'first_account_id.required' => 'Bank/Cash Account is required',
            'second_account_id.required' => 'Received From is required',
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
