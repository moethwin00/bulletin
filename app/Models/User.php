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
        'name', 'email', 'password', 'type', 'phone', 'dob', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() 
    {
        return $this->type;
    }

     /**
     * Get the user record associated with post.
     */
    public function user() {
        return $this -> belongsTo('App\Models\User', 'create_user_id', 'id');
    }

}
