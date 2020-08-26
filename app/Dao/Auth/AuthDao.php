<?php
/**
 * DAO file
 *
 * This file can work to access Data from and to Database, This 
 * file is used for only DAO Implementation
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Dao\Auth;

use App\Contracts\Dao\Auth\AuthDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * SystemName : Bulletinboard
 * Description : DAO Implementation for Auth
 */
class AuthDao implements AuthDaoInterface 
{
    /**
     * Get User By Email
     *
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email) 
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    /**
    * Change User Password
     * 
     * @param User $user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword($user, $request) {
        $user->password = Hash::make($request->password);
        $user->update();
    }
}
?>