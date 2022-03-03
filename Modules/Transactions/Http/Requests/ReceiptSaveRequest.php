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
        return [
            'first_account_id' => 'required',
            'second_account_id' => 'required',
            'instr_type' => 'required',
            'instrument_no' => 'required',
            'instrument_date' => 'required',
            'amount' => 'required',
            'narration' => ''
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
