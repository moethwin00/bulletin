<?php
/**
 * DAO interface file
 *
 * This file can work to declare methods for DAO Implementation Class, This 
 * file is used for only method declaration for DAO
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Contracts\Dao\Post;

/**
 * SystemName : Bulletinboard
 * Description : Interface for PostDao
 */
interface PostDaoInterface 
{
  /**
   * Get Post List
   *
   * @return postList
   */
  public function getPostList();

  /**
   * Get Post By Search Keyword 
   * 
   * @param searchQuery
   * @return postList
   */
  public function getSearchPosts($q);
}
?>