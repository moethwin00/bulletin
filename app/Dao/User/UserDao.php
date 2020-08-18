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

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use App\Util\StringUtil;
use Illuminate\Support\Facades\Auth;

/**
 * SystemName : Bulletinboard
 * Description : DAO Implementation for User
 */
class UserDao implements UserDaoInterface 
{
  /**
   * Get User List
   *
   * @return userList
   */
  public function getUserList() 
  {
    $userList = User::paginate(7);
    return $userList;
  }

  /**
   * Get User By Search Keywords 
   * 
   * @param searchQuery
   * @return userList
   */
  public function getSearchUsers($name, $email, $createdfrom, $createdto)
  {
    $user= User::query();
    if (StringUtil::isNotEmpty($name)) {
      $user -> where('name', 'LIKE', '%'.$name.'%');
    }
    if (StringUtil::isNotEmpty($email)) {
      $user -> where('email', 'LIKE', '%'.$email.'%');
    }
    if (StringUtil::isNotEmpty($createdfrom) && StringUtil::isEmptyString($createdto)) {
      $user -> where('created_at', '>=', $createdfrom);
    }
    if (StringUtil::isEmptyString($createdfrom) && StringUtil::isNotEmpty($createdto)) {
      $user -> where('created_at', '<=', $createdto);
    }
    if (StringUtil::isNotEmpty($createdfrom) && StringUtil::isNotEmpty($createdto)) {
      $user -> whereBetween('created_at', [$createdfrom, $createdto]);
    }
    
    $userList = $user -> get();
    return $userList;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function saveUser($request) 
  {
    User::create([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'password' => $request->input('password'),
      'type' => $request->input('type'),
      'phone' => $request->input('phone'),
      'dob' => $request->input('dob'),
      'address' => $request->input('address'),
      'profile' => $request->input('profile'),
      ]);
  }

  // public function updatePost($request, $id)
  // {
  //   $post = Post::find($id);
  //   $post -> title = $request->input('title');
  //   $post -> description = $request->input('description');
  //   $post -> updated_user_id = Auth::user() -> id;
  //   $post -> save();  
  // }

  // /**
  //  * Get Post By Title 
  //  * 
  //  * @param title
  //  * @return Post
  //  */
  // public function getPostByTitle($title)
  // {
  //   return Post::where('title', $title) -> first();
  // }
}
?>