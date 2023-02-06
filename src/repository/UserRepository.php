<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {
    public function getUser(string $email): ?User {
        $statement = $this->database->connect()->prepare(
            "select * from users u JOIN user_details ud on u.id_user_details = ud.id where u.email = :email"
        );

        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
        );
    }

    public function addUser(User $user) {
        $statement = $this->database->connect()->prepare(
            "insert into user_details (name,surname)
            values (?,?) returning id"
        );
        $statement->execute([
            $user->getName(),
            $user->getSurname()
        ]);

        $id = $statement->fetchColumn();

        $statement = $this->database->connect()->prepare(
            "insert into users (email,password, id_user_details)
            values (?,?,?)"
        );
        $statement->execute([
            $user->getEmail(),
            $user->getPassword(),
            $id
        ]);
    }
}