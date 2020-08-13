<?php
/**
 * Utility file
 *
 * This file can work for common string utilities
 * (check empty text, case, etc...)
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Util;

/**
 * SystemName : Bulletinboard
 * Module : StringUtility Module
 */
class StringUtil 
{
  /**
   * Check String is empty
   *
   * @param someText
   * @return boolean
   */
  public static function isEmptyString($someText) 
  {
    if ($someText = null || $someText = "" || empty($someText) || strlen($someText) == 0)
      return true;
    else 
      return false;
  }

  /**
   * Check String is not empty
   *
   * @param someText
   * @return boolean
   */
  public static function isNotEmpty($someText)
  {
    return !StringUtil::isEmptyString($someText);
  }
}