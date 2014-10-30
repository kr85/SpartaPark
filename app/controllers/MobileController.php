<?php

use SpartaPark\Repository\Lot\LotRepository;
use SpartaPark\Repository\Region\RegionRepository;

/**
 * Class MobileController
 */
class MobileController extends BaseController
{
   /**
    * @var SpartaPark\Repository\Lot\LotRepository lot repository
    */
   protected $lotRepository;

   /**
    * @var SpartaPark\Repository\Region\RegionRepository region repository
    */
   protected $regionRepository;

   /**
    * Constructor
    *
    * @param LotRepository $lotRepository lot repository
    * @param RegionRepository $regionRepository region repository
    */
   public function __construct(LotRepository $lotRepository, RegionRepository $regionRepository)
   {
      $this->lotRepository    = $lotRepository;
      $this->regionRepository = $regionRepository;
   }

   /**
    * Gets lot information by id
    *
    * @param $id lot id
    * @return array of lot information
    */
   public function getLotInfo($id)
   {
      // Find lot by id
      $lot = $this->lotRepository->find($id, array('regions'));

      // Check if lot exists
      if (!$lot) {
         return 'Lot does not exist';
      }

      // Set lot array
      $lot = array(
         'id'        => $lot->id,
         'name'      => $lot->name,
         'address'   => $lot->address,
         'longitude' => $lot->longitude,
         'latitude'  => $lot->latitude,
         'regions'   => $lot->regions
      );

      // Return the lot
      return  $lot;
   }

   /**
    * Gets region information by id
    *
    * @param $id region id
    * @return \Illuminate\Support\Collection|static region information
    */
   public function getRegionInfo($id)
   {
      // Find region by id
      $region = $this->regionRepository->find($id, array());

      // Check if region exists
      if (!$region) {
         return 'Region does not exist';
      }

      // Return the region
      return $region;
   }

   /**
    * Gets all lots near search address
    *
    * @param null $address search address
    * @return array of nearest lots
    */
   public function getLotsNearAddress($address = null)
   {
      // Get address information from Google Maps API
      $geocode = Geocoder::geocode($address);

      // Get address latitude
      $latitude = $geocode->getLatitude();

      // Get address longitude
      $longitude = $geocode->getLongitude();

      // Check database for nearest locations based on address's latitude and longitude
      $locations = $this->getNearestLocationsFromDB($latitude, $longitude);

      // Check if there are any locations within 5 miles
      if (empty($locations)) {
         return 'There are no parking lots within 5 miles';
      }

      // New lots array
      $lots = array();

      // Index
      $i = 0;

      // Go through each location
      foreach ($locations as $location) {

         // Find lot by id
         $lot = $this->lotRepository->find($location->id, array('regions'));

         // Set lot array
         $lot = array(
            'id'        => $lot->id,
            'name'      => $lot->name,
            'address'   => $lot->address,
            'distance'  => $location->distance,
            'longitude' => $lot->longitude,
            'latitude'  => $lot->latitude,
            'regions'   => $lot->regions
         );

         // Save each lot in the lots array
         $lots[$i] = $lot;

         // Increment the index
         $i++;
      }

      // Return the lots array
      return $lots;
   }

   /**
    * Get all lots near address with available spots
    *
    * @param null $address search address
    * @return array all lots with available spots
    */
   public function getAvailableNearAddress($address = null)
   {
      // Get address information from Google Maps API
      $geocode = Geocoder::geocode($address);

      // Get address latitude
      $latitude = $geocode->getLatitude();

      // Get address longitude
      $longitude = $geocode->getLongitude();

      // Check database for nearest locations based on address's latitude and longitude
      $locations = $this->getNearestLocationsFromDB($latitude, $longitude);

      // Check if there are any locations within 5 miles
      if (empty($locations)) {
         return 'There are no parking lots within 5 miles';
      }

      // New lots array
      $lots = array();

      // Index
      $i = 0;

      // Go through each location
      foreach ($locations as $location) {

         // Find lot by id
         $lot = $this->lotRepository->find($location->id, array('regions'));

         // Store the lot's regions
         $regions = $lot->regions;

         // New lot regions array
         $lotRegions = array();

         // Index
         $j = 0;

         // Lot available spots variable
         $lotAvailableSpots = 0;

         // Go through each region
         foreach ($regions as $region) {

            // Check if region capacity is greater than spots occupied
            if (json_decode($region['capacity']) > json_decode($region['spots_occupied'])) {

               // Calculate available spots
               $availableSpots = json_decode($region['capacity']) - json_decode($region['spots_occupied']);

               // Set filtered region array
               $filteredRegion = array(
                  'id'              => $region->id,
                  'name'            => $region->name,
                  'capacity'        => $region->capacity,
                  'spots_occupied'  => $region->spots_occupied,
                  'spots_available' => json_encode($availableSpots),
                  'lot_id'          => $region->lot_id
               );

               // Calculate lot's available spots
               $lotAvailableSpots += $availableSpots;

               // Save each filtered region array to the lot regions array
               $lotRegions[$j] = $filteredRegion;

               // Increment the index
               $j++;
            }
         }

         // Set the lot array
         $lot = array(
            'id'              => $lot->id,
            'name'            => $lot->name,
            'address'         => $lot->address,
            'spots_available' => json_encode($lotAvailableSpots),
            'distance'        => $location->distance,
            'longitude'       => $lot->longitude,
            'latitude'        => $lot->latitude,
            'regions'         => $lotRegions
         );

         // Save each lot in the lots array
         $lots[$i] = $lot;

         // Increment the index
         $i++;
      }

      // Return the lots array
      return $lots;
   }

