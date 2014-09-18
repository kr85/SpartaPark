<?php

use SpartaPark\Repository\Lot\LotRepository;
use SpartaPark\Repository\Region\RegionRepository;

/**
 * Class MainController
 */
class MainController extends BaseController
{
   /**
    * @var SpartaPark\Repository\Lot\LotRepository lot repository
    */
   protected $lotRepository;

   /**
    * @var SpartaPark\Repository\Region\RegionRepository region repository
    */
   protected $regionRepository;

   protected $layout = 'layouts.master';

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

   public function getIndex()
   {
      return $this->layout = View::make('spartapark.index');
   }

   /**
    * Gets lot information by id
    *
    * @param $id lot id
    * @return array of lot information
    */
   public function getLotInfo($id)
   {
      $lot = $this->lotRepository->find($id, array('regions'));
      $lot = array(
         'id'        => $lot->id,
         'name'      => $lot->name,
         'address'   => $lot->address,
         'longitude' => $lot->longitude,
         'latitude'  => $lot->latitude,
         'regions'   => $lot->regions
      );

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
      $region = $this->regionRepository->find($id, array());

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
      $geocode = Geocoder::geocode($address);
      $latitude = $geocode->getLatitude();
      $longitude = $geocode->getLongitude();
      $locations = $this->getNearestLocationsFromDB($latitude, $longitude);
      $lots = array();
      $i = 0;

      foreach ($locations as $location) {
         $lot = $this->lotRepository->find($location->id, array('regions'));
         $lot = array(
            'id'        => $lot->id,
            'name'      => $lot->name,
            'address'   => $lot->address,
            'distance'  => $location->distance,
            'longitude' => $lot->longitude,
            'latitude'  => $lot->latitude,
            'regions'   => $lot->regions
         );
         $lots[$i] = $lot;
         $i++;
      }

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
      $locations = $this->getNearestLocationsFromDB($latitude, $longitude);
      $lots = array();
      $i = 0;

      foreach ($locations as $location) {
         $lot = $this->lotRepository->find($location->id, array('regions'));
         $lot = array(
            'id'        => $lot->id,
            'name'      => $lot->name,
            'address'   => $lot->address,
            'distance'  => $location->distance,
            'longitude' => $lot->longitude,
            'latitude'  => $lot->latitude,
            'regions'   => $lot->regions
         );
         $lots[$i] = $lot;
         $i++;
      }

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
                                      '. $latitude .' AS latpoint,
                                      '. $longitude .' AS longpoint,
                                      '. $radius .' AS radius,
                                      '. $distanceUnit .' AS distance_unit
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

      return $results;
   }

   public function getDirections($address)
   {

   }


}