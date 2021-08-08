<?php
require_once(DOC_ROOT.'config/DbConnection.php');

class ReportModel extends DbConnection {

    public function getTunoverPerBrandData($fromDate, $toDate) {
        $conn = parent::connect();

        $query = "SELECT br.name, ROUND(gmv.turnover * 100/121, 2) as total_turnover, gmv.date FROM gmv left join brands br on gmv.brand_id = br.id 
                    where gmv.date between ? and ? order by gmv.date, br.name";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $fromDate, $toDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        parent::closeConnection();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTunoverPerDayData($fromDate, $toDate) {
        $conn = parent::connect();

        $query = "SELECT date, ROUND(gmv.turnover * 100/121, 2) as total_turnover FROM reporting_tool.gmv 
                    where gmv.date between ? and ? order by gmv.date";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $fromDate, $toDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        parent::closeConnection();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


}

?>