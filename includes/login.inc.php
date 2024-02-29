<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors=[];

        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Preencha todos os campos!";
        }

        $result = get_email($pdo, $email);

        if (is_email_wrong($result, $email)) {
            $errors['login_incorrect'] = "Dados incorretos!";
        }
        if (!is_email_wrong($result, $email) && is_pwd_not_right($pwd, $result)) {
            $errors['login_incorrect'] = "Dados incorretos!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header ("Location:../login.php");
            die();
        } 

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);
        $_SESSION["last_regeneration"] = time();

        header("Location:../Portal.php");
        $pdo = null;
        $stmt = null;
        die();
        
    } catch (PDOException $e) {
        header("Location:../index.php");
        die();
    }
}