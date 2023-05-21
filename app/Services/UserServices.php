<?php

namespace App\Services;

use UserRepositoryInterface;


class UserServices
{
 protected $userRepository ;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

public function getUserAddress ($user_id) {
    
}


}
