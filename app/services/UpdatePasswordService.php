<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Config;


class UpdatePasswordService
{

    public function verifySamePassword($newPassword, $oldPassword)
    {
        if(password_verify($newPassword,$oldPassword)){

            return true;
        }
        return false;

    }

    public function changePassword($newPassword): void
    {
        $user = User::find(auth()->user()->id);

        $user->password = bcrypt($newPassword);
        $user->save();

    }

    public function changePasswordWithoutAuth($newPassword, $user): void
    {
        $user->password = bcrypt($newPassword);
        $user->save();

    }

}


