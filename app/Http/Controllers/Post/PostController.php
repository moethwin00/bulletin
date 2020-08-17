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
use Illuminate\Support\Facades\Auth;

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
        $message = $this->postInterface->getAvailableMessage($postList);
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
        $post = new Post();
        return view('post.addpost')->with('duplicate', false)->with('post', $post);
    }

    /**
     * Display confirm resource to store into storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCreate(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'title' => ['required', 'string', 'max:255'], 
            'description' => ['required', 'string']]);
        if ($validator->fails()) 
            return redirect() -> route('posts.addPost') -> withErrors($validator) -> withInput();
        else {
            $post = $this->postInterface->saveDataToPost($request);
            return view('post.confirmcreate') -> with('post', $post);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicate = $this->postInterface->isDuplicateTitle($request);
        $post = $this->postInterface->saveDataToPost($request);
        if ($duplicate) {
            return view('post.addpost') -> with('duplicate', $duplicate) -> with('post', $post);
        }
        else {
            $this->postInterface->savePost($post);
            return redirect() -> route('posts');
        }
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
        $post = Post::find($id);
        return view('post.editpost')->with('duplicate', false)->with('post', $post);
    }

    /**
     * Display confirm resource to update post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmEdit(Request $request, $id)
    {
        $validator = Validator::make($request -> all(), [
            'title' => ['required', 'string', 'max:255'], 
            'description' => ['required', 'string']]);
        if ($validator->fails()) 
            return redirect() -> route('posts.editPost') -> withErrors($validator) -> withInput();
        else {
            $post = $this->postInterface->saveDataToUpdate($request, $id);
            return view('post.confirmedit') -> with('post', $post);
        }
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
        $duplicate = $this->postInterface->isDuplicateTitle($request);    
        $post = $this->postInterface->saveDataToPost($request);
        $postFormRequest = $this->postInterface->getPostByTitle($request->input('title'));
        echo($postFormRequest->id."");     
        echo($id);   
        echo($duplicate && $postFormRequest->id."" != $id);
        if ($duplicate && $postFormRequest->id."" != $id) {
            $postFormRequest->id = $id;
            return view('post.editpost') -> with('duplicate', $duplicate) -> with('post', $postFormRequest);
        }
        else {
            $post = $this->postInterface->updatePost($request, $id);
            return redirect() -> route('posts');
        }
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

}
