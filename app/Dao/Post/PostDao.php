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
  public function getPostList() {
    return Post::paginate(2);
  }

  /**
   * Get Post By Search Keyword 
   * 
   * @param searchQuery
   * @return postList
   */
  public function getSearchPosts($q) {
    $postList = Post::where('title', 'LIKE', '%'.$q.'%') -> orWhere('description', 'LIKE', '%'.$q.'%') -> get();
    return $postList;
  }
}
?>