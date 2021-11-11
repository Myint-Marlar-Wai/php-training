<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|max:255',
            'image' => 'required|image',
            'phone_no' => 'required|numeric',
            'address' => 'required|max:255',
        ];
    }

    /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */

    public function messages()
    {
        return [
            'full_name.required' => 'Name is required',
            'image.required'  => 'Image is required',
            'phone_no.required'  => 'Phone Number is required',
            'address.required'  => 'Address is required',
        ];
    }
}
