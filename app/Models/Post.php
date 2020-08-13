<?php

/**
 * Post Model
 *
 * Post Model associated with posts table
 *
 * @category   Post
 * @package    App\Models
 * @author     Original Author <moethwinoo>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SystemName : Bulletinboard
 * ModuleName : Post
 */
class Post extends Model
{
    /**
     * The table associated with the Post Model
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status', 'create_user_id', 'updated_user_id',
    ];

    /**
     * Get the user record associated with post.
     */
    public function user() {
        return $this -> belongsTo('App\Models\User', 'create_user_id', 'id');
    }
}