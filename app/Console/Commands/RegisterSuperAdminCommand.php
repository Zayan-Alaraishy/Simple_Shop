<?php

namespace App\Console\Commands;

use App\Interfaces\AuthServiceInterface;
use App\Services\AuthServices;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class RegisterSuperAdminCommand extends Command
{
    protected $signature = 'register:super-admin'; //Command will be called as php artisan register:super-admin
    protected $description = 'Register super admin';

    /**
     * User model.
     *
     * @var object
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected AuthServiceInterface $authServices;

    public function __construct(User $user, AuthServices $authServices)
    {
        parent::__construct();

        $this->user = $user;
        $this->authServices = $authServices;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = $this->getDetails();

        if (!count($details)) {
            $this->info('Failed to create a super admin');
            return;
        }

        $user = $this->authServices->signup(
            $details['email'],
            $details['username'],
            $details['password']
        );

        $this->info('A verification email has been sent to this email');

        $super_admin = $this->user->signAsSuperAdmin($user);

        $this->display($super_admin);
    }

    /**
     * Ask for super admin details.
     *
     * @return array
     */
    private function getDetails(): array
    {
        $details['username'] = $this->ask('Username');
        $details['email'] = $this->ask('Email');
        $validator = Validator::make(
            ['email' => $details['email']],
            ['email' => 'required|email']
        );
        if ($validator->fails()) {
            $this->error('Invalid email');
            return [];
        }



        $details['password'] = $this->secret('Password');
        $details['confirm_password'] = $this->secret('Confirm password');

        while (!$this->isValidPassword($details['password'], $details['confirm_password'])) {
            if (!$this->isRequiredLength($details['password'])) {
                $this->error('Password must be more that two characters');
            }

            if (!$this->isMatch($details['password'], $details['confirm_password'])) {
                $this->error('Password and Confirm password do not match');
            }

            $details['password'] = $this->secret('Password');
            $details['confirm_password'] = $this->secret('Confirm password');
        }

        return $details;
    }

    /**
     * Display created super admin.
     *
     * @param array $admin
     * @return void
     */
    private function display(User $super_admin): void
    {
        $headers = ['Username', 'Email', 'Super admin'];

        $fields = [
            'Username' => $super_admin['username'],
            'Email' => $super_admin['email'],
            'Super admin' => $super_admin->isSuperAdmin() ? 'Yes' : 'No',
        ];


        $this->info('Super admin created');
        $this->table($headers, [$fields]);
    }

    /**
     * Check if password is vailid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $password, string $confirmPassword): bool
    {
        return $this->isRequiredLength($password) &&
            $this->isMatch($password, $confirmPassword);
    }

    /**
     * Check if password and confirm password matches.
     *
     * @param string $password
     * @param string $confirmPassword
     * @return bool
     */
    private function isMatch(string $password, string $confirmPassword): bool
    {
        return $password === $confirmPassword;
    }

    /**
     * Checks if password is longer than six characters.
     *
     * @param string $password
     * @return bool
     */
    private function isRequiredLength(string $password): bool
    {
        return strlen($password) > 2;
    }

}