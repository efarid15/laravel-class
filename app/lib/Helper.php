<?php

namespace App\Lib;

use App\User;

class Helper {

    public static function getUserName($id)
    {
        $user = User::find($id);
        if ( $user == null || empty($user)) {
            return false;
        }

        return $user->name;
    }

}
