<?php

class BaseController {

    /**
     * Return the response.
     */
    protected function returnResponse($type, $code, $message, $data = '') {
        http_response_code($code);
        $result = array(
            'type' => $type,
            'message' => $message,
            'data' => $data,
            'status_code' => $code
        );

        return $result;
    }
}

?>