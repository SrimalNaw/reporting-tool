$(function() {

    // var start = moment().subtract(6, 'days');
    // var end = moment();

    var start = 'May 1, 2018';
    var end = 'May 7, 2018';

    function cb(start, end) {
        $('#reportrange span').html((moment(new Date(start)).format("MMMM D, YYYY")) + ' - ' + moment(new Date(end)).format("MMMM D, YYYY"));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        }
    }, cb);

    cb(start, end);

});