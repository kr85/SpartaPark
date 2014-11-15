<?php namespace controllers;

use TestCase;
use Mockery;

/**
 * Class MobileControllerTest
 *
 * @package controllers
 */
class MobileControllerTest extends TestCase
{
   /**
    * Test if getLotInfo function returns a JSON file
    */
   public function testGetLotInfoIsJSON()
   {
      $response = $this->call('GET', 'api/lot_info/lot_id/1');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test if lot exists
    */
   public function testGetLotInfoFound()
   {
      $response = $this->call('GET', 'api/lot_info/lot_id/1');
      $result = $response->isNotFound();

      $this->assertFalse($result);
   }

   /**
    * Test if lot does not exist
    */
   public function testGetLotInfoNotFound()
   {
      $response = $this->call('GET', 'api/lot_info/lot_id/999');
      $result = $response->getContent();

      $this->assertEquals('Lot does not exist', $result);
   }

   /**
    * Test if getRegionInfo function returns a JSON file
    */
   public function testGetRegionInfoIsJSON()
   {
      $response = $this->call('GET', 'api/region_info/region_id/1');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test if region exists
    */
   public function testGetRegionInfoFound()
   {
      $response = $this->call('GET', 'api/region_info/region_id/1');
      $result = $response->isNotFound();

      $this->assertFalse($result);
   }

   /**
    * Test if region does not exist
    */
   public function testGetRegionInfoNotFound()
   {
      $response = $this->call('GET', 'api/region_info/region_id/999');
      $result = $response->getContent();

      $this->assertEquals('Region does not exist', $result);
   }
}
 