<?php
namespace App\Interfaces ;

interface AuthServiceInterface {

public function signup($email, $username, $password);

public function login ($login, $password);


public function resetPassword($request); 
}