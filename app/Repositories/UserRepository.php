<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class UserRepository
{
    public function getUser($userId)
    {
        return User::where('id', $userId)->first();
    }
}