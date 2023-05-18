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
}
