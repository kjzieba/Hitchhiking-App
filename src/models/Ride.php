<?php

class Ride {
    private $start;
    private $destination;
    private $available_seats;
    private $date;
    private $time;
    private $id;
    private $id_driver;

    public function __construct($start, $destination, $available_seats, $date, $time, $id, $id_driver) {
        $this->start = $start;
        $this->destination = $destination;
        $this->available_seats = $available_seats;
        $this->date = $date;
        $this->time = $time;
        $this->id = $id;
        $this->id_driver = $id_driver;
    }

    public function getDriver(): string {
        $userRepository = new UserRepository();
        return $userRepository->getUserByID($this->id_driver)->getName();
    }

    public function getStart() {
        return $this->start;
    }

    public function setStart($start): void {
        $this->start = $start;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function setDestination($destination): void {
        $this->destination = $destination;
    }

    public function getAvailableSeats() {
        return $this->available_seats;
    }

    public function setAvailableSeats($available_seats): void {
        $this->available_seats = $available_seats;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function getTime() {
        return $this->time;
    }

    public function setTime($time): void {
        $this->time = $time;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getIdDriver() {
        return $this->id_driver;
    }

    public function setIdDriver($id_driver): void {
        $this->id_driver = $id_driver;
    }
}