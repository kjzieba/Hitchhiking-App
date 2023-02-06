<?php


require_once 'AppController.php';

class RidesController extends AppController {
    public function home() {
        $this->render('home');
    }

    public function search() {
        $this->render('search-results');
    }

    public function ride() {
        $this->render('add-ride');
    }
}