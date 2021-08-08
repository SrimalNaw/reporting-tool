$(function() {
	var base_url = $('#base_url').val();

	$( "#generateReport" ).submit(function( event ) {
		event.preventDefault();

		$(".content-no-data").addClass('hide-content');

	 	let form = $('#generateReport')[0];
        let data =  new FormData(form);

        let arr = $('#reportrange span').text().split('-');
        let fromDate = moment(new Date(arr[0])).format("YYYY-MM-DD");
        let toDate = moment(new Date(arr[1])).format("YYYY-MM-DD");

        data.append('fromDate', fromDate);
        data.append('toDate', toDate);

	    $.ajax({
	        type: "POST",
            url: base_url + "app/controllers/ReportHandler.php/",
            headers : {
                'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
	        dataType: 'json',
	        data: data,
	        processData: false,
			contentType: false,
	        success: function(data){
	        	if(data.status_code == 200) {
					var reportType = $('#reportType').val();
					var reportTitle = $('#reportType option:selected').html();
					$('.content-report').removeClass('hide-content');
					$("#report-table tr").remove();
					$('.report-title').text(reportTitle);

					if(reportType == '1') {
						$("#report-table thead").append("<tr><th> Brand Name</th><th>Total Turnover (excluding VAT)</th><th>Date</th></tr>");
						$.each(data.data, function(i, value) {
							$("#report-table tbody").append("<tr><td>" + value.name + "</td><td>" + value.total_turnover + "</td><td>" + value.date +"</td></tr>");
						});
					}
					else if(reportType == '2') {
						$("#report-table thead").append("<tr><th> Date</th><th>Total Turnover (excluding VAT)</th></tr>");
						$.each(data.data, function(i, value) {
							$("#report-table tbody").append("<tr><td>" + value.date + "</td><td>" + value.total_turnover + "</td></tr>");
						});
					}

					if(data.data.length == 0) {
						$(".content-no-data").removeClass('hide-content');
					}
					
	        	}
	        },
	        error:function(error)
	        {
				console.log(error);
	        }
	    });	  
	});

	$('#btnCsv').click(function() {
		exportCsv();
	});

	function exportCsv() {
		var reportTitle = $('.report-title').text();
		$("#report-table").table2csv({
			separator: ',',
			newline: '\n',
			quoteFields: true,
			excludeColumns: '',
			excludeRows: '',
			trimContent: true,
			filename: reportTitle + '.csv'
		  });

	}

	$('#reportType').change(function() {
		$('.content-report').addClass('hide-content');
	});

});