<?php
use PHPUnit\Framework\TestCase;
use App\Controllers\Reports;

class ReportTest extends TestCase {

    private $reports;

    public function setUp() : void {
        $this->$reports = new Reports;
    }

    public function testGetReportData() {
        /* Not completed  */
    }
}

?>