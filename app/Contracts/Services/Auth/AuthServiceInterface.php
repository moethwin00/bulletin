<?php
/**
 * Service interface file
 *
 * This file can work to declare methods for Service Implementation Class, 
 * This file is used for only method declaration for Service and can work
 * for all Business Logic for System
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Contracts\Services\Auth;

/**
 * SystemName : Bulletinboard
 * Description : Interface for AuthService
 */
interface AuthServiceInterface 
{

  /**
   * Get User By Email
   *
   * @return User
   */
  public function getUserByEmail($email);

}
?>