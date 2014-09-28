<?php

use SpartaPark\Repository\Lot\LotRepository;
use SpartaPark\Repository\Region\RegionRepository;
use SpartaPark\Repository\Entranxit\EntranxitRepository;

/**
 * Class MainController
 */
class WebController extends BaseController
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
    * @var SpartaPark\Repository\Entranxit\EntranxitRepository entranxit repository
    */
   protected $entranxitRepository;

   /**
    * @var string master layout
    */
   protected $layout = 'layouts.master';

   /**
    * Constructor
    *
    * @param LotRepository $lotRepository lot repository
    * @param RegionRepository $regionRepository region repository
    * @param EntranxitRepository $entranxitRepository entranxit repository
    */
   public function __construct(LotRepository       $lotRepository,
                               RegionRepository    $regionRepository,
                               EntranxitRepository $entranxitRepository)
   {
      $this->lotRepository       = $lotRepository;
      $this->regionRepository    = $regionRepository;
      $this->entranxitRepository = $entranxitRepository;
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
      if (!$lot) {
         return false;
      }

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
      if (!$region) {
         return false;
      }

      return $region;
   }

   public function getLotsNearAddress($address = null)
   {



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

   public function getCoordinates()
   {
      /*echo '<script type="text/javascript">
         var mapCentre = map.getCenter();
	      var latitude = mapCentre.lat();
	      var longitude = mapCentre.lng();
	      window.location.href = "current_location/latitude/" + latitude + "/longitude/" + longitude;
      </script>';*/

      $config = array();
      $config['center'] = 'auto';
      $config['onboundschanged'] = 'if (!centreGot) {
	      var mapCentre = map.getCenter();
	      var latitude = mapCentre.lat();
	      var longitude = mapCentre.lng();
	      marker_0.setOptions({
		      position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
	      });
	      window.location.href = "current_location/latitude/" + latitude + "/longitude/" + longitude;
      }
      centreGot = true;';
      Gmaps::initialize($config);

      $marker = array();
      Gmaps::add_marker($marker);
      $data['map'] = Gmaps::create_map();

      return $this->layout = View::make('spartapark.index', $data);
   }

   public function getLotsNearCoordinates($latitude, $longitude)
   {
      $coords = array($latitude, $longitude);
      dd($coords);
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

   /**
    * Uploads images to the database
    *
    * @param $lot_id lot id
    * @param $region_id region id
    * @param $orientation car orientation
    * @return \Illuminate\Http\JsonResponse json response
    */
   public function uploadImage($lot_id, $region_id, $orientation)
   {
      // Check lot id
      if (!$this->getLotInfo($lot_id)) {
         return Response::json('Lot not found', 404);
      }

      // Check region id
      if (!$this->getRegionInfo($region_id)) {
         return Response::json('Region not found', 404);
      }

      // Check orientation
      if (strcasecmp(strtolower($orientation), 'entrance') != 0 && strcasecmp(strtolower($orientation), 'exit') != 0) {
         return Response::json('Orientation not entrance or exit', 404);
      }

      // Get image
      $image = Input::file('image');
      // Destination
      $destinationPath = 'uploads';
      // Image name
      $filename = str_random(12);

      // Moves the image to the destination folder
      $uploadSuccess = $image->move($destinationPath, $filename);

      // Creates a new entry in the database
      $newEntry = Entranxit::create(array(
         'lot_id'      => $lot_id,
         'region_id'   => $region_id,
         'orientation' => $orientation,
         'image'       => $uploadSuccess->getPath() . '/' . $uploadSuccess->getFilename()
      ));

      // Checks if image was stored successfully
      if ($uploadSuccess && $newEntry) {
         return Response::json('Success', 200);
      } else {
         return Response::json('Error', 400);
      }
   }
}