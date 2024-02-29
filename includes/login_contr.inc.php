<?php

declare (strict_types = 1);

function is_email_wrong(array|bool $result, string $email) {
    if (!is_array($result) || $result["email"] !== $email) {
        return true; // Email não encontrado ou não corresponde ao email no banco de dados
    } else {
        return false; // Email encontrado e corresponde ao email no banco de dados
    }
}

function is_pwd_not_right(string $pwd, array $result) {
    if (password_verify($pwd, $result["pwd"])) {
        return false; // Senha está correta
    } else {
        return true; // Senha está incorreta
    }
}

function is_input_empty (string $email, string $pwd) {
    if (empty ($email) || empty ($pwd)) {
        return true;
    } else {
        return false;
    }
}