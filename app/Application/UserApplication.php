<?php

namespace App\Application;

use App\Repositories\UserRepository;

class UserApplication
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserName(int $userId): string
    {
        return $this->userRepository->findById($userId)->name;
    }

    public function getUserFirstName(int $userId): string
    {
        $name_parts = explode(' ', $this->getUserName($userId));
        return $name_parts[0];
    }

    public function getUserLastName(int $userId): string
    {
        $name_parts = explode(' ', $this->getUserName($userId));
        return end($name_parts);
    }
}

