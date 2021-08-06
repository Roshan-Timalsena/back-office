<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PanRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if(preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $value)){
            return true;
        } else { 
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid PAN Number.';
    }
}
