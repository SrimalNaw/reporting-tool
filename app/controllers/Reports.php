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
        $reportData = $reportModel->getSelectedReportData($data['reportType'], $data['fromDate'], $data['toDate']);
        if($reportData) {
            $reportView = parent::getReportTemplate($reportData);
        } else {
            $reportView = null;
        }
        return parent::returnResponse('success', 200, 'Success', $reportView);
    }

}

?>