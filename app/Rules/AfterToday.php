<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AfterToday implements Rule
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
        return strtotime($value) > strtotime(date('Y-m-d')) ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute은 오늘 이후 날짜부터 선태할 수 있습니다.';
    }
}
