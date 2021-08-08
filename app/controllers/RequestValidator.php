<?php

/**
 * Validate Request
 */
class RequestValidator {

    /**
     * Check for Ajax request
     */
    function isAjaxRequest() {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { 
            /* Valid Ajax request */
        } 
        else{ 
            exit(json_encode(['error' => 'Not a valid Ajax request']));
        }
    }
    
    /**
     * Validate CSRF Token
     */
    function validateToken() {
        session_start();

        header('Content-Type: application/json');
        $headers = apache_request_headers();
        if (isset($headers['CsrfToken'])) {
            if ( $_SESSION['csrf_token'] != $headers['CsrfToken'] ) {
                exit(json_encode(['error' => 'Wrong CSRF token.']));
            }
        }
    }


}

?>