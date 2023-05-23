<?php

namespace App\Services;

use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\ProfileServiceInterface;
use App\Jobs\SendEmailVerificationNotification;
use App\Models\User;

class ProfileService implements ProfileServiceInterface
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function updateEmail(User $user, string $email): void
    {
        $this->profileRepository->updateEmail($user, $email);
        dispatch(new SendEmailVerificationNotification($user));
    }

    public function updateUsername(User $user, string $username): void
    {
        $this->profileRepository->updateUsername($user, $username);
    }

    public function toggleAccountPrivacy(User $user): void
    {
        $this->profileRepository->toggleAccountPrivacy($user);
    }

    public function findUserById(int $id): User
    {
        return $this->profileRepository->findUserById($id);
    }

    public function updateAddress(User $user, string|null $country, string|null $city, string|null $street): void
    {
        $this->profileRepository->updateAddress($user, $country, $city, $street);
    }

    public function updatePassword(User $user, string $password): void
    {
        $this->profileRepository->updatePassword($user, $password);
    }
    
    public function updateProfile(User $user, array $data): void
    {
        $email = $data['email'] ?? null;
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!empty($email) && $email !== $user->email) {
            $this->updateEmail($user, $email);
        }

        if (!empty($username) && $username !== $user->username) {
            $this->updateUsername($user, $username);
        }

        if (!empty($password)) {
            $this->updatePassword($user, $password);
        }
        
            $country = $data['country'] ?? NULL;
            $city = $data['city'] ?? NULL;
            $street = $data['street'] ?? NULL;
            $this->updateAddress($user, $country, $city, $street);
    }
}
