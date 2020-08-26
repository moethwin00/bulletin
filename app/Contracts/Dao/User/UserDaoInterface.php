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

namespace App\Contracts\Dao\User;

/**
 * SystemName : Bulletinboard
 * Description : Interface for UserDao
 */
interface UserDaoInterface 
{
    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList();

    /**
     * Get A Specific User
     *
     * @param int $id
     * @return user
     */
    public function getUser($id);

    /**
     * Get Userr By Search Keywords 
     * 
     * @param string $name
     * @param string $email
     * @param Date $createdfrom
     * @param Date $createdto
     * @return userList
     */
    public function getSearchUsers($name, $email, $createdfrom, $createdto);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */ 
    public function saveUser($request);

    /**
     * Get User By Email 
     * 
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email);
    
    /**
     * Update User
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser($request, $id);

    /**
     * Delete A Specific User
     *
     * @param App\Models\User $user
     * @return
     */
    public function deleteUser($user);
}
?>