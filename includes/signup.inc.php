<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd1 = $_POST ["pwd1"];
    $pwd2 = $_POST ["pwd2"]; //não sei como vou fazer a comparação ainda 

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        $errors=[];

        if (is_input_empty($name, $email, $pwd1, $pwd2)) {
            $errors["empty_input"] = "Preencha todos os campos!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Endereço de email inválido";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "Email já cadastrado";
        }

        if (is_pwd_wrong($pwd1, $pwd2)) {
            $errors["pwd_wrong"] = "Senhas incompatíveis";
        } else {
            $pwd = $pwd1;
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header ("Location:../cadastro.php");
            die();
        } 

        create_user($pdo, $name, $email, $pwd);

        header ("Location:../Portal.php");
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location:../index.html");
    die();
}