<?php
require_once('../../config/config.php');
require_once('Reports.php');
require_once('RequestValidator.php');

/**
 * Validate request
 */
$requestValidator = new RequestValidator();
$requestValidator->isAjaxRequest();
$requestValidator->validateToken();

if ( isset( $_POST['reportType'] )) {
    $reports = new Reports();
    $result = $reports->getReportData( $_POST );
    echo json_encode($result);
}

?>