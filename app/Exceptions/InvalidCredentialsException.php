<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    function render(){
        return response()->fail([],$this->getMessage());
    }
}
