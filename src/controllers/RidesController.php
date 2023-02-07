<?php


require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/RideRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Ride.php';

class RidesController extends AppController {

    public function search() {
        if (!$this->isPost()) {
            return $this->render('search-results');
        }

        $start = $_POST["start"];
        $destination = $_POST["destination"];
        $date = $_POST["date"];
        $passengers = $_POST["passengers"];

        if(empty($start) or empty($destination) or empty($date) or empty($passengers)){
            return $this->render('home');
        }

        $rideRepository = new RideRepository();
        $rides = $rideRepository->getRides($start, $destination, $passengers, $date);
        if ($rides != null) {
            return $this->render('search-results', ['rides' => $rides]);
        }
        return $this->render('search-results');
    }

    public function ride() {
        if (!$this->isPost()) {
            return $this->render('add-ride');
        }

        $rideRepository = new RideRepository();
        $start = $_POST["start"];
        $destination = $_POST["destination"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $availableSeats = $_POST["available-seats"];
        $ride = new Ride($start, $destination, $availableSeats, $date, $time,7);

        $rideRepository->addRide($ride);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
}