<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\UserServicesInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;



class UserServices implements UserServicesInterface
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserAddress($user_id)
    {

    }
    public function getUsersAssignedToRoles()
    {
        return $this->userRepository->getUsersAssignedToRoles();
    }

    public function createUserWithRole($data)
    {

        $user = $this->userRepository->create($data['email'], $data['username'], Hash::make($data['password']));
        $user = $this->userRepository->setEmailVerified($user);
        return $this->userRepository->assignUserToRole($user, $data['role']);
    }

    public function updateAssignedUser($user, $newDetails)
    {
        return $this->userRepository->updateAssignedUser($user, $newDetails);
    }

    public function deleteUser($userId)
    {
        return $this->userRepository->deleteUser($userId);
    }


}