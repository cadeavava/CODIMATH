<?php

declare(strict_types = 1);

function is_input_empty (string $name, string $email, string $pwd, string $pwd2) {
    if (empty ($name) || empty ($email) || empty ($pwd) || empty ($pwd2)) {
        return true;
    } else {
        return false;
    }
}

function is_pwd_wrong (string $pwd1, string $pwd2) {
    if ($pwd1 != $pwd2) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid (string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered (object $pdo, string $email) {
    if (get_email ($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $name, string $email, string $pwd) {
    set_user ($pdo, $name, $email, $pwd);
}