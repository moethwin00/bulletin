<?php
/**
 * Request file
 *
 * This file can work as form request for change password form
 * This file is used for form request validation and authority
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * SystemName : Bulletinboard
 * Description : Form Request for Change Password
 */
class ChangePassword extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldPassword' => 'required',
            'password' => 'required|confirmed|regex:/^(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,}$/',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            $user = User::find($this->id);
            if(!Hash::check($this->oldPassword, $user->password)) {
                $validator->getMessageBag()->add('oldPassword', 'Your current password is incorrect.');
            }
        });
    }
}
