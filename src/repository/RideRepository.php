<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Ride.php';

class RideRepository extends Repository {
    public function getRides(string $start, string $destination, string $passengers, string $date): ?array {
        $statement = $this->database->connect()->prepare(
            "select * from rides where start=:start and destination=:destination and number_of_seats>:passengers and date>:date"
        );

        $statement->bindParam(":start", $start, PDO::PARAM_STR);
        $statement->bindParam(":destination", $destination, PDO::PARAM_STR);
        $statement->bindParam(":passengers", $passengers, PDO::PARAM_STR);
        $statement->bindParam(":date", $date, PDO::PARAM_STR);
        $statement->execute();

        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rides) {
            return null;
        }

        $returnRides = [];
        foreach ($rides as $ride){
            $returnRides[] = new Ride(
                $ride['start'],
                $ride['destination'],
                $ride['available_seats'],
                $ride['date'],
                $ride['time'],
                1
            );
        }
        return $returnRides;
    }

    public function addRide(Ride $ride) {
        $statement = $this->database->connect()->prepare(
            "insert into rides (start,destination,number_of_seats, date,time)
            values (?,?,?,?,?)"
        );
        $statement->execute([
            $ride->getStart(),
            $ride->getDestination(),
            $ride->getAvailableSeats(),
            $ride->getDate(),
            $ride->getTime()
        ]);
    }
}