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

namespace App\Services\Auth;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Dao\Auth\AuthDaoInterface;
use App\Models\User;
use App\Util\StringUtil;

/**
 * SystemName : Bulletinboard
 * Description : Service Implementation for Auth
 */
class AuthService implements AuthServiceInterface
{
  private $authDao;

  /**
   * Class Constructor
   * 
   * @param OperatorAuthDaoInterface
   * @return
   */
  public function __construct(AuthDaoInterface $authDao)
  {
    $this->authDao = $authDao;
  }

  /**
   * Get Post List
   *
   * @return User
   */
  public function getUserByEmail($email)
  {
    return $this->authDao->getUserByEmail($email);
  }
}
?>