<?php

/**
 * User Model
 *
 * User Model associated with users table
 *
 * @category   User
 * @package    App\Models
 * @author     Original Author <moethwinoo>
 */
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * SystemName : Bulletinboard
 * ModuleName : User
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the User model
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
