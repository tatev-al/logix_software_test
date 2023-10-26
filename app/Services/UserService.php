<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepository;

    /**
     * CategoryService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($userId)
    {
        return $this->userRepository->getUser($userId);
    }
}