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
    $userList = User::paginate(1);
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
    $userList = User::where('name', 'LIKE', '%'.$name.'%') 
                -> orWhere('email', 'LIKE', '%'.$email.'%')
                -> orWhereBetween('created_at', [$createdfrom, $createdto]) -> get();
    return $userList;
  }

  // /**
  //  * Store a newly created resource in storage.
  //  *
  //  * @param  Post
  //  * @return \Illuminate\Http\Response
  //  */
  // public function savePost($post) 
  // {
  //   $post -> create_user_id = Auth::user() -> id;
  //   $post -> updated_user_id = Auth::user() -> id;
  //   $post -> save();
  // }

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