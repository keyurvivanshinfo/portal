<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// import rules
use App\Rules\PasswordValidation;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required|alpha_num|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => ['required',new PasswordValidation],
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => "First name field can not be empty",
            'lname.required' => "Last name field can not be empty",
            'username.required' => "Last name field can not be empty",
            'username.alpha_num' => "Username must only contain letters and numbers.",
            'username.min' => "Username must only contain letters and numbers.",
            'email.required' => "Last name field can not be empty",
            'email.email' => "Email format is invalid.",
            'username.unique' => "Username already taken please try another one.",
            'email.unique' => "Email address already registered with us.",
            'password.required' => "Last name field can not be empty",
            'password.min' => "Password should have at least 5 characters."
        ];
    }
}
