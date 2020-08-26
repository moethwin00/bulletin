<?php
/**
 * DAO interface file
 *
 * This file can work to declare methods for DAO Implementation Class, This 
 * file is used for only method declaration for DAO
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Contracts\Dao\Auth;

/**
 * SystemName : Bulletinboard
 * Description : Interface for AuthDao
 */
interface AuthDaoInterface 
{
    /**
     * Get User By Email
     *
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email);

    /**
     * Change User Password
     * 
     * @param User $user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword($user, $request);
}
?>