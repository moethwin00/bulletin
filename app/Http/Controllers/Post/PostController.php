<?php
/**
 * Controller file
 *
 * This file can work only for form validation and Route and View call.
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */
namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Util\StringUtil;
use Illuminate\Support\Facades\Validator;

/**
 * SystemName : Bulletinboard
 * Description : Controller for Posts
 */
class PostController extends Controller
{
    /**
     * PostInterface Declaration to access Business Logic for System
     */
    private $postInterface;

   /**
    * Create a new controller instance
    * 
    * @return void
    */
    public function __construct(PostServiceInterface $postInterface) {
        $this->postInterface = $postInterface;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postList = $this->postInterface->getPostList();
        $message = $this->postInterface->getAvailbleMessage($postList);
        return view('post.postlist') -> with('postList', $postList) -> with('message', $message);
    }

    /**
     * Display a listing of the search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = $request -> input('q');
        $postList = $this->postInterface->getSearchPosts($q);
        if (StringUtil::isNotEmpty($q)) {
            $message = $this->postInterface->getAvailableMessage($postList);
            return view('post.postlist') -> with('postList', $postList) -> with('message', $message) -> with('q', $q);
        }
        else 
            return redirect('/');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.addpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'title' => ['required', 'string', 'max:255', 'unique:posts'], 
            'description' => ['required', 'string']]);
        if ($validator->fails()) 
            return redirect() -> route('posts.addPost') -> withErrors($validator) -> withInput();
        else
            $post = $this->postInterface->saveDataToPost($request);
            return view('post.confirmcreate') -> with('post', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display confirm resouce to store into storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showConfirm(Request $request)
    {
        return view('post.confirmcreate');
    }

}
