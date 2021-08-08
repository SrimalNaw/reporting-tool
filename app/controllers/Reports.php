<?php
require_once('BaseController.php');
require_once(DOC_ROOT.'app/models/ReportModel.php');

/**
 *  Manage reports data
 */
class Reports extends BaseController {

    /**
     * Get report data.
     */
    function getReportData($data) {
        $reportData = '';
        if( empty($data['reportType']) ) {
           return parent::returnResponse('error', 400, 'Report type is required');
        }
        if( empty($data['fromDate']) ) {
            return parent::returnResponse('error', 400, 'From date is required');
        }
        if( empty($data['toDate']) ) {
            return parent::returnResponse('error', 400, 'To date is required');
        }

        $reportModel = new ReportModel();
        if($data['reportType'] == '1') {
            $reportData = $reportModel->getTunoverPerBrandData($data['fromDate'], $data['toDate']);
        }
        else if($data['reportType'] == '2') {
            $reportData = $reportModel->getTunoverPerDayData($data['fromDate'], $data['toDate']);
        }
        return parent::returnResponse('success', 200, 'Success', $reportData);
    }

}

?>