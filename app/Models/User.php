<?php
/**
 * Model file
 *
 * Model Associated with database tables
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SystemName : Bulletinboard
 * Description : User Model associated with users table
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
        'name', 'email', 'password', 'type', 'phone', 'dob', 'address', 'profile',
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
        $admin = ($this->type == "0")? true: false;
        return $admin;
    }

    /**
     * Get the user record associated with post.
     */
    public function user() {
        return $this -> belongsTo('App\Models\User', 'create_user_id', 'id');
    }

    /**
     * Get the user’s profile image
     */
    public function getImageAttribute()
    {
        return $this->profile_image;
    }

}
