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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SystemName : Bulletinboard
 * Description : Post Model associated with posts table
 */
class Post extends Model
{
    use SoftDeletes;

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