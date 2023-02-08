<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {
    public function getUser(string $email): ?User {
        $statement = $this->database->connect()->prepare(
            "select *
                    from users u
                        join user_details ud on u.id_user_details = ud.id
                        join roles r on u.id = r.id_user
                    where u.email = :email"
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
            $user['id_user'],
            $user['role']
        );
    }

    public function getUserByID(string $id): ?User {
        $statement = $this->database->connect()->prepare(
            "select *
                    from users u
                        join user_details ud on u.id_user_details = ud.id
                        join roles r on u.id = r.id_user
                    where u.id = :id"
        );

        $statement->bindParam(":id", $id, PDO::PARAM_STR);
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
            $user['id_user'],
            $user['role']
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
            values (?,?,?) returning id"
        );
        $statement->execute([
            $user->getEmail(),
            $user->getPassword(),
            $id
        ]);

        $id = $statement->fetchColumn();

        $statement = $this->database->connect()->prepare(
            "insert into roles (role,id_user)
            values (?,?)"
        );

        $statement->execute([
            0,
            $id
        ]);
    }
}