<?php

/**
 * Class MainController
 */
class MainController extends BaseController
{

   public function getLotInfo()
   {
      return  'Lot info';
   }

   public function getRegionInfo()
   {
      return 'Region info';
   }

   public function getLotsNearAddress()
   {
      return 'Lots near address';
   }

   public function getLotsNearCoordinates()
   {
      return 'Lots near coordinates';
   }
}