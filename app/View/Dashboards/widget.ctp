<!-- Breadcrumb -->

<div id ="firstScroll">
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Widget",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<meta http-equiv="refresh" content="600" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<?php  
            echo $this->Html->script('jquery.zoomooz.min');
          ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">



window.onload = function() {





		var Weather = {
		gotInput: function(city) {
		        this.url = "http://api.openweathermap.org/data/2.5/weather?q=" + city + "&callback=?";
		        return this.fetch();
		      },
		      convertToFarenheit: function(val) {
		        // return (((val - 273.15) * 1.8) + 32).toFixed(2) + " \u00B0F";
		        var f = (((val - 273.15) * 1.8) + 32).toFixed(2) ;
		        var c = (f -32) * 5 / 9;
		        return c.toFixed(2) + "\u00B0C"
		      },
		      fetch: function() {
		        var that;
		        that = this;
		        return $.ajax({
		          url: that.url,
		          dataType: "json",
		          success: function(data) {
		            
		            if (data.main) {
		              that.weather = {
		                city: data.name,
		                country: data.sys.country,
		                temp: that.convertToFarenheit(data.main.temp),
		                humid: data.main.humidity,
		                weatherdesc: data.weather[0].description
		              };
		              console.log("SUCCESS Connection");
		              // alert(that.convertToFarenheit(data.main.temp));
		              // console.log(that.weather);
		              $("#temp").text(that.weather.temp);
		              $("#city").append(that.weather.city);
		              $("#hum").append(that.weather.humid + ' %');
		              $("#desc").append(that.weather.weatherdesc);
		              return that.weather;
		            } else {
		              // that.attachTemplate(true);
		              return console.log("DATA isn't available");
		            }
		          },
		          error: function(data) {
		            return console.log("ERROR Connection");
		          }
		        });
		    }
		}
		Weather.gotInput("Faisalabad");
}
</script>



<div class="row">
	<div class="col-md-3 col-sm-3">
		<h4 class="page-header themed-background-leaf" style="text-align:center;color:white">Total Complaints :<span style="font-weight: bolder;"> <?php echo $total_complaints; ?></span></h4>

	</div>
	<div class="col-md-3 col-sm-3">
		<h4 class="page-header themed-background-army" style="text-align:center;color:white">Total Pending Complaints : <span style="font-weight: bolder;"><?php echo $total_complaints_pending; ?></span></h4>
	
	</div>
	<div class="col-md-3 col-sm-3">
		<h4 class="page-header themed-background-default" style="text-align:center;color:white">Total Solved Complaints : <span style="font-weight: bolder;"><?php echo $total_complaints_solved; ?></span></h4>
	</div>
	<div class="col-md-3 col-sm-3">
		<h4 class="page-header bg-silver" style="text-align:center">Weather widget</h4>
	</div>	


</div>
<div class="row">
		<div class="col-md-3 col-sm-3">
					<a href="javascript:void(0)" class="col-md-3 col-sm-3 tile tile-width-2x tile-themed themed-background-leaf">
                        <i class="icon-gift"><?php echo $total_complaints_today; ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Today's Complaints</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3">
                    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-army">
                        <i class="icon-gift"><?php echo $total_complaints_pending_today; ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Today's Complaints Seen by Subengineers</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3">
                    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-default">
                        <i class="icon-gift"><?php echo $total_complaints_solved_today; ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Complaints resolved Today</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 bg-silver">
                 <div  class="tile tile-width-2x tile-themed themed-background-stone" style="cursor:pointer">
                 		<h3 class="line_hieght" id="temp">&deg; C</h3>
					  <p class="line_hieght" id="city">City: </p>
					  <p class="line_hieght" id="hum">Humidity: </p>
					  <p class="line_hieght"  id="desc">Description: </p>
                        
                    </div>

				
				</div>

</div>
<div class="row" style="margin-top:20px;">
	<div class="col-md-12 jumbotron zoomTarget" data-targetsize="1.2" data-duration="600" data-closeclick="true">
		<div id="live_data" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</div>
</div>
</div>
<div id="secondScroll">
<div class="row" style="margin-top:20px;">
	<div class="col-md-12 jumbotron zoomTarget" style="height:700px !important" data-targetsize="1.2" data-duration="600" data-closeclick="true">
		<!-- <div class="jumbotron"> -->
			<div id="banner-fade" style="max-width:100% !important;height: 350px !important;margin-top: 60px;">

			        <!-- start Basic Jquery Slider -->
			        <ul class="bjqs" style="height:520px !important">
			        <?php foreach ($main as $key => $each) { ?>
			        	
			        
			        	  <li>
			        	  	<div  class="col-md-12 " style="width:100%;height:700px !important"> 
				        	  	<div id="container_<?php echo $key ?>" style="width:47% !important;height: 500px !important; float:left;">
				        	  	</div>
				        	  	<div id="heat_<?php echo $key ?>" style="width:47% !important;height: 500px !important; float:left;">
				        	  		
				        	  	</div>
			        	  	</div>

			        	  </li>
			        <?php }?>  
			        </ul>
			        <!-- end Basic jQuery Slider -->

      </div>



	<!-- </div> -->
	</div>

