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

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

/**
 * SystemName : Bulletinboard
 * Description : DAO Implementation for Post
 */
class PostDao implements PostDaoInterface 
{
  /**
   * Get Post List
   *
   * @return postList
   */
  public function getPostList() 
  {
    if (Auth::check()) {
      $postList = (Auth::user()->isAdmin())? Post::paginate(1): Post::where('create_user_id', Auth::user()->id)->paginate(1);
    }
    else $postList = Post::where('status', '1')->paginate(1);
    return $postList;
  }

  /**
   * Get Post By Search Keyword 
   * 
   * @param searchQuery
   * @return postList
   */
  public function getSearchPosts($q) 
  {
    $postList = Post::where('title', 'LIKE', '%'.$q.'%') -> orWhere('description', 'LIKE', '%'.$q.'%') -> get();
    return $postList;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Post
   * @return \Illuminate\Http\Response
   */
  public function savePost($post) 
  {
    $post -> create_user_id = Auth::user() -> id;
    $post -> updated_user_id = Auth::user() -> id;
    $post -> save();
  }

  public function updatePost($request, $id)
  {
    $post = Post::find($id);
    $post -> title = $request->input('title');
    $post -> description = $request->input('description');
    $post -> updated_user_id = Auth::user() -> id;
    $post -> save();  
  }

  /**
   * Get Post By Title 
   * 
   * @param title
   * @return Post
   */
  public function getPostByTitle($title)
  {
    return Post::where('title', $title) -> first();
  }
}
?>