<?php

namespace App\Services;

use App\User;
use Illuminate\Auth\Passwords\PasswordBroker as BasePasswordBroker;

class CustomPasswordBroker extends BasePasswordBroker
{
    public function getUser(array $credentials)
    {
        $users = User::all();
        $field = $credentials['email'];

        foreach ($users as $user) {
            if ($field === $user->email) {
                return $user;
                break;
            }
        }
        return null;
    }
}
