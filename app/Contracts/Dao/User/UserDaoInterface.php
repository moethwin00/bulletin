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
   * Get Userr By Search Keywords 
   * 
   * @param searchQuery
   * @return userList
   */
  public function getSearchUsers($name, $email, $createdfrom, $createdto);

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */ 
  public function saveUser($request);

  // /**
  //  * Get Post By Title 
  //  * 
  //  * @param title
  //  * @return Post
  //  */
  // public function getPostByTitle($title);

  // public function updatePost($request, $id);
}
?>