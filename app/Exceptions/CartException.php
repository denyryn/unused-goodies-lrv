<?php

namespace App\Exceptions;

use Exception;

class CartException extends Exception
{
    public function render()
    {
        return back()->with('error', $this->getMessage());
    }
}
