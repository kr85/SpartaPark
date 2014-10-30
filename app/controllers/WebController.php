<?php

use SpartaPark\Repository\Owner\OwnerRepository;
use SpartaPark\Repository\Lot\LotRepository;
use SpartaPark\Repository\Region\RegionRepository;
use SpartaPark\Repository\Entranxit\EntranxitRepository;
use SpartaPark\Validation\Contact\ContactUsFormValidator;

/**
 * Class MainController
 */
class WebController extends BaseController
{
   /**
    * @var SpartaPark\Repository\Owner\OwnerRepository owner repository
    */
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
    * @var SpartaPark\Validation\Contact\ContactUsFormValidator contact us form validator
    */
   protected $validatorContactUs;

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
    * @param ContactUsFormValidator $contactUsFormValidator contact us form validator
    */
   public function __construct(LotRepository          $lotRepository,
                               RegionRepository       $regionRepository,
                               EntranxitRepository    $entranxitRepository,
                               OwnerRepository        $ownerRepository,
                               ContactUsFormValidator $contactUsFormValidator)
   {
      $this->lotRepository       = $lotRepository;
      $this->regionRepository    = $regionRepository;
      $this->entranxitRepository = $entranxitRepository;
      $this->ownerRepository     = $ownerRepository;
      $this->validatorContactUs  = $contactUsFormValidator;
   }

   /**
    * Gets SpartaPark index page
    *
    * @return \Illuminate\View\View SpartaPark main page
    */
   public function getIndex()
   {
      return $this->layout = View::make('spartapark.index');
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

      // Validate the data
      $validation = $this->validatorContactUs->with($data);

      // Check if validator passes
      if ($validation->passes()) {

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
            ->withErrors($validation->errors());
      }
   }

   /**
    * Gets SpartaPark available parking page
    *
    * @return \Illuminate\View\View SpartaPark available parking page
    */
   public function getAvailableParking()
   {
      // San Jose State University coordinates
      $coordinatesSanJoseStateUniversity = array(
         'latitude'  => 37.3353235,
         'longitude' => -121.8804712
      );

      // Gets all available parking near the coordinates
      $availableParking = $this->getAvailableNearCoordinates(
         $coordinatesSanJoseStateUniversity['latitude'],
         $coordinatesSanJoseStateUniversity['longitude']
      );

      // Return the available parking view with available parking
      return $this->layout = View::make('spartapark.availableparking')
         ->with('availableParking', $availableParking);
   }

   /**
    * Gets owner information by id
    *
    * @param $id owner id
    * @return array|bool|mixed
    */
   public function getOwnerInfo($id)
   {
      // Finds owner by id
      $owner = $this->ownerRepository->find($id, array());

      // Checks if owner exists
      if (!$owner) {
         return false;
      }

      // Owner entry
      $owner = array(
         'id'            => $owner->id,
         'name'          => $owner->name,
         'phone_number'  => $owner->phone_number,
         'email_address' => $owner->email_address
      );

      // Return owner
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
      // Finds lot with regions by id
      $lot = $this->lotRepository->find($id, array('regions'));

      // Checks if lot exists
      if (!$lot) {
         return false;
      }

      // Lot entry
      $lot = array(
         'id'        => $lot->id,
         'name'      => $lot->name,
         'address'   => $lot->address,
         'longitude' => $lot->longitude,
         'latitude'  => $lot->latitude,
         'regions'   => $lot->regions
      );

      // Return lot
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
      // Finds region by id
      $region = $this->regionRepository->find($id, array());

      // Checks if region exists
      if (!$region) {
         return false;
      }

      // Return region
      return $region;
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
                  'spots_available' => json_decode($availableSpots),
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

         // Lot entry
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
                             LIMIT 50'
      );

      // Return the results
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
      // Finds lot with regions by id
      $lot = $this->lotRepository->find($lot_id, array('regions'));

      // Checks if the lot exists
      if ($lot) {

         // Saves lot's regions
         $regions = $lot->regions;

         // Checks if the count of the regions is greater than 0
         if (count($regions) > 0) {

            // Sets found to false
            $isFound = false;

            // Goes through each lot's region
            foreach ($regions as $region) {

               // Compares lot's region ids with the region id
               if ($region->id == $region_id) {

                  // Sets found to true if found
                  $isFound = true;
               }
            }

            // If not found returns a region not found response
            if (!$isFound) {
               return Response::json('Region not found or wrong region id', 404);
            }

         // If region count less than zero
         // returns region not found response
         } else {
            return Response::json('Lot does not have any regions', 404);
         }

      // If lot not found returns a lot not found response
      } else {
         return Response::json('Lot not found', 404);
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
      $newEntry = $this->entranxitRepository->create(array(
         'lot_id'      => $lot_id,
         'region_id'   => $region_id,
         'orientation' => $orientation,
         'image'       => $uploadSuccess->getPath() . '/' . $uploadSuccess->getFilename()
      ));

      // Update database
      $this->updateSpotsAvailable($newEntry);

      // Checks if image was stored successfully
      if ($uploadSuccess && $newEntry) {
         return Response::json('Success', 200);
      } else {
         return Response::json('Error', 400);
      }
   }

   /**
    * Update available parking spots
    *
    * @param $entry Entranxit entry
    */
   public function updateSpotsAvailable($entry)
   {
      // Image path
      $image = $entry->image;
      // Region id
      $region_id = $entry->region_id;
      // Car orientation
      $orientation = $entry->orientation;

      // Check if the object in the image is a car
      if ($this->isCar($image)) {

         // Finds the region by id
         $region = $this->regionRepository->find($region_id, array());
         // Saves occupied spots
         $spotsOccupied = json_decode($region->spots_occupied);
         // Saves region capacity
         $capacity = json_decode($region->capacity);

         // Checks if the region exists
         if ($region) {

            // Checks if orientation is entrance
            if (strcasecmp(strtolower($orientation), 'entrance') == 0) {

               // Checks if capacity is greater than occupied spots
               if ($capacity > $spotsOccupied) {

                  // Decrements occupied spots
                  $this->regionRepository->update($region->id, array(
                     'spots_occupied' => ($spotsOccupied + 1)
                  ));
               }

            // Checks if orientation is exit
            } else if (strcasecmp(strtolower($orientation), 'exit') == 0) {

               // Checks if capacity is greater and equal than occupied spots
               // and occupied spots are greater than zero
               if ($capacity >= $spotsOccupied && $spotsOccupied > 0) {

                  // Increments occupied spots
                  $this->regionRepository->update($region->id, array(
                     'spots_occupied' => ($spotsOccupied - 1)
                  ));
               }
            }
         }
      }
   }

   /**
    * Check if the object in the picture is a car
    *
    * @param $image image
    * @return bool return true or false
    */
   public function isCar($image)
   {
      return true;
   }
}