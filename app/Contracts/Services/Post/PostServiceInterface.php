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
     * Get A Specific Post
     *
     * @param int $id
     * @return Post
     */
    public function getPost($id);

    /**
     * Get Post By Search Keyword 
     * 
     * @param string $q
     * @return postList
     */
    public function getSearchPosts($q);

    /**
     * Get Post available or not Message
     * 
     * @param List<Post> $postList
     * @return message
     */
    public function getAvailableMessage($postList);

    /**
     * Set Form Request Data into Array to show Post Create Confirmation Page
     * 
     * @param \Illuminate\Http\Request $request
     * @return Array
     */
    public function saveDataToPost($request);

    /**
     * Set Form Request Data into Array to show Post Update Confirmation Page
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return User
     */
    public function saveDataToUpdate($request, $id);

    /**
     * Check Method Title of Post Duplicated or Not
     * 
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function isDuplicateTitle($request);

    /**
     * Store a newly created resource in storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */ 
    public function savePost($post);
    
    /**
     * Update Post
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id);

    /**
     * Delete A Specific Post
     *
     * @param App\Models\Post $post
     * @return
     */
    public function deletePost($post);

    /**
     * Get Post By Title 
     * 
     * @param string $title
     * @return Post
     */
    public function getPostByTitle($title);

    /**
     * Download method for downloading posts with excel format
     * 
     * @return \Illuminate\Http\Response
     */
    public function download();
}

?>