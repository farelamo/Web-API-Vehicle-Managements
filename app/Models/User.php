<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'username', 'phone', 'age', 'role'];
    protected $hidden   = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function admin_histories()
    {
        return $this->hasMany(History::class, 'admin_id', 'admin_id');
    }

    public function spv_employee_histories()
    {
        return $this->hasMany(History::class, 'spv_employee_id', 'spv_employee_id');
    }
    
    public function spv_admin_histories()
    {
        return $this->hasMany(History::class, 'spv_admin_id', 'spv_admin_id');
    }
    
}