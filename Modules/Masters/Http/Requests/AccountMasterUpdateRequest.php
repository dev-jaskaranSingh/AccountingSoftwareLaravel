<?php

namespace Modules\Masters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountMasterUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
            'account_type' => 'required',
            'dealer_type' => 'required',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'country_id' => 'required|exists:countries,id',
            'pincode' => 'required',
            'gstin' => '',
            'pan' => '',
            'bank_name' => '',
            'branch_name' => '',
            'account_number' => '',
            'ifsc_code' => '',
            'account_holder_name' => '',
            'opening_balance' => 'required',
            'account_group_id' => 'required|exists:account_groups,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
