<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
         return [
                'name' => 'required|string|max:25',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:25|unique:users',
                'district_id' => 'required|integer', 
                'division_id' => 'required|integer', 
                'postal_code' => 'required|string', 
                'city_id' => 'nullable|integer',
                'image' => 'nullable|string',
                'address' => 'required'
         ];
    }
}
