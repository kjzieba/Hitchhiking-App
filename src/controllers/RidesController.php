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

        if (empty($start) or empty($destination) or empty($date) or empty($passengers)) {
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
        if (!isset($_COOKIE['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }

        if (!$this->isPost()) {
            return $this->render('add-ride');
        }

        $rideRepository = new RideRepository();
        $userRepository = new UserRepository();
        $start = $_POST["start"];
        $destination = $_POST["destination"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $availableSeats = $_POST["available-seats"];

        $userID = $userRepository->getUser($_COOKIE["email"])->getId();
        $ride = new Ride($start, $destination, $availableSeats, $date, $time, -1, $userID);

        $rideRepository->addRide($ride);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function rides() {
        if (!isset($_COOKIE['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }

        if (!$this->isPost()) {
            return $this->render('my-rides');
        }
    }

    public function details($id) {
        if ($id != null) {
            $ridesRepository = new RideRepository();
            $ride = $ridesRepository->getRideByID($id);
            $this->render('details', ['ride' => $ride]);
        }
    }

    public function join($id_ride){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }
        if ($this->isPost()) {
            $ridesRepository = new RideRepository();
            $userRepository = new UserRepository();
            $id_user = $userRepository->getUser($_COOKIE['email'])->getId();
            $seats_left = $ridesRepository->getRideByID($id_ride)->getAvailableSeats();

            if($seats_left > 0){
                $ridesRepository->joinRide($id_user, $id_ride);
            }

            $ridesRepository->updateAvailableSeats($id_ride);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }
    }
}