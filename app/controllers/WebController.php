<?php

use SpartaPark\Repository\Owner\OwnerRepository;
use SpartaPark\Repository\Lot\LotRepository;
use SpartaPark\Repository\Region\RegionRepository;
use SpartaPark\Repository\Entranxit\EntranxitRepository;
//require_once('GeoPlugin.class.php');
use SpartaPark\Helper\GeoPlugin;

/**
 * Class MainController
 */
class WebController extends BaseController
{

   protected $ownerRepository;

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
    * @var SpartaPark\Helper\GeoPlugin geo plugin
    */
   protected $geoPlugin;

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
    * @param OwnerRepository $ownerRepository owner repository
    * @param GeoPlugin $geoPlugin geo plugin to help get visitor's location
    */
   public function __construct(LotRepository       $lotRepository,
                               RegionRepository    $regionRepository,
                               EntranxitRepository $entranxitRepository,
                               OwnerRepository     $ownerRepository,
                               GeoPlugin           $geoPlugin)
   {
      $this->lotRepository       = $lotRepository;
      $this->regionRepository    = $regionRepository;
      $this->entranxitRepository = $entranxitRepository;
      $this->ownerRepository     = $ownerRepository;
      $this->geoPlugin           = $geoPlugin;
   }

   /**
    * Gets SpartaPark index page
    *
    * @return \Illuminate\View\View SpartaPark main page
    */
   public function getIndex()
   {
      $availableParking = $this->getAvailableNearCoordinates(37.3353235, -121.8804712);

      return $this->layout = View::make('spartapark.index')
         ->with('availableParking', $availableParking);
   }

   /**
    * Gets SpartaPark about page
    *
    * @return \Illuminate\View\View SpartaPark about page
    */
   public function getAbout()
   {
      return $this->layout = View::make('abouts.index');
   }

   /**
    * Gets SpartaPark contact page
    *
    * @return \Illuminate\View\View SpartaPark contact page
    */
   public function getContact()
   {
      return $this->layout = View::make('contacts.index');
   }

   /**
    * Post the contact form
    *
    * @return $this
    */
   public function postContact()
   {
      // Get all contact form data
      $data = Input::all();

      // Validation rules
      $rules = array(
         'first_name' => 'required|alpha',
         'last_name'  => 'required|alpha',
         'email'      => 'required|email',
         'subject'    => 'required|min:3',
         'message'    => 'required|min:20'
      );

      // Validate the data
      $validator = Validator::make($data, $rules);

      // Check if validator passes
      if ($validator->passes()) {
         // Send email
         Mail::send('emails.notify', $data, function($message) use ($data)
         {
            $message->from($data['email'], $data['first_name']);
            $message->to('spartaparkcontact@gmail.com', 'SpartaPark Team')->subject($data['subject']);
         });

         // Return to contact page with a success notification
         return Redirect::route('contact')
            ->with('success', 'Email successfully sent!');

        // Redirect to contact page if validator does not pass
      } else {
         return Redirect::route('contact')
            ->withInput()
            ->withErrors($validator);
      }
   }

   /**
    * Gets SpartaPark available parking page
    *
    * @return \Illuminate\View\View SpartaPark available parking page
    */
   public function getAvailableParking()
   {
      $coordinatesSanJoseStateUniversity = array(
         'latitude'  => 37.3353235,
         'longitude' => -121.8804712
      );

      $availableParking = $this->getAvailableNearCoordinates(
         $coordinatesSanJoseStateUniversity['latitude'],
         $coordinatesSanJoseStateUniversity['longitude']
      );

      return $this->layout = View::make('spartapark.availableparking')
         ->with('availableParking', $availableParking);
   }

   public function getDirections($address)
   {
      $this->geoPlugin->locate('162.197.213.38');
      $origin = array(
         'ip'              => $this->geoPlugin->ip,
         'city'            => $this->geoPlugin->city,
         'region'          => $this->geoPlugin->region,
         'area_code'       => $this->geoPlugin->areaCode,
         'country_code'    => $this->geoPlugin->countryCode,
         'country_name'    => $this->geoPlugin->countryName,
         'continent_code'  => $this->geoPlugin->continentCode,
         'latitude'        => $this->geoPlugin->latitude,
         'longitude'       => $this->geoPlugin->longitude
      );

      $geocode = Geocoder::geocode($address);
      $destination = array(
         'latitude'  => $geocode->getLatitude(),
         'longitude' => $geocode->getLongitude(),
         'address'   => $address
      );

      $directionsData = array(
        $destination
      );

      return $this->layout = View::make('spartapark.getdirections')
         ->with('directionsData', $destination);
   }

   /**
    * Gets owner information by id
    *
    * @param $id owner id
    * @return array|bool|mixed
    */
   public function getOwnerInfo($id)
   {
      $owner = $this->ownerRepository->find($id, array());
      if (!$owner) {
         return false;
      }

      $owner = array(
         'id'            => $owner->id,
         'name'          => $owner->name,
         'phone_number'  => $owner->phone_number,
         'email_address' => $owner->email_address
      );

      return $owner;
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



      //$ip = \GetIP\GetIP::get();
      //$location = GeoIP::getLocation();



      $this->geoPlugin->locate();

      dd($this->geoPlugin->latitude);

      $location = $this->getIpInfo($_SERVER["REMOTE_ADDR"], 'Country');
      dd($location);

      //$latitude = $location['lat'];
      //$longitude = $location['lon'];

      $config['center'] = 'auto';
      $config['zoom'] = 'auto';
      $config['directions'] = TRUE;
      $config['directionsStart'] = $latitude = null . ', ' . $longitude = null;
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
      //dd($coords);
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
      $lots = array();
      $i = 0;

      foreach ($locations as $location) {
         // Find lot by id
         $lot = $this->lotRepository->find($location->id, array('regions'));
         $regions = $lot->regions;
         $lotRegions = array();
         $j = 0;
         $lotAvailableSpots = 0;

         foreach ($regions as $region) {
            // Check if region capacity is greater than spots occupied
            if (json_decode($region['capacity']) > json_decode($region['spots_occupied'])) {
               // Calculate available spots
               $availableSpots = json_decode($region['capacity']) - json_decode($region['spots_occupied']);
               $filteredRegion = array(
                  'id'              => $region->id,
                  'name'            => $region->name,
                  'capacity'        => $region->capacity,
                  'spots_occupied'  => $region->spots_occupied,
                  'spots_available' => json_decode($availableSpots),
                  'lot_id'          => $region->lot_id
               );
               // Calculate lot's available spots
               $lotAvailableSpots += $availableSpots;
               $lotRegions[$j] = $filteredRegion;
               $j++;
            }
         }

         $lot = array(
            'id'              => $lot->id,
            'name'            => $lot->name,
            'address'         => $lot->address,
            'spots_available' => json_decode($lotAvailableSpots),
            'distance'        => json_decode($location->distance),
            'longitude'       => $lot->longitude,
            'latitude'        => $lot->latitude,
            'regions'         => $lotRegions
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