</div>
</div>
<div id="thirdScroll" style="position:absolute;width:100%">
<div class="row" style="margin-top:20px">
	<div class="col-md-12 jumbotron">
		
				<div class="col-md-3 col-sm-3">
				<h3>Subdivision</h3>
					<table class="table table-bordered zoomTarget" data-nativeanimation ="true" data-targetsize="1.2" data-duration="600" data-closeclick="true">
		                        <thead>
		                            <tr>
		                                
		                                <th class="hidden-xs hidden-sm">Subdivision</th>
		                                <th class="hidden-xs hidden-sm">Ratio</th>
		                                
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php foreach ($pi_graph as $key_val => $sub) { ?> 
		                            <tr>
		                                <td class="hidden-xs hidden-sm"><?php echo $sub['name'] ?></td>
		                                <td class="hidden-xs hidden-sm"><?php echo round($sub['ratio']*100) ?> %</td>
		                                
		                            </tr>
		                         <?php } ?>
		                            
		                        </tbody>
		            </table>
		        </div>

		        <div class="col-md-6 col-sm-6 zoomTarget" data-nativeanimation ="true" data-targetsize="1.2" data-duration="600" data-closeclick="true">

					<div id="container_pi_map" style="min-width: 310px; height: 400px; max-width: 600px;margin-top: 69px;"></div>
				 </div>
				 <div class="col-md-3 col-sm-3">
				 	<h3>Problematic areas</h3>
					<table class="table table-bordered zoomTarget" data-nativeanimation ="true" data-targetsize="1.2" data-duration="600" data-closeclick="true">
		                        <thead>
		                            <tr>
		                                
		                                <th class="hidden-xs hidden-sm">Colony name</th>
		                                <th class="hidden-xs hidden-sm">Nature</th>
		                                
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>

		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>
		                            <tr>
		                                <td class="hidden-xs hidden-sm">New</td>
		                                <td class="hidden-xs hidden-sm">Good</td>
		                                
		                                
		                            </tr>

		                            
		                        </tbody>
		            </table>
		        </div>
		
	</div>
</div>
</div>
<div style="min-height:617px"></div>
<style type="text/css">
	.col_size{
		width: 24.333333%
	}
	
.line_hieght{
	line-height:0.9;
}
.bjqs-markers,.bjqs-caption{
	display: none;
}
</style>


<?php echo $this->Html->css('bjqs.css');?>
<?php echo $this->Html->css('demo.css');?>
<?php echo $this->Html->script('bjqs-1.3.min.js');?>
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro|Open+Sans:300' rel='stylesheet' type='text/css'>



