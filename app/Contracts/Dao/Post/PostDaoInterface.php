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

namespace App\Contracts\Dao\Post;

/**
 * SystemName : Bulletinboard
 * Description : Interface for PostDao
 */
interface PostDaoInterface 
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
     * Store a newly created resource in storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function savePost($post);

    /**
     * Get Post By Title 
     * 
     * @param string $title
     * @return Post
     */
    public function getPostByTitle($title);
    
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
}
?>