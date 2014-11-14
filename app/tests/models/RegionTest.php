<?php namespace models;

use League\FactoryMuffin\Facade as FactoryMuff;
use PHPUnit_Framework_TestCase;

class RegionTest extends PHPUnit_Framework_TestCase
{
   /**
    * Load all the factories before the tests
    */
   public static function setupBeforeClass()
   {
      FactoryMuff::loadFactories(__DIR__ . '/../factories');
   }

   /**
    * Test relation with lot
    */
   public function testRelationWithLot()
   {
      $region = FactoryMuff::create('Region');
      $this->assertEquals($region->lot_id, $region->lots->id);
   }

   /**
    * Clean saved data after the tests
    */
   public static function tearDownAfterClass()
   {
      FactoryMuff::deleteSaved();
   }
}
 