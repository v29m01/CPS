<?php

if (!function_exists('password_hash')) {
    define('PASSWORD_BCRYPT', 1);

    function password_hash($password, $algo, $options = array()) {
        if ($algo !== 1) {
            trigger_error("password_hash(): Unknown hashing algorithm: $algo", E_USER_WARNING);
            return null;
        }

        $cost = isset($options['cost']) ? $options['cost'] : 10;

        // Salt generation
        $salt = str_replace('+', '.', base64_encode(sha1(mt_rand(), true)));
        $salt = substr($salt, 0, 22);

        return crypt($password, '$2y$' . str_pad($cost, 2, '0', STR_PAD_LEFT) . '$' . $salt);
    }

    function password_verify($password, $hash) {
        return crypt($password, $hash) === $hash;
    }
}

?>