   /**
    * Get all lots near current location
    *
    * @param null $latitude current latitude
    * @param null $longitude current longitude
    * @return array of all lots near current location
    */
   public function getLotsNearCoordinates($latitude = null, $longitude = null)
   {
      // Check database for nearest locations based on address's latitude and longitude
      $locations = $this->getNearestLocationsFromDB($latitude, $longitude);

      // Check if there are any locations within 5 miles
      if (empty($locations)) {
         return 'There are no parking lots within 5 miles';
      }

      // New lots array
      $lots = array();

      // Index
      $i = 0;

      // Go through each location
      foreach ($locations as $location) {

         // Find lot by id
         $lot = $this->lotRepository->find($location->id, array('regions'));

         // Set the lot array
         $lot = array(
            'id'        => $lot->id,
            'name'      => $lot->name,
            'address'   => $lot->address,
            'distance'  => $location->distance,
            'longitude' => $lot->longitude,
            'latitude'  => $lot->latitude,
            'regions'   => $lot->regions
         );

         // Save each lot in the lots array
         $lots[$i] = $lot;

         // Increment the index
         $i++;
      }

      // Return the lots array
      return $lots;
   }

   /**
    * Get all lots with available spots near current location
    *
    * @param null $latitude current latitude
    * @param null $longitude current longitude
    * @return array of all lots near current location
    */
   public function getAvailableNearCoordinates($latitude = null, $longitude = null)
   {
      // Check database for nearest locations based on address's latitude and longitude
      $locations = $this->getNearestLocationsFromDB($latitude, $longitude);

      // Check if there are any locations within 5 miles
      if (empty($locations)) {
         return 'There are no parking lots within 5 miles';
      }

      // New lots array
      $lots = array();

      // Index
      $i = 0;

      // Go through each location
      foreach ($locations as $location) {

         // Find lot by id
         $lot = $this->lotRepository->find($location->id, array('regions'));

         // Store the lot's regions
         $regions = $lot->regions;

         // New lot regions array
         $lotRegions = array();

         // Index
         $j = 0;

         // Lot's available spots variable
         $lotAvailableSpots = 0;

         // Go through each region
         foreach ($regions as $region) {

            // Check if region capacity is greater than spots occupied
            if (json_decode($region['capacity']) > json_decode($region['spots_occupied'])) {

               // Calculate available spots
               $availableSpots = json_decode($region['capacity']) - json_decode($region['spots_occupied']);

               // Set filtered region array
               $filteredRegion = array(
                  'id'              => $region->id,
                  'name'            => $region->name,
                  'capacity'        => $region->capacity,
                  'spots_occupied'  => $region->spots_occupied,
                  'spots_available' => json_encode($availableSpots),
                  'lot_id'          => $region->lot_id
               );

               // Calculate lot's available spots
               $lotAvailableSpots += $availableSpots;

               // Save each filtered region array into the lot regions array
               $lotRegions[$j] = $filteredRegion;

               // Increment the index
               $j++;
            }
         }

         // Set the lot array
         $lot = array(
            'id'              => $lot->id,
            'name'            => $lot->name,
            'address'         => $lot->address,
            'spots_available' => json_encode($lotAvailableSpots),
            'distance'        => $location->distance,
            'longitude'       => $lot->longitude,
            'latitude'        => $lot->latitude,
            'regions'         => $lotRegions
         );

         // Save each lot into the lots array
         $lots[$i] = $lot;

         // Increment the index
         $i++;
      }

      // Return the lots array
      return $lots;
   }

   /**
    * Gets all lots from the database that are near specific location
    *
    * @param null $latitude given latitude
    * @param null $longitude given longitude
    * @param null $radius given radius
    * @param null $distanceUnit given distance units
    * @return array of all lots near search location
    */
   private function getNearestLocationsFromDB($latitude     = null,
                                              $longitude    = null,
                                              $radius       = null,
                                              $distanceUnit = null)
   {
      // Default radius is 5 miles
      if ($radius == null) {
         $radius = 5;
      }

      // Default distance units are miles
      if ($distanceUnit == null) {
         $distanceUnit = 69.0;
      }

      // Return all lots from database that are within 5 miles of the search coordinates
      $results = DB::select('SELECT
                                id,
                                name,
                                address,
                                latitude,
                                longitude,
                                distance
                             FROM (
                                SELECT
                                   l.id,
                                   l.name,
                                   l.address,
                                   l.latitude,
                                   l.longitude,
                                   p.radius,
                                   p.distance_unit
                                      * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                                      * COS(RADIANS(l.latitude))
                                      * COS(RADIANS(p.longpoint - l.longitude))
                                      + SIN(RADIANS(p.latpoint))
                                      * SIN(RADIANS(l.latitude)))) AS distance
                                FROM lots AS l
                                JOIN (
                                   SELECT
                                      ' . $latitude . ' AS latpoint,
                                      ' . $longitude . ' AS longpoint,
                                      ' . $radius . ' AS radius,
                                      ' . $distanceUnit . ' AS distance_unit
                                  ) AS p
                                WHERE
                                   l.latitude
                                      BETWEEN p.latpoint  - (p.radius / p.distance_unit)
                                         AND p.latpoint  + (p.radius / p.distance_unit)
                                AND
                                   l.longitude
                                      BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
                                         AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
                             ) AS d
                             WHERE distance <= radius
                             ORDER BY distance ASC
                             LIMIT 15'
      );

      // Return the results
      return $results;
   }
}