<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $fillable = ['id', 'full_name', 'phone_number', 'password'];

    public function works(){
        return $this->hasMany(Work::class);
    }

}
