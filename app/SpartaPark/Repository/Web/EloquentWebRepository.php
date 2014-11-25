<?php namespace SpartaPark\Repository\Web;

use SpartaPark\Repository\AbstractEloquentRepository;

class EloquentWebRepository extends AbstractEloquentRepository implements WebRepository
{
   public function isImage($image)
   {
      return true;
   }
}