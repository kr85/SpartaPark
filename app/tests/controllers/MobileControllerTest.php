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
    * Test that getLotInfo function returns a JSON file
    */
   public function testGetLotInfoIsJSON()
   {
      $response = $this->call('GET', 'api/lot_info/lot_id/1');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test that lot exists
    */
   public function testGetLotInfoFound()
   {
      $response = $this->call('GET', 'api/lot_info/lot_id/1');
      $result = $response->isNotFound();

      $this->assertFalse($result);
   }

   /**
    * Test that lot does not exist
    */
   public function testGetLotInfoNotFound()
   {
      $response = $this->call('GET', 'api/lot_info/lot_id/999');
      $result = $response->getContent();

      $this->assertEquals('Lot does not exist', $result);
   }

   /**
    * Test that getRegionInfo function returns a JSON file
    */
   public function testGetRegionInfoIsJSON()
   {
      $response = $this->call('GET', 'api/region_info/region_id/1');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test that region exists
    */
   public function testGetRegionInfoFound()
   {
      $response = $this->call('GET', 'api/region_info/region_id/1');
      $result = $response->isNotFound();

      $this->assertFalse($result);
   }

   /**
    * Test that region does not exist
    */
   public function testGetRegionInfoNotFound()
   {
      $response = $this->call('GET', 'api/region_info/region_id/999');
      $result = $response->getContent();

      $this->assertEquals('Region does not exist', $result);
   }

   /**
    * Test that getLotsNearAddress function returns a JSON file
    */
   public function testGetLotsNearAddressIsJSON()
   {
      $response = $this->call('GET', 'api/lots_near_address/address/1 Washington Sq, San Jose, CA 95192');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test that no parking lots are found near address
    */
   public function testGetLotsNearAddressNotFound()
   {
      $response = $this->call('GET', 'api/lots_near_address/address/172 Waverly Street, Sunnyvale, CA 94086');
      $result = $response->getContent();

      $this->assertEquals('There are no parking lots within 5 miles', $result);
   }

   /**
    * Test that getAvailableNearAddress function returns a JSON file
    */
   public function testGetAvailableNearAddressIsJSON()
   {
      $response = $this->call('GET', 'api/available_near_address/address/1 Washington Sq, San Jose, CA 95192');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test that no parking lots are found near address
    */
   public function testGetAvailableNearAddressNotFound()
   {
      $response = $this->call('GET', 'api/available_near_address/address/172 Waverly Street, Sunnyvale, CA 94086');
      $result = $response->getContent();

      $this->assertEquals('There are no parking lots within 5 miles', $result);
   }

   /**
    * Test that getLotsNearCoordinates function returns a JSON file
    */
   public function testGetLotsNearCoordinatesIsJSON()
   {
      $response = $this->call('GET', 'api/lots_near_coordinates/latitude/37.3353235/longitude/-121.8804712');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test that no parking lots are found near coordinates
    */
   public function testGetLotsNearCoordinatesNotFound()
   {
      $response = $this->call('GET', 'api/lots_near_coordinates/latitude/37.375810/longitude/-122.043462');
      $result = $response->getContent();

      $this->assertEquals('There are no parking lots within 5 miles', $result);
   }

   /**
    * Test that getAvailableNearCoordinates function returns a JSON file
    */
   public function testGetAvailableNearCoordinatesIsJSON()
   {
      $response = $this->call('GET', 'api/lots_near_coordinates/latitude/37.3353235/longitude/-121.8804712');
      $content = $response->getContent();

      $this->assertJson($content);
   }

   /**
    * Test that no parking lots are found near coordinates
    */
   public function testGetAvailableNearCoordinatesNotFound()
   {
      $response = $this->call('GET', 'api/lots_near_coordinates/latitude/37.375810/longitude/-122.043462');
      $result = $response->getContent();

      $this->assertEquals('There are no parking lots within 5 miles', $result);
   }
}