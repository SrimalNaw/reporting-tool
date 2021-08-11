<?php
require_once(DOC_ROOT.'config/DbConnection.php');

class ReportModel extends DbConnection {

    public function getSelectedReportData($reportType, $fromDate, $toDate) {
        $conn = parent::connect();
        $columns = '';
        $join = '';
        $order = '';
        $data = array();

        if( $reportType == '1' ) {
            $columns = 'br.name as `Brand Name`, ROUND(gmv.turnover * 100/121, 2) as `Total Turnover (Excluding VAT)`, DATE(gmv.date) as Date';
            $join = 'left join brands br on gmv.brand_id = br.id';
            $order = 'gmv.date, br.name';
        } else if( $reportType == '2'  ) {
            $columns = 'DATE(gmv.date) as Date, ROUND(gmv.turnover * 100/121, 2) as `Total Turnover (Excluding VAT)`';
            $order = 'gmv.date';
        }

        $query = "SELECT ". $columns ." FROM gmv ". $join ." where gmv.date between ? and ? order by ". $order ." ";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ss", $fromDate, $toDate);
            $stmt->execute();
            $result = $stmt->get_result();

            $data = $result->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
        } else {
            die('Error: ' . htmlspecialchars($conn->error));
        }
        parent::closeConnection();

        return $data;
    }


}

?>