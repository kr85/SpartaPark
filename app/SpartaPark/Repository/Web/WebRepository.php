<?php namespace SpartaPark\Repository\Web;

use SpartaPark\Repository\Crudable;
use SpartaPark\Repository\Repository;

/**
 * Interface WebRepository
 *
 * @package SpartaPark\Repository\Web
 */
interface WebRepository extends Repository, Crudable
{
   public function isImage($image);
}