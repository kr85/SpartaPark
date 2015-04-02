<?php namespace models;

use League\FactoryMuffin\Facade as FactoryMuff;
use TestCase;

/**
 * Class LotTest
 *
 * @package models
 */
class LotTest extends TestCase
{
   /**
    * Load all the factories before the tests
    */
   public static function setupBeforeClass()
   {
      FactoryMuff::setSaveMethod('save');
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
      FactoryMuff::setDeleteMethod('delete');
      FactoryMuff::deleteSaved();
   }
}
 