<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/heatmap.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

	$(function () {

		$('#banner-fade').bjqs({
            height      : 320,
            width       : 620,
            responsive  : true,
            showcontrols : false,
            animspeed : 30000, 
          });






	<?php foreach ($main as $key => $each) { ?>
		
    $("#container_<?php echo $key?>").highcharts({
        title: {
            text: "Graph for Subdivision <?php echo $each['name']?>",
            x: -20 //center
        },
        subtitle: {
            text: "<?php echo $each['name']?>",
            x: -20
        },
        xAxis: {
            categories: [
            <?php foreach ($each['dates'] as $key1 => $value) { ?>
            
                "<?php echo $value['date']; ?>",
            
            <?php } ?>

             ]
        },
        yAxis: {
            title: {
                text: 'No of Complaints'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'No'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [

        {
            name: 'No registerd',
            data: [
            <?php foreach ($each['dates'] as $key1 => $value) { 
            
            echo $value['total_count'].",";
            
             } ?>
            ]
        }, {
            name: 'No Resolved',
            data: [
             <?php foreach ($each['dates'] as $key2 => $value2) { 
            
            echo $value2['total_count_resolved'].",";
            
             } ?>


            ]
        }
        	]
    });





$("#heat_<?php echo $key?>").highcharts({

        chart: {
            type: 'heatmap',
            marginTop: 40,
            marginBottom: 40
        },


        title: {
            text: "<?php echo $each['name']?> Heatmap"
        },

        xAxis: {
            categories: [
            <?php foreach ($each['heatchart'] as $key10 => $value10) { ?>
            
                "<?php echo $users[$key10]; ?>",
            
            <?php } ?>

            

            ]
        },

        yAxis: {
            categories: [
            <?php $first_value =reset($each['heatchart']);
            foreach ($first_value as $key101 => $value101) { ?>
            
                "<?php echo $key101; ?>",
            
            <?php } ?>
            

            ],
            title: null
        },

        colorAxis: {
            min: 0,
            minColor: '#FFFFFF',
            maxColor: Highcharts.getOptions().colors[0]
        },

        legend: {
            align: 'right',
            layout: 'vertical',
            margin: 0,
            verticalAlign: 'top',
            y: 25,
            symbolHeight: 320
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> have <br><b>' +
                    this.point.value + '</b> complaints registerd on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
            }
        },

        series: [{
            name: 'Complainst per user',
            borderWidth: 1,
            data: [
            	<?php $cnt_main =0; ?>
            	<?php foreach ($each['heatchart'] as $key_new => $value_new) { ?>
            		 
            				<?php $cnt=0;?>
            				<?php foreach ($value_new as $day => $number) { ?>
            					<?php if(($number == 0 )&&( $each['status'] !=0)){ ?>
            						[<?php echo $cnt_main ?>,<?php echo $cnt ?>,"<?php echo $number ?>"],
            					<?php } else{ ?>
            						[<?php echo $cnt_main ?>,<?php echo $cnt ?>,<?php echo $number ?>],	
            					<?php } ?>
            				<?php $cnt++;} ?>

            		
            	<?php $cnt_main++; } ?>
            		

            ],
            dataLabels: {
                enabled: true,
                color: 'black',
                style: {
                    textShadow: 'none',
                    HcTextStroke: null
                }
            }
        }]

    });





 	 $('#container_pi_map').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Complaints with their 4 parent categories'
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
            name: 'category',
            data: [
            <?php $firt_cnt =0;
             foreach ($parent_categories as $key_val => $category) { 
             	$firt_cnt++;
             	if($firt_cnt ==1){
             	?>
             		{
                    	name: "<?php echo $category['Category']['name'] ?>",
	                    y: <?php echo $category['Category']['total_complaints_count'] ?>,
	                    sliced: true,
	                    selected: true
	                },

             	<?php } else { ?>
                ["<?php echo $category['Category']['name'] ?>",  <?php echo $category['Category']['total_complaints_count'] ?> ],
                
             		<?php }
         		} ?>
            ]
        }]
    });



	<?php } ?>

	

	$('#live_data').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        // console.log(series);
                        setInterval(function () {
                        	

                        	$.ajax({
					            dataType: "html",
					            type: "POST",
					            evalScripts: true,
					            url: '<?php echo Router::url(array('controller'=>'dashboards','action'=>'count_update'));?>',
					            data: ({type:'original'}),
					            success: function (data, textStatus){
							        console.log(data);
							         var x = (new Date()).getTime();
							          // current time
							         
		                             y = Number(data);
		                            series.addPoint([x, y], true, true);

					            }
					        });



                            
                        }, 5000);
                    }
                }
            },
            title: {
                text: 'Live Complaint\'s data'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Complaint registered today'
                },
                plotLines: [{
                    value: 2,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Complaints number',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -6; i <= 0; i += 1) {
                    	// console.log(point);
                        data.push({
                            x: time + i * 5000,
                            y: <?php echo $total_complaints_today?>
                        });
                    }
                    // console.log(data);
                    return data;
                }())
            }]
        });
});
$(window).load(function () {
    var pos_scroll = 0;
    var scrollTime = 30000;
    var startTime = 100000;
    //normally you'd wait for document.ready, but you'd likely to want to wait
    //for images to load in case they reflow the page
    setTimeout(function () { ChangeTab(); }, scrollTime);
    function ChangeTab(){
        if(pos_scroll == 0){
            window.location.hash = '#secondScroll';
            pos_scroll = 1;
        }
        else if(pos_scroll == 1){
            window.location.hash = '#thirdScroll'; 
            pos_scroll = 2;
        }else if(pos_scroll == 2){
            window.location.hash = '#firstScroll'; 
            pos_scroll = 0;
        }
        
        setTimeout(function () { ChangeTab(); }, scrollTime);
    }
    
});    

</script>
<script type="text/javascript">
$( document ).ready(function() {
	<?php $count =0; ?>
	<?php foreach ($main as $key => $each) { ?>
		thumb = $(".bjqs-markers").children()[<?php echo $count?>];
		$(thumb).html("<a href=\"#\"><?php  echo $each['name'] ?></a>");
	<?php $count++; } ?>
});

</script>
