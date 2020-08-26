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

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Util\StringUtil;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

/**
 * SystemName : Bulletinboard
 * Description : Controller for Users
 */
class UserController extends Controller
{
    /**
     * UserInterface Declaration to access Business Logic for System
     */
    private $userInterface;

    /**
     * AuthInterface Declaration to access Business Logic for System
     */
    private $authInterface;

    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface, AuthServiceInterface $authInterface) {
        $this->userInterface = $userInterface;
        $this->authInterface = $authInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userList = $this->userInterface->getUserList();
        $message = $this->userInterface->getAvailableMessage($userList);
        return view('user.userlist') -> with('userList', $userList) -> with('message', $message);
    }

    /**
     * Display a listing of the search resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $name = $request -> input('name');
        $email = $request -> input('email');
        $createdfrom = $request -> input('createdfrom');
        $createdto = $request -> input('createdto');
        $userList = $this->userInterface->getSearchUsers($name, $email, $createdfrom, $createdto);
        if (StringUtil::isNotEmpty($name) || StringUtil::isNotEmpty($email) || StringUtil::isNotEmpty($createdfrom) || StringUtil::isNotEmpty($createdto)) {
            $message = $this->userInterface->getAvailableMessage($userList);
            return view('user.userlist') 
                    -> with('userList', $userList) 
                    -> with('message', $message)
                    -> with('name', $name)
                    -> with('email', $email)
                    -> with('createdfrom', $createdfrom)
                    -> with('createdto', $createdto);
        }
        else 
            return redirect('/users');  
    }

    /**
     * Display confirm resource to store into storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCreate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|regex:/^(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,}$/',
            'password_confirmation' => 'required',
            'type' => 'required',
        ]);
        $user = $this->userInterface->saveDataToUser($request);
        return view('user.confirmcreate') -> with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existenceUser = $this->authInterface->getUserByEmail($request->input('email'));
        if (StringUtil::isNotEmpty($existenceUser)) {
            return view('auth.register') -> with('duplicate', true) -> with('user', $existenceUser);
        }
        else {
            $this->userInterface->saveUser($request);
            return redirect()-> route('users#index');
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
        $user = $this->userInterface->getUser($id);
        if (Gate::allows('isUser')) {
            if ($id != Auth::user()->id)
                return redirect('/');
        }
        return view('user.edituser')->with('duplicate', false)->with('user', $user);
    }

    /**
     * Display confirm resource to update user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmEdit(Request $request, $id)
    {
        $user = $this->userInterface->saveDataToUpdate($request, $id);
        if (Gate::allows('isUser')) {
            if ($id != Auth::user()->id)
                return redirect('/');
        }
        return view('user.confirmedit') -> with('user', $user);
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
        $duplicate = $this->userInterface->isDuplicateUser($request);    
        $userFormRequest = $this->userInterface->getUserByEmail($request->input('email'));
        if ($duplicate && $userFormRequest->id."" != $id) {
            $userFormRequest->id = $id;
            return view('user.edituser') -> with('duplicate', $duplicate) -> with('user', $userFormRequest);
        }
        else {
            $user = $this->userInterface->updateUser($request, $id);
            if (Gate::allows('isUser')) {
                return redirect('/');
            }
            else {
                return redirect() -> route('users#index');
            }
        }
    }
    
    /**
     * Display showProfile resource to show user Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile() {
        $user = Auth::user();
        return view('user.userprofile') -> with('user', $user);
    }

    /**
     * Soft delte specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = $this->userInterface->getUser($id);
        $this->userInterface->deleteUser($user);
        return redirect()->back();
    }
}
