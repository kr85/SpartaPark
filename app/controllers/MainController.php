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

   public function getLotsNearAddress($address = null)
   {
      $g = Geocoder::geocode('San Jose State University, 95192');
      dd($g);

      //$ip = \GetIP\GetIP::get();;
      $location = GeoIP::getLocation('162.197.213.38');
      $latitude = $location['lat'];
      $longitude = $location['lon'];

      $config['center'] = 'auto';
      $config['zoom'] = 'auto';
      $config['directions'] = TRUE;
      $config['directionsStart'] = $latitude . ', ' . $longitude;
      $config['directionsEnd'] = $address;
      $config['directionsDivID'] = 'directionsDiv';
      Gmaps::initialize($config);
      $data['map'] = Gmaps::create_map();
      return $this->layout = View::make('spartapark.index', $data);
   }

   public function getNearestLocationsFromDB()
   {
      $latitude = 37.3351874;
      $longitude = -121.8810715;
      $radius = 5;
      $distanceUnit = 69.0;

      $results = DB::select('SELECT
                                name,
                                address,
                                latitude,
                                longitude,
                                distance
                             FROM (
                                SELECT
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

   public function getLotsNearCoordinates($longitude = null, $latitude = null)
   {
      $config = array();
      $config['center'] = 'auto';
      $config['onboundschanged'] = 'if (!centreGot) {
	      var mapCentre = map.getCenter();
	      marker_0.setOptions({
		      position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
	      });
      }
      centreGot = true;';
      Gmaps::initialize($config);

      $marker = array();
      Gmaps::add_marker($marker);
      $data['map'] = Gmaps::create_map();

      return $this->layout = View::make('spartapark.index', $data);
   }

}