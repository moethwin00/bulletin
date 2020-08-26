<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServiceInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Http\Requests\ChangePassword;

use Illuminate\Http\Request;

class PasswordController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userInterface->getUser($id);
        return view('auth.passwords.password_reset')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChangePassword $request, $id)
    {
        $user = $this->userInterface->getUser($id);
        $this->authInterface->changePassword($user, $request);
        return redirect()->route('users#edit', $id);
    }
}
