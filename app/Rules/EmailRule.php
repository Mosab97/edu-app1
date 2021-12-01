<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value);
    }

    public function message()
    {
        return t('Please enter a valid email');
    }
}
