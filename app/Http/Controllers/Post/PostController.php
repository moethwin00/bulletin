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

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Util\StringUtil;
use App\Imports\PostImport;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

use Maatwebsite\Excel\Facades\Excel;
use Storage;

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
        return view('post.postlist')->with('postList', $postList)->with('message', $message);
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
            return view('post.postlist')->with('postList', $postList)->with('message', $message)->with('q', $q);
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
            return redirect()->route('posts#create')->withErrors($validator)->withInput();
        else {
            $post = $this->postInterface->saveDataToPost($request);
            return view('post.confirmcreate')->with('post', $post);
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
            return view('post.addpost')->with('duplicate', $duplicate)->with('post', $post);
        }
        else {
            $this->postInterface->savePost($post);
            return redirect()->route('posts#index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postInterface->getPost($id);
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
        $post = $this->postInterface->saveDataToUpdate($request, $id);
        return view('post.confirmedit')->with('post', $post);
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
        if ($duplicate && $postFormRequest->id."" != $id) {
            $postFormRequest->id = $id;
            return view('post.editpost')->with('duplicate', $duplicate)->with('post', $postFormRequest);
        }
        else {
            $post = $this->postInterface->updatePost($request, $id);
            return redirect() -> route('posts#index');
        }
    }

    /**
     * Soft delte specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = $this->postInterface->getPost($id);
        $this->postInterface->deletePost($post);
        return redirect()->back();
    }

    /**
     * Display upload form of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpload()
    {
        return view('post.uploadcsv');
    }

    /**
     * Upload function for uploading CSV File and import into Database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'profile' => 'required|max:2048',
        ]);
        try {
            Excel::import(new PostImport, $request->file('profile'));
            Storage::delete('framework/laravel-excel');
        }
        catch (QueryException $exception) {
            return redirect()->back()->with('message', 'Upload Failed, Try Again!');
        }
        return redirect() -> route('posts#index');
    }
    
    /**
     * Download function for downloading posts with excel format
     * 
     * @return \Illuminate\Http\Response
     */
    function download()
    {
        return $this->postInterface->download();
    }

}
