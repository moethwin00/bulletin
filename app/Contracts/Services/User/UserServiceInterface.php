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
   * Get User By Search Keywords
   * 
   * @param searchQuery
   * @return userList
   */
  public function getSearchUsers($name, $email, $createdfrom, $createdto);

  /**
   * Get User available or not Message
   * 
   * @param userList
   * @return message
   */
  public function getAvailableMessage($userList);

  /**
   * Set Form Request Data into Array to show User Create Confirmation Page
   * 
   * @param request
   * @return User
   */
  public function saveDataToUser($request);

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */ 
  public function saveUser($request);

  // /**
  //  * Check Method Title of Post Duplicated or Not
  //  * 
  //  * @param request
  //  * @return boolean
  //  */
  // public function isDuplicateTitle($request);

  // public function updatePost($request, $id);

  // /**
  //  * Get Post By Title 
  //  * 
  //  * @param title
  //  * @return Post
  //  */
  // public function getPostByTitle($title);
}

?>