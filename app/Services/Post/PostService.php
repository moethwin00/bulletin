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

namespace App\Services\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use App\Util\StringUtil;

/**
 * SystemName : Bulletinboard
 * Description : Service Implementation for Post
 */
class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * 
   * @param OperatorPostDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get Post List
   *
   * @return postList
   */
  public function getPostList()
  {
    return $this->postDao->getPostList();
  }

  /**
   * Get Post By Search Keyword 
   * 
   * @param searchQuery
   * @return postList
   */
  public function getSearchPosts($q)
  {
    return $this->postDao->getSearchPosts($q);
  }

  /**
   * Get Post available or not Message
   * 
   * @param postList
   * @return message
   */
  public function getAvailableMessage($postList)
  {
    $message = "";
    if (count($postList) <= 0)
      $message = 'No post available!';
    return $message;
  }

  /**
   * Set Form Request Data into Array to show Post Create Confirmation Page
   * 
   * @param request
   * @return Array
   */
  public function saveDataToPost($request)
  {
    $title = $request->input('title');
    $description = $request->input('description');
    $post = new Post();
    $post -> title = $title;
    $post -> description = $description; 
    return $post;
  }

  /**
   * Set Form Request Data into Array to show Post Update Confirmation Page
   * 
   * @param request
   * @return Post
   */
  public function saveDataToUpdate($request, $id)
  {
    $title = $request->input('title');
    $description = $request->input('description');
    $post = Post::find($id);
    $post -> title = $title;
    $post -> description = $description; 
    return $post;
  }

  /**
   * Check Method Title of Post Duplicated or Not
   * 
   * @param request
   * @return boolean
   */
  public function isDuplicateTitle($request)
  {
    if (StringUtil::isNotEmpty($this->postDao->getPostByTitle($request->input('title')))) {
      return true;
    }
    else false;
  }

  /**
   * Get Post By Title 
   * 
   * @param title
   * @return Post
   */
  public function getPostByTitle($title) {
    return $this->postDao->getPostByTitle($title);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Post
   * @return \Illuminate\Http\Response
   */  
  public function savePost($post) 
  {
    $this->postDao->savePost($post);
  }

  public function updatePost($request, $id)
  {
    $this->postDao->updatePost($request, $id);
  }
}
?>