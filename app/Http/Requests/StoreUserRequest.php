<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->role->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /*
         * Regular Expression for indian phone number
            ^       #Match the beginning of the string
            [6789]  #Match a 6, 7, 8 or 9
            \d      #Match a digit (0-9 and anything else that is a "digit" in the regex engine)
            {9}     #Repeat the previous "\d" 9 times (9 digits)
            $       #Match the end of the string
         */
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|string|regex:^[6-9]\d{9}$^',
            'description' => 'required|string',
            'photo' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'photo.required' => 'Please upload a profile photo',
            'photo.image' => 'The file must be an image',
        ];
    }
}
