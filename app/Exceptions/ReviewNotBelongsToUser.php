<?php

namespace App\Exceptions;

use Exception;

class ReviewNotBelongsToUser extends Exception
{
    public function render()
    {
        return ['error'=>'Review does not belong to user'];
    }
}
