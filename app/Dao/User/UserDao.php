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

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use App\Models\Post;
use App\Util\StringUtil;

use Illuminate\Support\Facades\Auth;

/**
 * SystemName : Bulletinboard
 * Description : DAO Implementation for User
 */
class UserDao implements UserDaoInterface 
{
    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList() 
    {
        $userList = User::where('deleted_user_id', null)->paginate(7);
        return $userList;
    }

    /**
     * Get A Specific User
     *
     * @param int $id
     * @return user
     */
    public function getUser($id) {
        return User::find($id);
    }

    /**
     * Get User By Search Keywords 
     * 
     * @param string $name
     * @param string $email
     * @param Date $createdfrom
     * @param Date $createdto
     * @return userList
     */
    public function getSearchUsers($name, $email, $createdfrom, $createdto)
    {
        $user= User::query();
        if (StringUtil::isNotEmpty($name)) {
            $user -> where('name', 'LIKE', '%'.$name.'%');
        }
        if (StringUtil::isNotEmpty($email)) {
          $user -> where('email', 'LIKE', '%'.$email.'%');
        }
        if (StringUtil::isNotEmpty($createdfrom) && StringUtil::isEmptyString($createdto)) {
            $user -> where('created_at', '>=', $createdfrom);
        }
        if (StringUtil::isEmptyString($createdfrom) && StringUtil::isNotEmpty($createdto)) {
            $user -> where('created_at', '<=', $createdto);
        }
        if (StringUtil::isNotEmpty($createdfrom) && StringUtil::isNotEmpty($createdto)) {
            $user -> whereBetween('created_at', [$createdfrom, $createdto]);
        }
        
        $userList = $user -> where('deleted_user_id', null)-> get();
        return $userList;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveUser($request) 
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'type' => $request->input('type'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
            'profile' => $request->input('profile'),
            ]);
      }

    /**
     * Update User
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser($request, $id)
    {
        $user = User::find($id);
        $user -> name = $request -> input('name');
        $user -> email = $request -> input('email');
        if (StringUtil::isEmptyString($request->input('type'))) {
            $user->type = Auth::user()->type;
        }
        else {
            $user -> type = $request -> input('type');
        }
        $user -> phone = $request -> input('phone');
        $user -> dob = $request -> input('dob');
        $user -> address = $request -> input('address');
        $user -> profile = $request -> input('profile');
        $user -> updated_user_id = Auth::user() -> id;
        $user -> save();  
    }

    /**
     * Delete A Specific User
     *
     * @param App\Models\User $user
     * @return
     */
    public function deleteUser($user) {
        $user->deleted_user_id = Auth::user()->id;
        $user->save();
        $post = Post::where('create_user_id', $user->id)
            ->orWhere('updated_user_id', $user->id);
        $post->update(['deleted_user_id' => Auth::user()->id]);
        $post->delete();
        $user->delete();
    }

    /**
     * Get User By Email 
     * 
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email)
    {
        return User::where('email', $email) -> first();
    }
}
?>