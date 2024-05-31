<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value);
    }

    public function message()
    {
        return 'The :attribute must contain at least one special character.';
    }
}

