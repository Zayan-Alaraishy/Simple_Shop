<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissionsTrait;


class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if the user has the super admin role.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->roles()->where('name', 'super admin')->exists();
    }
    /**
     * Determine if the user has the admin role.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles()->where('name', 'admin')->exists();
    }


    public function hasRoleAssigned()
    {
        return $this->roles()->exists();
    }
    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function signAsSuperAdmin(User $user)
    {
        $superAdminRole = Role::where('name', 'super admin')->first();
        echo $superAdminRole->id;
        if ($superAdminRole) {
            $user->roles()->attach($superAdminRole->id);
        }

        return $user;

    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


}