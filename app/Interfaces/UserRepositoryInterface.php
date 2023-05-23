<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUserAddress($user_id);
    public function getUsersAssignedToRoles();
    public function create($email, $username, $password);
    public function setEmailVerified($user);
    public function assignUserToRole($user, $role);
    public function updateAssignedUser($user, $newDetails);
    public function deleteUser($userId);

}