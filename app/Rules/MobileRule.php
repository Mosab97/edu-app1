<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileRule implements Rule
{

    public function passes($attribute, $value)
    {
        return preg_match('/^[1-9][0-9]*$/', $value);
    }

    public function message()
    {
        return t('The Mobile Must Have Only Numbers');
    }
}
