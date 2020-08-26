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
use App\Exports\PostExport;
use Maatwebsite\Excel\Facades\Excel;

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
     * @param OperatorPostDaoInterface $postDao
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
     * Get A Specific Post
     *
     * @param int $id
     * @return Post
     */
    public function getPost($id) {
        return $this->postDao->getPost($id);
    }

    /**
     * Get Post By Search Keyword 
     * 
     * @param string $q
     * @return postList
     */
    public function getSearchPosts($q)
    {
        return $this->postDao->getSearchPosts($q);
    }

    /**
     * Get Post available or not Message
     * 
     * @param List<Post> postList
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
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
     * @param int id
     * @return Post
     */
    public function saveDataToUpdate($request, $id)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->has('status')? "1": "0";
        $post = Post::find($id);
        $post -> title = $title;
        $post -> description = $description; 
        $post -> status = $status;
        return $post;
    }

    /**
     * Check Method Title of Post Duplicated or Not
     * 
     * @param \Illuminate\Http\Request $request
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
     * @param string title
     * @return Post
     */
    public function getPostByTitle($title) {
        return $this->postDao->getPostByTitle($title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */  
    public function savePost($post) 
    {
        $this->postDao->savePost($post);
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
        $this->postDao->updatePost($request, $id);
    }

    /**
     * Delete A Specific Post
     *
     * @param App\Models\Post $post
     * @return
     */
    public function deletePost($post) {
        $this->postDao->deletePost($post);
    }

    /**
     * Download method for downloading posts with excel format
     * 
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }
}
?>