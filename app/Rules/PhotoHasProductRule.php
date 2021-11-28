<?php

namespace App\Rules;

use App\Facades\VisionClient;
use Illuminate\Contracts\Validation\Rule;

class PhotoHasProductRule implements Rule
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
        return VisionClient::detect($value, 'product');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The photo does not contains our product.';
    }
}
