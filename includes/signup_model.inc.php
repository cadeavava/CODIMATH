<?php

declare(strict_types = 1);

function get_email (object $pdo, string $email) {
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query); //P/ separar query dos dados enviados pelo user
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user (object $pdo, string $name, string $email, string $pwd) {
    $query = "INSERT INTO users (name, pwd, email) VALUES (:name, :pwd, :email); ";
    $stmt = $pdo->prepare($query); //P/ separar query dos dados enviados pelo user

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);



    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->execute();
}