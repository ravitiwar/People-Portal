<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class ValidationFailedException extends ValidationException
{
    protected $errors;
    function render(){
        return response()->fail($this->errors(),$this->getMessage());
    }
}
