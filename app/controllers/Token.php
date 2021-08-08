<?php

$objToken = new Token();
$token = $objToken->generateToken();

/**
 * Generate csrf token.
 */
class Token {

    public function generateToken() {
        session_start();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

?>