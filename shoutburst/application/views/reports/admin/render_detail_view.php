<?php
//get commong button which will display on reporting
$commonButtons		= '';//commonButtons();

$html = <<<HTML
<style>
.rowHeight{
 height:30px;
}

.mainDiv{font-weight:bold; color:#A3CEED;padding:20px;}
.childDiv{padding:4px;}
.childDivContent{color:#53A1F4;}
</style>
<audio id="audio">
    <source src="http://skippy.org.uk/wp-content/uploads/introduction-to-the-beep-test.mp3" type="audio/mp3" />
</audio>
HTML;
if(!empty($logo))
{
$html .=<<<HTML
	<img src='$logo' width="100" height="100" class="shadow" style="position: absolute; right: 15px;">
HTML;
}else
{
        $logo = base_url().COMP_LOGO."/temp_logo.png";

        if (stripos($_SERVER['REQUEST_URI'] ,'wallboard') !== FALSE) {
                $logo_path = "";
        } else {
                $logo_path = "<img src='$logo' width=\"200\" height=\"57\" class=\"shadow\" style=\"position: absolute; top: 15px; right: 15px;z-index:999;\">";

        }

        $html .= $logo_path;
}
$html .=<<<HTML

<div class='report-preview'>
	<div class='row'>
		<div class='col-sm-2 col-field'>Report Name: </div>
		<div class='col-sm-4 col-data'>$report_name </div>
	</div>
	<div class='row'>
		<div class='col-sm-2 col-field'>Report Date: </div>
		<div class='col-sm-4 col-data'>$report_date </div>
	</div>
	<div class='row'>
		<div class='col-sm-2 col-field'>Report Type:</div>
		<div class='col-sm-4 col-data'>$report_type</div>
	</div>
	<p class="countdown"></p>
</div>


HTML;
// insert jw player


/**
 * Record Not Found
 * */

if(isset($errMessage) && $errMessage!=''){
	$html .= <<<HTML
			$errMessage
HTML;
}else{

	$selectedColoumnHeadingArr	=	explode(",",$selectedColoumnHeading);

$html .= <<<HTML
				<div class='col-sm-12'><table class='table-sb'>
					<tr class='dark-blue-title'>
HTML;

//check total is comming from selected data control
$totalSurveyColPosition = array_search('Total Surveys', $selectedColoumnHeadingArr);


/**
 * Set Table Heading HTML
 * */

if(!empty($selectedColoumnHeadingArr)){

	foreach($selectedColoumnHeadingArr as $selectedColoumnHeadingRow)
	{

		$hclass='';
		if($selectedColoumnHeadingRow=="Campaign" || $selectedColoumnHeadingRow=="Agent PIN" || $selectedColoumnHeadingRow=="Agent Name" ||
				 $selectedColoumnHeadingRow=="Dialed Number" || $selectedColoumnHeadingRow=="CLI"  )
		{
			$hclass="background-color: #142a4e;";
		}else if($selectedColoumnHeadingRow=="Notes" || $selectedColoumnHeadingRow=="Recording" || $selectedColoumnHeadingRow=="Transcription" || $selectedColoumnHeadingRow=="Tag" || $selectedColoumnHeadingRow=="Sentiment")
		{
			$hclass="background-color: #209700;";
		}else
		{
			$hclass="background-color: #2254a2;";
		}$selectedColoumnHeadingRow=trim($selectedColoumnHeadingRow);
		$html .= <<<HTML
		<td style='white-space: normal !important;$hclass' class='text-center' $hclass  >
			$selectedColoumnHeadingRow
		</td>
HTML;

	}
}


$html .= <<<HTML
					</tr>
HTML;


/**
 * Set Agent Base Record
 * */

//var_debug($agentRecordData);exit();
if(!empty($dataArr))
{
	//Total
	$overAllTotalArr	=	array();

	//record by agent name
	foreach($dataArr as $agentRecordDataRow)
	{
		if(!empty($agentRecordDataRow))
		{
			$html .= <<<HTML
						<tr>
HTML;
			unset($agentRecordDataRow['agentName']);
			unset($agentRecordDataRow['logo']);
			if($totalSurveyColPosition !== false){

				if($totalSurveyColPosition==0){
					$agentRecordDataRow	=	array_merge(array("totalSurvey" => $agentRecordDataRow['totalSurvey']),$agentRecordDataRow);
				}else{
					$agentRecordDataRow = array_slice($agentRecordDataRow, 0, $totalSurveyColPosition, true) +  array("totalSurvey" => $agentRecordDataRow['totalSurvey']) + array_slice($agentRecordDataRow, $totalSurveyColPosition, count($agentRecordDataRow) - 1, true) ;
				}

			}

			foreach($agentRecordDataRow as $key=>$agentRecordRow)
			{

					$overAllTotalArr[$key][]	=		$agentRecordRow;

				    /*if ($key == "recording") {
						$html .= '<td><a href="http://144.76.168.74/shoutburst/jwplay.php?rec_id='.$agentRecordRow.'" target="_blank">Play</a></td>';
					}
					else {
						$html  .= "<td>$agentRecordRow</td>";
					}*/

					$html  .= "<td>$agentRecordRow</td>";


			}
			$html .= <<<HTML
									</tr>
HTML;
		}
	}


			/**
			 * Total Record
			 * */
			$html .= <<<HTML
								<tr class='overall-total dark-blue'>
HTML;
			if(!empty($overAllTotalArr)){

				$overAllTotalArr	=	array_values($overAllTotalArr);

				foreach($overAllTotalArr as $attrKey=>$overAllTotalRow){

					//filter array sum for strind and undesire column
					$filterForSubtotalDataControl	=	filterForSubtotalDataControl();

					$overAllTotalVal	   =	'-';
					if(in_array($selectedColoumnHeadingArr[$attrKey],$filterForSubtotalDataControl)){
						$overAllTotalVal	=	'-';
					}else{
						$overAllTotalVal	=	array_sum($overAllTotalRow);
					}

					$html .= <<<HTML
									<td >
										<!-- removed $overAllTotalVal -->
									</td>

HTML;
				}
			}

			$html .= <<<HTML
							</tr>
HTML;

}




$html .= <<<HTML
					</table></div>
					<br/>
HTML;
//	var_debug($selectedColoumnHeading);
//var_debug($agentRecordData);
//exit();

}


echo $html;

?>


<script type="text/javascript">


	var base_url_of_website = '<?php echo base_url(); ?>';

</script>


<script>



	$(function(){
	var audio = document.getElementById('audio');
	    $(".music_btn").on("click",function(){
	        var data=$(this).attr("data-src");
	        if(audio.paused){
	        	//audio.currentTime = 0;
	        	$("#audio > source").attr("src",data);
	        	audio.load();
	        	audio.play();
	        	$(".music_btn").attr("src",base_url_of_website+"images/play.png");	
	        	$(this).attr("src",base_url_of_website+"images/pause.png");

	        }
	        else{
	        	if(data == $("#audio > source").attr("src"))
	        	{
	        		audio.pause();
	        		$(this).attr("src",base_url_of_website+"images/play.png");
	        	
	        	}
	        	else
	        	{
	        		audio.pause();
	        		//audio.currentTime = 0;
	        		$("#audio > source").attr("src",data);
	        		audio.load();
	        		audio.play();

	        		$(".music_btn").attr("src",base_url_of_website+"images/play.png");
	        		$(this).attr("src",base_url_of_website+"images/pause.png");
	        			
	        	
	        	}
	        }
	        
	    });
		
	});



</script>

<?php
exit();
?>



