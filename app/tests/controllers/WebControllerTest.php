<?php namespace controllers;

use TestCase;

/**
 * Class WebControllerTest
 *
 * @package controllers
 */
class WebControllerTest extends TestCase
{
   /**
    * Test get index page
    */
   public function testGetIndex()
   {
      $crawler = $this->call('GET', '/');
      $this->assertTrue($crawler->isOk());
   }

   /**
    * Test get contact page
    */
   public function testGetContact()
   {
      $crawler = $this->call('GET', '/contact');
      $this->assertTrue($crawler->isOk());
   }

   /**
    * Test get about page
    */
   public function testGetAbout()
   {
      $crawler = $this->call('GET', '/about');
      $this->assertTrue($crawler->isOk());
   }

   /**
    * Test get available parking page
    */
   public function testGetAvailableParking()
   {
      $crawler = $this->call('GET', '/parking');
      $this->assertTrue($crawler->isOk());
   }
}
 