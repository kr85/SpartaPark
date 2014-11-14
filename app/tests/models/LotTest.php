<?php namespace models;

use League\FactoryMuffin\Facade as FactoryMuff;
use PHPUnit_Framework_TestCase;

/**
 * Class LotTest
 *
 * @package models
 */
class LotTest extends PHPUnit_Framework_TestCase
{
   /**
    * Load all the factories before the tests
    */
   public static function setupBeforeClass()
   {
      FactoryMuff::loadFactories(__DIR__ . '/../factories');
   }

   /**
    * Test relation with owner
    */
   public function testRelationWithOwner()
   {
      $lot = FactoryMuff::create('Lot');
      $this->assertEquals($lot->owner_id, $lot->owners->id);
   }

   /**
    * Clean saved data after the tests
    */
   public static function tearDownAfterClass()
   {
      FactoryMuff::deleteSaved();
   }
}
 