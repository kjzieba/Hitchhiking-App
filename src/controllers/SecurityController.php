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

        setcookie("user", $user->getName(), time() + 60 * 20, "/");
        setcookie("email", $email, time() + 60 * 20, "/");

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

        $user = new User($email, $hashedPassword, $name, $surname, -1, -1);
        $userRepository->addUser($user);

        setcookie("user", $name, time() + 60 * 20, "/");
        setcookie("email", $email, time() + 60 * 20, "/");

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function logout() {
        if (isset($_COOKIE['user'])) {
            setcookie("user", $_COOKIE["user"], time() - 3600, "/");
            setcookie("email", $_COOKIE["email"], time() - 3600, "/");
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function admin() {
        if (!isset($_COOKIE['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        if (!$this->isAdmin($_COOKIE['email'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }
        $userRepository = new UserRepository();
        $users = $userRepository->getAllUsers();
        $this->render('admin', ['users' => $users]);

    }

    public function delete($id) {
        if(!$this->isPost()){
            $this->admin();
        }

        if (!isset($_COOKIE['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        if (!$this->isAdmin($_COOKIE['email'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        $userRepository = new UserRepository();
        $userRepository->deleteUser($id);

        $this->admin();
    }

    private function isAdmin($email): bool {
        $userRepository = new UserRepository();
        $userRole = $userRepository->getUser($email)->getRole();
        if ($userRole != 1) {
            return false;
        } else {
            return true;
        }
    }
}