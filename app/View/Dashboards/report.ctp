               <!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Report",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
			<div class="row">
				<div class="col-md-12 col-xs-5" >
					
				  	<div id="subdivision_div">
					<table class="table table-bordered table-hover" id="table_sub">
		                        <thead>
		                            <tr>
		                                
		                                <th class="hidden-xs hidden-sm">Subdivision Name</th>
		                                <th class="hidden-xs hidden-sm">Resolved Complaints Count</th>
		                                <th class="hidden-xs hidden-sm">Pending Complaints Count</th>
		                                
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php foreach ($subdivisions_data as $id => $subdivisions_each) { ?>
		                        
		                        
		                            <tr>
		                                <td class="hidden-xs hidden-sm"><?php echo $subdivisions_each['sub_name'] ?></td>
		                                <td class="hidden-xs hidden-sm"><?php echo $subdivisions_each['total_complaints_solved'] ?></td>
		                                <td class="hidden-xs hidden-sm"><?php echo $subdivisions_each['total_complaints_pending'] ?></td>
		                                
		                            </tr>
		                        <?php } ?>
		                        </tbody>
		            </table>
		            </div>

		            <button type="button" id="print_sub_tab" class="btn btn-primary" style="float:right;">Print</button>
				
				

			  </div>
			  
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-5">
					<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-12 col-xs-5">
				   <div id="last_week">
					<table class="table table-bordered table-hover">
		                        <thead>
		                            <tr>
		                                
		                                <th class="hidden-xs hidden-sm">Date</th>
		                                <th class="hidden-xs hidden-sm">Total Complaints Count</th>
		                                
		                                
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php foreach ($last_week as $key1 => $date_each) { ?>
		                        
		                        
		                            <tr>
		                                <td class="hidden-xs hidden-sm"><?php echo $date_each['date'] ?></td>
		                                <td class="hidden-xs hidden-sm"><?php echo $date_each['total_complaints'] ?></td>
		                                
		                                
		                            </tr>
		                        <?php } ?>
		                        </tbody>
		            </table>
		            </div>

		            <button type="button" id="print_last_week" class="btn btn-primary" style="float:right;">Print</button>

				</div>
			</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/heatmap.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script>

		$("#print_last_week").click(function () {
            var divContents = $("#last_week").html();
            var printWindow = window.open('', '', 'height=800,width=800');
            printWindow.document.write('<html><head><title>Last Week Details</title>');
            printWindow.document.write('</head><body ><h3 style="margin-left: 42%;">Last Week Details</h3>');
            // console.log(divContents);
            printWindow.document.write(divContents);
            printWindow.document.write('<style type="text/css">table { margin:auto; border-collapse: collapse;}table, th, td{border: 1px solid black;}td ,th {  text-align: center;height: 50px;padding: 10px;}</style>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });


		$("#print_sub_tab").click(function () {
            var divContents = $("#subdivision_div").html();
            var printWindow = window.open('', '', 'height=800,width=800');
            printWindow.document.write('<html><head><title>Subdivision Data</title>');
            printWindow.document.write('</head><body ><h3 style="margin-left: 42%;">Subdivision Data</h3>');
            // console.log(divContents);
            printWindow.document.write(divContents);
            printWindow.document.write('<style type="text/css">table { margin:auto;border-collapse: collapse;}table, th, td{border: 1px solid black;}td ,th {  text-align: center;height: 50px;padding: 10px;}</style>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Subdivision\'s Complaints'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Subdivision',
            data: [
                
            	 <?php $firt_cnt =0;
             foreach ($subdivisions_data as $key_val => $sub) { 
             	$firt_cnt++;
             	if($firt_cnt ==1){
             	?>
             		{
                    	name: "<?php echo $sub['sub_name'] ?>",
	                    y: <?php echo $sub['total_complaints'] ?>,
	                    sliced: true,
	                    selected: true
	                },

             	<?php } else { ?>
                ["<?php echo $sub['sub_name'] ?>",  <?php echo $sub['total_complaints'] ?> ],
                
             		<?php }
         		} ?>


            ]
        }]
    });
});

</script>