<?php
#echo $report_type;
if (isset($chartData) && !empty($chartData)){
	
	echo '<div id="graph"><i>Loading graph...</i></div>';
	
	if ($report_type == 'Bar Chart'){
		$chartData = str_replace("'", '"', $chartData);
?>
<script type="text/javascript">
	var myData = new Array(<?php echo $chartData?>);
	var colors = [<?php echo $colorThemes?>];
	var maxScore = <?php echo $maxScore?>;
	var myChart = new JSChart('graph', 'bar');

	var chartWidth		=	<?php echo $chartWidth?>;
	var chartHeight		=	<?php echo $chartHeight?>;

	var fullView		= '<?php echo $fullView; ?>';

	if(fullView=='full_view')
	{
		chartWidth = ($(window).width() - 17);	// returns height of browser window document
		chartHeight = ($(document).height() -16); // returns height of HTML document
	}
	
	myChart.setDataArray(myData);
	myChart.colorizeBars(colors);
	myChart.setTitle('<?php echo $graphTitle?>');
	myChart.setTitleFontFamily('Helvetica');
	myChart.setTitleFontSize(<?php echo $titleFontSize?>);
	myChart.setTitleColor('#53A1F4');
	myChart.setSize(chartWidth, chartHeight);
	myChart.setBackgroundColor('<?php echo $background_color?>');
	myChart.setAxisNameX('<?php echo $X_Axis?>');
	myChart.setAxisNameY('<?php echo $Y_Axis?>');
	myChart.setAxisValuesAngle(45);
	myChart.setTitleFontSize(<?php echo $fontSize?>);
	myChart.setBarSpacingRatio(50);
	myChart.setAxisPaddingTop(50);
    myChart.setAxisPaddingBottom(100);
    myChart.setAxisPaddingLeft(50);
    myChart.setAxisPaddingRight(60);
	myChart.setBarValues(false);
	myChart.setBarOpacity(1);
	myChart.setAxisWidth(1);
	if(maxScore!=0){
		myChart.setIntervalEndY(maxScore)
	}
	myChart.set3D(true);
	myChart.draw();
</script>
<?php
	} elseif ($report_type == 'Line Graph'){
?>		
		<script type='text/javascript'>			
			var myColor			= [<?php echo $colorThemes?>]
			var	lineName 		= [<?php echo $lineChartAgentName?>];
			var areaName		= [<?php echo $lineChartAxisName?>];
			var grapgTitle		= '<?php echo $graphTitle?>';
			var agentLineData 	= eval(<?php echo $chartData?>);
			
			var chartWidth		=	<?php echo $chartWidth?>;
			var chartHeight		=	<?php echo $chartHeight?>;
			
			var fullView		= '<?php echo $fullView?>';

			if(fullView=='full_view')
			{
				chartWidth = ($(window).width() - 17);	// returns height of browser window document
				chartHeight = ($(document).height() - 16); // returns height of HTML document
				//alert(chartWidth+' --------------- '+chartHeight);
			}
			
			var myData = new Array();
			
			for(var i=0;i<lineName.length;){
				var agentName = lineName[i];
				var agentData = agentLineData[agentName];				
				myData[i] 	  = agentData;
				i++;
			}
			
			var myChart = new JSChart('graph', 'line');
		
			for(var i=0;i<lineName.length;){
				myChart.setDataArray(myData[i], lineName[i]);
				myChart.setLineColor(myColor[i], lineName[i]);
		
				for(var j=0;j<myData[i].length;){
					var str	 =	myData[i][j]; 
					myChart.setTooltip([str[0], ' '+lineName[i]+' $Y_Axis in '+areaName[j]+' is : '+ str[1],lineName[i]]);
					j++;
				}
				i++;				
			}
			myChart.setLegendShow(true);
			myChart.setTitleFontFamily('Helvetica');
			myChart.setLegendFontSize(10);
			myChart.setLegendPosition('right top');
			myChart.setAxisNameX('<?php echo $X_Axis?>');
			myChart.setAxisNameY('<?php echo $Y_Axis?>');
			myChart.setBackgroundColor('<?php echo $background_color?>');
			myChart.setSize(chartWidth, chartHeight);
			myChart.setTitle(grapgTitle);
			myChart.setTitleColor('#5555AA');
			myChart.setTitleFontSize(<?php echo $fontSize?>);
			myChart.setAxisValuesAngle(60);
			myChart.setAxisPaddingTop(50);
		    myChart.setAxisPaddingBottom(110);
		    myChart.setAxisPaddingLeft(50);
			myChart.draw();
			</script>
<?php			
	} elseif ($report_type == 'Pie Chart'){

		$html = "
		<script type='text/javascript'>

			var myData	    = new Array($chartData);
		    var colors 		= [$colorThemes];
		    var dataSize	=	myData.length;
		  
		    var chartWidth		=	$chartWidth;
			var chartHeight		=	$chartHeight;
			
			var fullView		= '$fullView';
			if(fullView=='full_view')
			{
				chartWidth = ($(window).width() - 17);	// returns height of browser window document
				chartHeight = ($(document).height() - 16); // returns height of HTML document
			}
		    
			var myChart = new JSChart('graph', 'pie');
			myChart.setDataArray(myData);
			myChart.colorize(colors);
			myChart.setSize(chartWidth, chartHeight);
			myChart.setTitle('$graphTitle');
			myChart.setTitleColor('#53A1F4');
			myChart.setTitleFontFamily('Helvetica');
			myChart.setTitleFontSize($fontSize);
			myChart.setBackgroundColor('$background_color');
			myChart.setPieValuesColor('#FFFFFF');
			myChart.setPieValuesFontSize(9);
			myChart.setPiePosition($pie_x,$pie_y);
			myChart.setShowXValues(true);
			myChart.setShowYValues(true);
			
			for(var i=0; i<dataSize ; i++){
				
				var arrayElement = myData[i];
				var colorCode    = colors[i];
				
				var xAxis	= arrayElement[0];
				var yAxis   = arrayElement[1];
				
				var message = '$Y_Axis = '+yAxis+' found '+xAxis;
				myChart.setLegend(colorCode, message);
				
			}
			
			myChart.setLegendShow(true);
			myChart.setLegendFontFamily('Helvetica');
			myChart.setLegendFontSize($legendFontSize);
			myChart.setLegendPosition($pie_leg_pos_x, $pie_leg_pos_y);
			myChart.setPieAngle(45);
			myChart.setPieRadius($pieRadius);
			myChart.set3D(true);
			myChart.draw();
		</script>";

	echo $html;
	}
	
} else {
	echo $errMessage; 
}
?>