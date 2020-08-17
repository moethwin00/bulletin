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

use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Util\StringUtil;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface) {
        $this->userInterface = $userInterface;
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
        $user = $this->userInterface->saveDataToUser($request);
        return view('user.confirmcreate') -> with('user', $user);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
