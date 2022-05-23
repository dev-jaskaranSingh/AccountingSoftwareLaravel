<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:companies,name',
            'address' => '',
            'email' => 'unique:companies,email',
            'db_name' => 'unique:companies',
            'website' => '',
            'mobile' => '',
            'phone' => '',
            'to_date' => 'required|date',
            'from_date' => 'required|date',
            'pan' => '',
            'gstin' => 'required|unique:companies,gstin',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'pincode' => '',
            'gst_state_code' => ''
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => 'Company is required.',
            'state_id.required' => 'State is required.',
            'city_id.required' => 'City is required.'
        ];
    }
}
