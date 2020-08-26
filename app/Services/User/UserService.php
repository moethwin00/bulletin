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

namespace App\Services\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use App\Util\StringUtil;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * SystemName : Bulletinboard
 * Description : Service Implementation for Users
 */
class UserService implements UserServiceInterface
{
    private $userDao;

    /**
     * Class Constructor
     * 
     * @param OperatorUserDaoInterface $userDao
     * @return
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList()
    {
        return $this->userDao->getUserList();
    }

    /**
     * Get A Specific User
     *
     * @param int $id
     * @return user
     */
    public function getUser($id) {
        return $this->userDao->getUser($id);
    }

    /**
     * Get User By Search Keywords 
     * 
     * @param string $name
     * @param string $email
     * @param string $createdfrom
     * @param string $createdtp
     * @return userList
     */
    public function getSearchUsers($name, $email, $createdfrom, $createdto)
    {
        return $this->userDao->getSearchUsers($name, $email, $createdfrom, $createdto);
    }

    /**
     * Get User available or not Message
     * 
     * @param List<User> $userList
     * @return message
     */
    public function getAvailableMessage($userList)
    {
        $message = "";
        if (count($userList) <= 0)
            $message = 'No User available!';
        return $message;
    }

    /**
     * Set Form Request Data into Array to show User Create Confirmation Page
     * 
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function saveDataToUser($request)
    {
        $user = new User();
        $user -> name = $request -> input('name');
        $user -> email = $request -> input('email'); 
        $user -> password = Hash::make( $request -> input('password'));
        $user -> type = $request -> input('type');
        $user -> phone = $request -> input('phone');
        $user -> dob = $request -> input('dob');
        $user -> address = $request -> input('address');
        $profile = $request -> file('profile');
        if (StringUtil::isNotEmpty($profile)) {
            $extension = $profile -> getClientOriginalExtension();
            Storage::disk('public')->put($profile->getFilename().'.'.$extension, File::get($profile));
            $user -> profile = $profile->getFilename().'.'.$extension;
        }
        return $user;
    }

    /**
     * Set Form Request Data into Array to show User Update Confirmation Page
     * 
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function saveDataToUpdate($request, $id)
    {
        $user = User::find($id);
        $user -> name = $request -> input('name');
        $user -> email = $request -> input('email'); 
        $user -> type = $request -> input('type');
        $user -> phone = $request -> input('phone');
        $user -> dob = $request -> input('dob');
        $user -> address = $request -> input('address');
        if ($request->hasFile('profile')) {
            $oldImage = $user -> profile;
            $exists = Storage::disk('public')->exists($oldImage);
            if($exists){
                Storage::disk('public')->delete($oldImage);
            }
            $profile = $request -> file('profile');
            $extension = $profile -> getClientOriginalExtension();
            Storage::disk('public')->put($profile->getFilename().'.'.$extension, File::get($profile));
            $user -> profile = $profile->getFilename().'.'.$extension; 
        }
        return $user;
    }

    /**
     * Check Method Email of User Duplicated or Not
     * 
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function isDuplicateUser($request)
    {
        if (StringUtil::isNotEmpty($this->userDao->getUserByEmail($request->input('email')))) {
            return true;
        }
        else false;
    }

    /**
     * Get User By Email 
     * 
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email) {
        return $this->userDao->getUserByEmail($email);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */  
    public function saveUser($request) 
    {
        $this->userDao->saveUser($request);
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
        $this->userDao->updateUser($request, $id);
    }

    /**
     * Delete A Specific User
     *
     * @param App\Models\User $user
     * @return
     */
    public function deleteUser($user) {
        $this->userDao->deleteUser($user);
    }
}
?>