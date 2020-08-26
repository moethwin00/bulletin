<?php
/**
 * Service interface file
 *
 * This file can work to declare methods for Service Implementation Class, 
 * This file is used for only method declaration for Service and can work
 * for all Business Logic for System
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Contracts\Services\User;

/**
 * SystemName : Bulletinboard
 * Description : Interface for UserService
 */
interface UserServiceInterface 
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
     * Get User By Search Keywords
     * 
     * @param string $name
     * @param string $email
     * @param Date $createdfrom
     * @param Date $createdto
     * @return userList
     */
    public function getSearchUsers($name, $email, $createdfrom, $createdto);

    /**
     * Get User available or not Message
     * 
     * @param List<User> $userList
     * @return message
     */
    public function getAvailableMessage($userList);

    /**
     * Set Form Request Data into Array to show User Create Confirmation Page
     * 
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function saveDataToUser($request);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */ 
    public function saveUser($request);

    /**
     * Check Method Email of User Duplicated or Not
     * 
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function isDuplicateUser($request);
  
    /**
     * Update User
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser($request, $id);

    /**
     * Get User By Email 
     * 
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email);

    /**
     * Delete A Specific User
     *
     * @param App\Models\User $user
     * @return
     */
    public function deleteUser($user);
}
?>