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

namespace App\Contracts\Services\Post;

/**
 * SystemName : Bulletinboard
 * Description : Interface for PostService
 */
interface PostServiceInterface 
{

  /**
   * Get Post List
   *
   * @return postList
   */
  public function getPostList();

  /**
   * Get Post By Search Keyword 
   * 
   * @param searchQuery
   * @return postList
   */
  public function getSearchPosts($q);

  /**
   * Get Post available or not Message
   * 
   * @param postList
   * @return message
   */
  public function getAvailableMessage($postList);

  /**
   * Set Form Request Data into Array to show Post Create Confirmation Page
   * 
   * @param request
   * @return Array
   */
  public function saveDataToPost($request);

  /**
   * Set Form Request Data into Array to show Post Update Confirmation Page
   * 
   * @param request
   * @return User
   */
  public function saveDataToUpdate($request, $id);

  /**
   * Check Method Title of Post Duplicated or Not
   * 
   * @param request
   * @return boolean
   */
  public function isDuplicateTitle($request);

  /**
   * Store a newly created resource in storage.
   *
   * @param  Post
   * @return \Illuminate\Http\Response
   */ 
  public function savePost($post);

  public function updatePost($request, $id);

  /**
   * Get Post By Title 
   * 
   * @param title
   * @return Post
   */
  public function getPostByTitle($title);
}

?>