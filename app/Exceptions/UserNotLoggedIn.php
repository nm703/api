<?php

namespace App\Exceptions;

use Exception;

class UserNotLoggedIn extends Exception
{
    public function render()
    {
        return ['error'=>'User not logged in'];
    }
}
