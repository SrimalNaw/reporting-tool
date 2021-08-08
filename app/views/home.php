<?php
    require_once('header.php');
?>

    <div class="container">
        <div class="row justify-content-center mb-4 mt-3">
            <div class="col-4">
                <h1 class="report-head">Reports</h1>
            </div>
            
        </div>

        <div class="row justify-content-center">
            <div class="col-8">
                <form id="generateReport">
                    <div class="row mb-3">
                        <label for="reportType" class="col-sm-3 col-form-label">Select report type</label>
                        <div class="col-sm-8">
                            <select class="form-select" aria-label="Report Type" id="reportType" name="reportType" required>
                                <option value="">-Select Report Type-</option>
                                <option value="1">Turnover per brand</option>
                                <option value="2">Turnover per day</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dateRange" class="col-sm-3 col-form-label">Select Date Range</label>
                        <div class="col-sm-8">
                            <div id="reportrange" name="reportrange" class="form-control">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down icn-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="content-report hide-content mt-4">
            <hr>
            <div class="row justify-content-center">
                <div class="col-6">
                    <h4 class="report-title"></h4>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-4">
                    <button type="button" id="btnCsv" class="btn btn-primary btn-export"><i class="fa fa-download icon-csv" aria-hidden="true"></i>CSV</button>
                </div>
            </div>
            <table class="table table-hover table-bordered" id="report-table">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="row justify-content-center">
                <div class="col-4 content-no-data hide-content"> No Data Available.. </div>
            </div>
        </div>

    </div>

<?php
    require_once('footer.php');
?>