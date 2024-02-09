<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/";
        if (strlen($value) < 3) {
            $fail('The :attribute must be at least 3 characters long');
        } else {
            if (!preg_match($pattern, $value)) {
                $fail('Password should contains Atleast 1 Uppercase,1 lowercase,1 number and 1 special character');
            }
        }
    }
}
