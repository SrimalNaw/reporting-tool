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
					var reportTitle = $('#reportType option:selected').html();
					$('.content-report').removeClass('hide-content');
					$("#report-table tr").remove();
					$('.report-title').text(reportTitle);

					$('#report-table').html(data.data);

					if(data.data == null) {
						$('.content-report').addClass('hide-content');
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