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
            $post = (Auth::user()->isAdmin())? Post::query(): Post::where('create_user_id', Auth::user()->id);
        }
        else $post = Post::where('status', '1');
        $postList = $post->where('deleted_user_id', null)->paginate(7);
        return $postList;
    }

        /**
     * Get A Specific Post
     *
     * @param int $id
     * @return Post
     */
    public function getPost($id) {
        return Post::find($id);
    }

    /**
     * Get Post By Search Keyword 
     * 
     * @param string $q
     * @return postList
     */
    public function getSearchPosts($q) 
    {
        $postList = Post::where('title', 'LIKE', '%'.$q.'%') -> orWhere('description', 'LIKE', '%'.$q.'%') ->where('deleted_user_id', null) -> get();
        return $postList;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function savePost($post) 
    {
        $post -> create_user_id = Auth::user() -> id;
        $post -> updated_user_id = Auth::user() -> id;
        $post -> save();
    }
    /**
     * Update Post
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id)
    {
        $post = Post::find($id);
        $post -> title = $request->input('title');
        $post -> description = $request->input('description');
        $post -> updated_user_id = Auth::user() -> id;
        $post -> status = ($request->has('status'))? "1": "0";
        $post -> save();  
    }

    /**
     * Delete A Specific Post
     *
     * @param App\Models\Post $post
     * @return
     */
    public function deletePost($post) {
        $post -> deleted_user_id = Auth::user()->id;
        $post->save();
        $post->delete();
    }

    /**
     * Get Post By Title 
     * 
     * @param string $title
     * @return Post
     */
    public function getPostByTitle($title)
    {
        return Post::where('title', $title) -> first();
    }
}
?>