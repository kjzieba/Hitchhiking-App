<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Ride.php';

class RideRepository extends Repository {
    public function getRides(string $start, string $destination, string $passengers, string $date): ?array {
        $statement = $this->database->connect()->prepare(
            "select * from rides where start=:start and destination=:destination and number_of_seats>:passengers and date>=:date"
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
        foreach ($rides as $ride) {
            $returnRides[] = new Ride(
                $ride['start'],
                $ride['destination'],
                $ride['number_of_seats'],
                $ride['date'],
                $ride['time'],
                $ride['id'],
                $ride['id_added_by'],
            );
        }

        return $returnRides;
    }

    public function getRideByID(string $id): ?Ride {
        $statement = $this->database->connect()->prepare(
            "select * from rides where id=:id"
        );

        $statement->bindParam(":id", $id, PDO::PARAM_STR);
        $statement->execute();

        $ride = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$ride) {
            return null;
        }

        return new Ride(
            $ride['start'],
            $ride['destination'],
            $ride['number_of_seats'],
            $ride['date'],
            $ride['time'],
            $ride['id'],
            $ride['id_added_by']
        );
    }

    public function addRide(Ride $ride) {
        $statement = $this->database->connect()->prepare(
            "insert into rides (start,destination,number_of_seats, date,time, id_added_by)    
            values (?,?,?,?,?,?)"
        );
        $statement->execute([
            $ride->getStart(),
            $ride->getDestination(),
            $ride->getAvailableSeats(),
            $ride->getDate(),
            $ride->getTime(),
            $ride->getIdDriver()
        ]);
    }

    public function joinRide(string $id_user, string $id_ride) {
        $statement = $this->database->connect()->prepare(
            "insert into rides_passengers (id_user, id_ride)    
            values (?,?)"
        );
        $statement->execute([
            $id_user,
            $id_ride
        ]);
    }

    public function updateAvailableSeats($id_ride) {
        $statement = $this->database->connect()->prepare(
            "update rides SET number_of_seats=number_of_seats-1
                    where id=:id_ride"
        );

        $statement->execute([
            $id_ride
        ]);
    }

    public function getUserRides($id_user): ?array {
        $statement = $this->database->connect()->prepare(
            "select * from users_rides where id_user=:id_user or id_added_by=:id_user"
        );

        $statement->bindParam(":id_user", $id_user, PDO::PARAM_STR);
        $statement->execute();

        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rides) {
            return null;
        }

        $returnRides = [];
        foreach ($rides as $ride) {
            $returnRides[] = new Ride(
                $ride['start'],
                $ride['destination'],
                $ride['number_of_seats'],
                $ride['date'],
                $ride['time'],
                $ride['id'],
                $ride['id_added_by'],
            );
        }

        return $returnRides;
    }

    public function getRidesByStartOrDestination(string $searchString, string $id_user) {
        $searchString = '%'.strtolower($searchString).'%';

        $statement = $this->database->connect()->prepare(
            "select * from users_rides where (lower(start) like :search or lower(destination) like :search)
                    and (id_user=:id_user or id_added_by=:id_user)"
        );

        $statement->bindParam(":search", $searchString, PDO::PARAM_STR);
        $statement->bindParam(":id_user", $id_user, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}