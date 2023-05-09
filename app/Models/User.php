<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'phone'
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

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getOrders()
    {
        $carts = $this->carts()->where('status', 'close');
        if ($carts) {
            return Cart::getOrders($carts->get());
        }
        return null;
    }

    public function getCart()
    {
        return $this->carts()->where('status', 'open')->first();
    }

    public function hasPermission($permission)
    {
        // Check if user has admin permission
        if ($this->permission === '*') {
            return true;
        }

        // Check if user has permission for specific action
        $permissions = explode(',', $this->permission);
        return in_array($permission, $permissions);
    }

}