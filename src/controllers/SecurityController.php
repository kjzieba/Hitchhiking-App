<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../models/User.php';

class SecurityController extends AppController {
    public function login() {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $userRepository = new UserRepository();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Invalid password']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function register() {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $userRepository = new UserRepository();

        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatedPassword = $_POST["password-repeat"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if ($password !== $repeatedPassword) {
            return $this->render('register', ['messages' => ['Passwords don\'t match']]);
        }
        if ($userRepository->getUser($email)) {
            return $this->render('register', ['messages' => ['This e-mail address is taken']]);
        }

        $user = new User($email, $hashedPassword, $name, $surname);
        $userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
}