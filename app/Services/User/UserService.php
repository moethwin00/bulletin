<?php
/**
 * Service file
 *
 * This file can work for Service (Business Logic), 
 * This file is used for only Service (Business Logic)
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Services\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use App\Util\StringUtil;
use Illuminate\Support\Facades\Hash;

/**
 * SystemName : Bulletinboard
 * Description : Service Implementation for Users
 */
class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * 
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   *
   * @return userList
   */
  public function getUserList()
  {
    return $this->userDao->getUserList();
  }

  /**
   * Get User By Search Keywords 
   * 
   * @param searchQuery
   * @return userList
   */
  public function getSearchUsers($name, $email, $createdfrom, $createdto)
  {
    return $this->userDao->getSearchUsers($name, $email, $createdfrom, $createdto);
  }

  /**
   * Get User available or not Message
   * 
   * @param userList
   * @return message
   */
  public function getAvailableMessage($userList)
  {
    $message = "";
    if (count($userList) <= 0)
      $message = 'No User available!';
    return $message;
  }

  /**
   * Set Form Request Data into Array to show User Create Confirmation Page
   * 
   * @param request
   * @return User
   */
  public function saveDataToUser($request)
  {
    $user = new User();
    $user -> name = $request -> input('name');
    $user -> email = $request -> input('email'); 
    $user -> password = Hash::make( $request -> input('password'));
    $user -> type = $request -> input('type');
    $user -> phone = $request -> input('phone');
    $user -> dob = $request -> input('dob');
    $user -> address = $request -> input('address');
    return $user;
  }

  // /**
  //  * Set Form Request Data into Array to show Post Update Confirmation Page
  //  * 
  //  * @param request
  //  * @return Array
  //  */
  // public function saveDataToUpdate($request, $id)
  // {
  //   $title = $request->input('title');
  //   $description = $request->input('description');
  //   $post = Post::find($id);
  //   $post -> title = $title;
  //   $post -> description = $description; 
  //   return $post;
  // }

  // /**
  //  * Check Method Title of Post Duplicated or Not
  //  * 
  //  * @param request
  //  * @return boolean
  //  */
  // public function isDuplicateTitle($request)
  // {
  //   if (StringUtil::isNotEmpty($this->postDao->getPostByTitle($request->input('title')))) {
  //     return true;
  //   }
  //   else false;
  // }

  // /**
  //  * Get Post By Title 
  //  * 
  //  * @param title
  //  * @return Post
  //  */
  // public function getPostByTitle($title) {
  //   return $this->postDao->getPostByTitle($title);
  // }

  // /**
  //  * Store a newly created resource in storage.
  //  *
  //  * @param  Post
  //  * @return \Illuminate\Http\Response
  //  */  
  // public function savePost($post) 
  // {
  //   $this->postDao->savePost($post);
  // }

  // public function updatePost($request, $id)
  // {
  //   $this->postDao->updatePost($request, $id);
  // }
}
?>