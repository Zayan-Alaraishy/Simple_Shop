<?php

namespace App\Interfaces;

interface UserServicesInterface
{
    public function getUserAddress($user_id);
    public function getUsersAssignedToRoles();
    public function createUserWithRole($data);
    public function deleteUser($userId);
    public function updateAssignedUser($user, $newDetails);


}