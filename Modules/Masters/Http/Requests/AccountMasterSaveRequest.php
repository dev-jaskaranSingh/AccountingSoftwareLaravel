<?php

namespace Modules\Masters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountMasterSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:account_masters,name',
            'email' => 'email|required|unique:account_masters,email',
            'phone' => 'required|unique:account_masters,phone',
            'address' => 'required',
            'account_type' => 'required',
            'dealer_type' => '',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'country_id' => 'required|exists:countries,id',
            'pincode' => '',
            'gstin' => '',
            'pan' => '',
            'bank_name' => '',
            'branch_name' => '',
            'account_number' => '',
            'ifsc_code' => '',
            'account_holder_name' => '',
            'opening_balance' => '',
            'account_group_id' => 'required|exists:account_groups,id',
        ];
    }

    public function messages(){
        return [
            'city_id.required' => 'City is required',
            'state_id.required' => 'State is required',
            'country_id.required' => 'Country is required',
            'account_group.required' => 'Account Group is required',
            'account_group.exists' => 'Account Group is invalid',
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
