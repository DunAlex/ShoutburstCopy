<?php echo form_open_multipart('reports/', array('name'=>'add_report', 'id'=>'add_report', 'onsubmit'=>"return check_it(this)")) ?>
<?php echo $this->session->flashdata('message');?>
<div id="content">
<div class="container">
<div id="report_content" class="cf"><!--<input type="button" onclick="gen_pdf()" value="PDF" />-->
    <!-- Step 1 -->
    <div id="step_1">
        <div class="row content-header">        
	        <a class="sb-btn sb-btn-white" onclick="report_list(); clearContent(); liveChartIntervalRemove(); return false;" href="javascript:;">Cancel</a>
			<?php echo heading('Report Creation', 1);?>
        </div><!-- .row -->
        <div class="row content-body">
            <div class="col-sm-6">
                <div class="form-horizontal sb-form">
               
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="report_name">Report Name</label>
                        <div class="col-sm-6">
                            <input type="text" value="" name="report_name" id="report_name" class="sb-control" placeholder="Report name" autofocus>
                            <div id='reportNameErr' style='color:red;diplay:none;'></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="report_type">Report Type:</label>
                        <div class="col-sm-6">
                            <select id="report_type" class="sb-control" name="report_type">
                                <?php foreach ($report_types as $rt){?>
                                <option value="<?php echo strtolower( $rt->type_name )?>"><?php echo $rt->type_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id='reportPeriodRegion'>
                        <label class="col-sm-6 control-label" for="report_period">Report Period:</label>
                        <div class="col-sm-6">
                            <select id="report_period" class="sb-control" name="report_period" onChange='reportPeriodOptionCheck();'>
                                <?php foreach ($report_periods as $rp){?>
                                <option value="<?php echo strtolower( $rp->rep_prd_name )?>"><?php echo $rp->rep_prd_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="customDateRegion" style='display:none;'>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="datepicker">
                                Start Date
                            </label>
                            <div class="col-sm-6 sb-date-picker">
                                <input type="text" name='start_date' id="datepicker" class='datePicker sb-control'>
                          	 	
                                 <div id='start_dateErr' style='color:red;diplay:none;'></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="datepicker2">
                                End Date
                            </label>
                            <div class="col-sm-6 sb-date-picker">
                                <input type="text" name='end_date' id="datepicker2" class='sb-control datePicker'>                               
                                 <div id='end_dateErr' style='color:red;diplay:none;'></div>
                            </div>
                            
                        </div>
                    </div><!-- .customDateRegion -->
                    
                    <div class="form-group customDayRegion" style='display:none;'>
                        <label class="col-sm-6 control-label" for="custom_date">Select Date:</label>
                        <div class="col-sm-6 sb-date-picker">
                            <input type="text" name='custom_date' id="custom_date" class='sb-control datePicker'>
                        
                            <div id='customDateErr' style='color:red;display:none;'></div>
                        </div>
                        
                    </div>
                    <div class="form-group" id='reportInetrvalRegion'>
                        <label class="col-sm-6 control-label" for="report_interval">Intervals:</label>
                        <div class="col-sm-6">
                            <select id="report_interval" class="sb-control" name="report_interval">
                                <?php foreach ($report_intervals as $ri){?>
                                <option value="<?php echo strtolower( $ri->rep_interval_name )?>"><?php echo $ri->rep_interval_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="output_requirements_div" >
                        <label class="col-sm-6 control-label" for="op_req">Output Requirements:</label>
                        <div class="col-sm-6">
                            <select name="op_req" class="sb-control" id="op_req">    
                             <option value="">Select</option>                           
                                <option value="email">Email</option>
                                  <option value="data">On Screen</option>
                                    <option value="ftp">FTP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="email_tr" style="display:none;">
                        <label class="col-sm-6 control-label" for=""></label>
                        <div class="col-sm-6">
                            <textarea name="email_address" rows="3" cols="10" class="sb-textarea" placeholder="Add email addresses [comma separated] ..."></textarea>
                        </div>
                    </div>
                    <!-- #email_tr -->
                    <div id="ftp_tr" style="display:none;">
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="ftp_host_name">Host:</label>
                            <div class="col-sm-6">
                                <input type="text" class="sb-control" name="ftp_host_name" id="ftp_host_name" placeholder="Host" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="ftp_port">Port:</label>
                            <div class="col-sm-6">
                                <input type="text" class="sb-control" name="ftp_port" id="ftp_port" placeholder="Port" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="ftp_user_name">Username:</label>
                            <div class="col-sm-6">
                                <input type="text" class="sb-control" name="ftp_user_name" id="ftp_user_name" placeholder="Username" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="ftp_password">Password:</label>
                            <div class="col-sm-6">
                                <input type="text" class="sb-control" name="ftp_password" id="ftp_password" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                    <!-- #ftp_tr -->
                    <div class="form-group" id="assigned">
                        <label class="col-sm-6 control-label" for="">Assigned?</label>
                        <div class="col-sm-6">
                            <input type="checkbox" id="dashboard" name="dashboard">
                            <label for="dashboard"><span></span>Dashboard</label>
                            <br>
                            <input type="checkbox" id="wallboard" name="wallboard">
                            <label for="wallboard"><span></span>Wallboard</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="">Privacy:</label>
                        <div class="col-sm-6">
                            <input type="radio" id="private" name="privacy" value="private" checked="checked">
                            <label for="private"><span></span>Private</label>
                            <br>
                            <input type="radio" id="global" name="privacy" value="global">
                            <label for="global"><span></span>Global</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-6 control-label" for=""></label>
                        <div class="col-xs-6">
                            <input type="hidden" name="op_req_flag" id="op_req_flag" value="data" />
                            <input type="button" class="sb-btn sb-btn-green" value="Next" name="btn_step_2" id="btn_step_2" onclick="next_step(2,1); setXAxisLabel(); " />
                        </div>
                    </div>
                </div>
                <!-- .form-horizontal .sb-form -->
            </div>
            <!-- .col-sm-12 -->
        </div>
        <!-- .content-body -->
    </div>
    <!--// Step 1 -->
    <!-- Step 2 -->
    <div id="step_2" style="display:none;">
        <div class="row content-header">
        	<a class="sb-btn sb-btn-white" onclick="report_list(); clearContent();  return false;" href="javascript:;">Cancel</a>
        	<?php echo heading('Data Control', 1);?>
        </div>
        <!-- .row -->



        <div class="row content-body">
            <div class="col-sm-12">
                <div class="row dragdrop-wrap data-control">
					<div class="col-xs-6">
						<h3 class="hidden-xs">Drag from here</h3>
						<div class="row">
							<div class="col-sm-12">
                                                                <span>Reference</span>
                                                                <ul id="sort1" class="dragdrop ddsmall">
                                                                        <li class="general">Campaign</li>
                                                                        <li class="general">Agent PIN</li>
                                                                        <li class="general">Agent Name</li>
                                                                        <li class="general">Dialed Number</li>
                                                                        <li class="general">CLI</li>                            
                                                                </ul>
                                                                <span>Numerical</span>
                                                                <ul id="sort1" class="dragdrop ddsmall">
                                                                        <li class="score">Q1 Score</li>
                                                                        <li class="score">Q2 Score</li>
                                                                        <li class="score">Q3 Score</li>
                                                                        <li class="score">Q4 Score</li>
                                                                        <li class="score">Q5 Score</li>
                                                                        <li class="score">Total Score</li>
                                                                        <li class="score">Total Surveys</li>
                                                                        <li class="score">NPS</li>
                                                                        <li class="score">Adjusted NPS</li>
                                                                </ul>
                                                                <span>Detail</span>
                                                                <ul id="sort1" class="dragdrop ddsmall">
                                                                        <li class="detail">Sentiment</li>
                                                                        <li class="detail">Recording</li>
                                                                        <li class="detail">Transcription</li>
                                                                        <li class="detail">Notes</li>
                                                                        <li class="detail">Tag</li>
                                                                </ul>
							</div>
						</div><!-- .row -->
					</div><!-- .col-sm-6 -->
					
					<!-- Hidding right arrow on small devices i.e. smart phone -->
					<div class="col-sm-2 hidden" style="text-align: center;"> <span class="glyphicon glyphicon-arrow-right" style="font-size: 60px; margin-top:200px; color:#666;"></span> </div>
					<!-- Showing down arrow on small devices -->
					<div class="col-xs-12 visible-xs" style="text-align: center;"> <span class="glyphicon glyphicon-arrow-down" style="font-size: 60px; margin: 20px auto; color:#666;"></span> </div>
					<!-- Showing clear and spacing on small devices -->
					<div class="clearfix visible-xs" style="margin-top: 20px;"></div>
					
					<div class="col-sm-6">
					  <h3 class="hidden-xs">Output Fields</h3>
					  <div class="row">
						<div class="col-sm-12">
							<ul id="sort2" class="dragdrop makTest">
							</ul>
						</div>
					  </div>
					</div><!-- .col-sm-6 -->
                
                </div><!-- .row -->
			
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-horizontal sb-form">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input type="button" class="sb-btn sb-btn-white" value="Back" name="btn_step_1" id="btn_step_1" onclick="next_step(1,2);" />
                                </div>
                                <div class="col-xs-6">
                                    <input type="button" class="sb-btn sb-btn-green" value="Next" name="btn_step_3" id="btn_step_3" onclick="save_fields();" />
                                </div>
                            </div>
                        </div>
                        <!-- .form-horizontal .sb-form -->
                    </div>
                </div>
                <!-- .row -->
            </div>
            <!-- .col-sm-12 -->
        </div>
        <!-- .content-body -->
    </div>
    <!--// Step 2 -->
    <!-- Step 3 -->
    <div id="step_3" style="display:none;">
        <div class="row content-header">
        	<a class="sb-btn sb-btn-white" onclick="report_list(); clearContent(); return false;" href="javascript:;">Cancel</a>
        	<?php echo heading('Filter', 1);?>
        </div>
        <!-- .row -->
        <div class="row content-body">
            <div class="col-sm-12">
                <div class="row form-group">
                    <div class="col-xs-2 col-w-110"> Condition </div>
                    <div class="col-xs-3"> Data Type </div>
                    <div class="col-xs-3"> Filter </div>
                    <div class="col-xs-3"> Detail </div>
                </div>
                
              
                
                <div class="_extraPersonTemplate relative">
                    <div class="controls controls-row">
                        <div class="form-group row">
                        	<div class='col-xs-2 col-w-110'></div>
                            <div class="col-xs-3">
                                <select class="span2 sb-control" id="data_type" name="data_type[]" onchange="getval(this);">
                                	<option value="">Select</option>
                                    <option value="user_pin">Agent PIN</option>
                                    <option value="full_name">Agent Name</option>
                                    <option value="dialed_number">Dialled Number</option>
                                    <option value="cli">CLI</option>
                                    <option value="q1">Q1 score</option>
                                    <option value="q2">Q2 score</option>
                                    <option value="q3">Q3 score</option>
                                    <option value="q4">Q4 score</option>
                                    <option value="q5">Q5 score</option>
                                    <option value="total_score">Total Score</option>
                                    <option value="average_score">Average Score</option>
                                    <option value="recording">Recording</option>
                                    <option value="transcription_id">Transcription ID</option>
                                    <option value="sentiment_score">Sentiment Score</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select class="span2 sb-control" id="filter" name="filter[]">
                                 	<option value="">Select</option>
                                    <option value="e">Equal</option>
                                    <option value="ne">Not Equal</option>
                                    <option value="gt">Greater Than</option>
                                    <option value="lt">Less Than</option>
                                    <option value="b">Between</option>
                                     <option value="like">Like</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <input class="span3 sb-control" placeholder="Detail" type="text" id="detail" name="detail[]"><span id="detailbox"></span>

                                 <!--<span><i>Note: Add values (comma separated)</i></span>-->
                            </div>                            
                        </div>                        
                    </div>
                    <!-- .controls .controls-row -->
                </div>
                <!-- .extraPersonTemplate -->
                <div id="container"></div>
                <a href="#" class="report-filter-icon-add-row" id="addRow"><span class="glyphicon glyphicon-plus-sign green"></span></p></a>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-horizontal sb-form">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input type="hidden" id="reports_fields" name="reports_fields">
                                    <input type="button" class="sb-btn sb-btn-white" value="Back" name="btn_step_2" id="btn_step_2" onclick="next_step(2,3);">
                                </div>
                                <div class="col-xs-6">
                                    <input type="button" class="sb-btn sb-btn-green" value="Next" name="btn_step_4" id="btn_step_4" onclick="next_step(4);">
                                </div>
                            </div>
                        </div>
                        <!-- .form-horizontal .sb-form -->
                    </div>
                </div>
                <!-- .row -->
            </div>
            <!-- .col-sm-12 -->
        </div>
        <!-- .content-body -->
    </div>
    <!--// Step 3 -->
    <!-- Step 4 -->
    <div id="step_4" style="display:none;">
        <div class="row content-header">
        	<a class="sb-btn sb-btn-white" onclick="report_list(); clearContent();  return false;" href="javascript:;">Cancel</a>
        	<?php echo heading('Report Stylesheet', 1);?>
        </div>
        <!-- .row -->
        <div class="row content-body">
            <div class="col-sm-6">
                <div class="form-horizontal sb-form">
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="x_axis_label">Background Colour</label>
                        <div class="col-sm-6">
                            <input type="text" value="" name="background_color" id="background_color" class="custom-color-picker" placeholder="Background Colour" />
                        </div>
                    </div>
                </div>
                <div class="form-horizontal sb-form" id="x_axis_label_div">
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="x_axis_label">X Axis Label</label>
                        <div class="col-sm-6">
                            <input type="text" value="" name="x_axis_label" id="x_axis_label" class="sb-control" readonly placeholder="X Axis Label" />
                           <!-- <span>Note: Must be one column from <i>(Day,Agent)</i></span> --></div>
                    </div>
                </div>
                <div class="form-horizontal sb-form" id="y_axis_label_div">
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="y_axis_label">Y Axis Label</label>
                        <div class="col-sm-6">
                            <select name="y_axis_label" id="y_axis_label" class="sb-control">
                                <?php 
								if(!empty($yAxisColoumnList)){
									foreach($yAxisColoumnList as $coloumnName=>$yAxisColoumnRow){
							?>
                                <option value="<?php echo $coloumnName;?>"><?php echo $yAxisColoumnRow;?></option>
                                <?php 			
									}
								}
							?>
                            </select>
                           <!--  <span>Note: Must be one column from <i>(Total Score)</i></span> --></div>
                    </div>
                </div>
                  <div class="form-horizontal sb-form" id="pie_chart_base" style="display: hidden;">
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="y_axis_label">Select Chart Base</label>
                        <div class="col-sm-6">
                            <select name="y_axis_label2" id="y_axis_label2" class="sb-control">
                                <?php 
								if(!empty($yAxisColoumnList)){
									foreach($yAxisColoumnList as $coloumnName=>$yAxisColoumnRow){
							?>
                                <option value="<?php echo $coloumnName;?>"><?php echo $yAxisColoumnRow;?></option>
                                <?php 			
									}
								}
							?>
                            </select>
                          <!--   <span>Note: Must be one column from <i>(Total Score)</i></span> --></div>
                    </div>
                </div>
                <div class="form-horizontal sb-form" id="y_axis_midpoint_div">
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="y_axis_midpoint">Y Axis Midpoint</label>
                        <div class="col-sm-6">
                            <input type="text" value="" name="y_axis_midpoint" id="y_axis_midpoint" class="sb-control" placeholder="0" />
                        </div>
                    </div>
                </div>
                <div class="form-horizontal sb-form">
                    <div class="form-group">
                        <div class="col-sm-6">Include Logo</div>
                        <div class="col-sm-6">
                            <input type="radio" id="yes" name="logo" value="1" checked="checked"/>
                            <label for="yes"><span></span>Yes</label>
                            <br />
                            <input type="radio" id="no" name="logo" value="0" />
                            <label for="no"><span></span>No</label>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal sb-form">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="button" class="sb-btn sb-btn-white" value="Back" name="btn_step_3" id="btn_step_3" onclick="next_step(3,4);">
                        </div>
                        <div class="col-xs-6">
                            <input type="button" class="sb-btn sb-btn-green query_builder" value="Next" name="btn_step_5" id="btn_step_5" onclick="next_step(5,4); ">
                        </div>
                    </div>
                </div>
                <!-- .form-horizontal .sb-form -->
            </div>
            <!-- .col-sm-12 -->
        </div>
        <!-- .content-body -->
    </div>
    <!--// Step 4 -->
    <!-- Step 5 -->
    <div id="step_5" style="display:none;">
        <div class="row content-header">

					<a href='javascript:;' onClick='report_list(); clearContent();  return false;' class='sb-btn sb-btn-white'>Cancel</a>
			<?php echo heading('Report Preview', 1);?>  	
		</div>
   
        <!-- .row -->
        <div class="row content-body">
            <div class="col-sm-12">
                <div class="form-horizontal sb-form querySaveDivRegion">
                    <div class="form-group">

                        <div class="col-xs-6">
                            <input type="button" class="sb-btn sb-btn-white" value="Back" name="btn_step_4" id="btn_step_4" onclick="next_step(4,5); clearContent(); ">

                        	<div style="display:none;"><textarea id="report_html" name="report_html"></textarea></div>

                        </div>
                        <div class="col-xs-6">

                           <input type="button" class="sb-btn sb-btn-green reportSave" value="Save" name="btn_step_save" id="btn_step_save" style='float:right;' onclick="next_step('save',5); ">                            

                        </div>
                    </div>
                        <div class='queryBuilderHtml' id="queryBuilderHtml"></div>

                </div>
                <!-- .form-horizontal .sb-form -->
            </div>
            <!-- .col-sm-12 -->
        </div>
    </div>
    <!--// Step 5 -->
</div>
<!-- #report_content -->
</form>
<link rel="stylesheet" href="<?php echo base_url()?>css/spectrum.css" />
<script src="<?php echo base_url()?>js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>js/spectrum.js"></script>

<!-- JS Chart file need to be here because when ajax request send it will loaded again for each -->
<script type="text/javascript" src="<?php echo base_url()?>js/jscharts.js"></script>
<!-- for sumo select -->
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.sumoselect.min.js"></script>
<!--<link rel="stylesheet" href="<?php echo base_url()?>css/sumoselect.css" />-->

    <script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
        });
    </script>


<script type="text/javascript">


$(function () {
	//ajax loader
	jQuery('body').append('<div id="ajaxBusy"><div id="spinner">Please wait a few moment while we process your request.<br/><br/><img src="<?php echo base_url(); ?>/images/ajax-loader.gif"></div></div>');
		
	$("ul.dragdrop").sortable({
		connectWith: "ul"
    });
});


function report_list(){
	window.location = "<?php echo base_url().'reports'?>";
}

/**
 * Color Picker Bind 
 */
//Custom Color Picker - http://bgrins.github.io/spectrum/
$(document).ready(function(){
	
	$('[name="start_date"]').datetimepicker( {format:'d/m/Y H:i'});
	$('[name="end_date"]').datetimepicker({ format:'d/m/Y H:i'});
	$('[name="custom_date"]').datetimepicker({ 
			timepicker:false,
			format:'d/m/Y'
	});
	$("input.custom-color-picker").spectrum({});
});

$(document).ready(function(){
	$("#op_req").change(function(){
		var value = $(this).val();

		switch (value){
			case 'email':
				$('#ftp_tr').hide();
				$('#email_tr').show();
				$('#op_req_flag').val('email');
			break;

			case 'ftp':
				$('#email_tr').hide();
				$('#ftp_tr').show();
				$('#op_req_flag').val('ftp');
			break;

			default:
				$('#email_tr').hide();
				$('#ftp_tr').hide();
				$('#op_req_flag').val('data');
			break;
		}
	});
});

/*
 * @author:	Muhammad Sajid
 * @name:	next_step
 */
function next_step(step, current)
{
	if(validateCustomDateRange(step)){

		if (step == 2 && current == 1) {
			var report_type = $("#report_type").val();
			if (report_type == "word cloud") {
				save_fields();
				return;

			}
		}

		if (step == 4) {
			var hasDetails = 0;
			var details = $("[id^=detail]");
$.each( details, function( index, value ){
	if(typeof value.value !== 'undefined' && value.value != ""){
	   hasDetails++;
	 }

});

if (hasDetails == 0) {
	result = confirm("Not selecting any filters might often result in a large volume of results. Are you sure you want to continue?");
	if (!result) return;} 

		}


		if (step == 'save'){
			//alert('Saved Successfully');
			saveReportData();
		} else {
			// hide all steps
			for(var i=1; i<=5; i++)
			{
				$("#step_"+i).hide();
			}
			var report_type = $("#report_type").val();
			
			/*if(report_type=="pie chart" || report_type=='bar chart' || report_type=='line graph')
			{
				$("#step_2").hide(); if(current==1)step=3;if(current==3)step=1;
			}*/
			// show only upcoming step
		
			 $("#step_"+step).show();	
		}
	}
}

/*
 * @author:	Muhammad Sajid
 * @name:	save_fields
 * @desc:	save selected fields for reports
 */
function save_fields()
{
	var i = 0;
	var data = new Array();
	$('#sort2').each(function(k, items_list){
			$(items_list).find('li').each(function(j, li){
			data[i++] = $(li).text();
		});
	 });

         var ref_fields = ['Agent PIN','Agent Name','Dialed Number','CLI','Campaign'];
         var score_fields = ['Q1 Score','Q2 Score','Q3 Score','Q4 Score','Q5 Score','Total Score','Total Surveys'];
         var detail_fields = ['Recording','Transcription','Sentiment','Notes','Tag'];

	var has_ref = false;
	var total_ref = 0;
	var total_score = 0;
	var total_dets = 0;
	var has_score_or_detail = false;

	var report_type = $("#report_type").val();

	if (report_type == "bar chart" || report_type =="line graph" || report_type == "pie chart") {

		for (i = 0 ;i < ref_fields.length;i++) {
			if (data.indexOf(ref_fields[i]) != -1) {
				total_ref++;	
			}
		}

		for (i = 0 ;i < score_fields.length;i++) {
			if (data.indexOf(score_fields[i]) != -1) {
				total_score++;	
			}
		}

		for (i = 0 ;i < detail_fields.length;i++) {
			if (data.indexOf(detail_fields[i]) != -1) {
				total_dets++;	
			}
		}

		//alert(total_ref+ "/" + total_score + "/"+total_dets);

		if ( !(total_ref == 1 && ((total_score == 1 && total_dets == 0) || (total_score ==0 && total_dets == 1)))) {
			alert("You must select exactly 1 reference field and 1 numerical OR 1 detail field");
			return;
		}
	}



	/*$('#sort4').each(function(k, items_list){
		$(items_list).find('li').each(function(j, li){
		data[i++] = $(li).text();
		});  
	});
	$('#sort6').each(function(k, items_list){
		$(items_list).find('li').each(function(j, li){
			data[i++] = $(li).text();
		});
	});*/
	// save in hidden field
	$("#reports_fields").val(data);
        
	// check report_type
	var report_type = $("#report_type").val();
	var report_fields = data.length;
	
	/*if(report_type=="pie chart" || report_type =='bar chart' || report_type=='line graph')
	{
		$('#step_1').hide();
	}
	else
	{*/
		if(report_fields == 0 && report_type != 'word cloud')
		{
			alert('Please select Data Control');
			$("#step_3").hide();
			$("#step_2").show();
		}
		/*else if ((report_type == 'pie chart') && ( (report_fields <= 1) || (report_fields > 2) ) )
		{
			alert("You need to select exactly two Data Controls for Pie Chart");
			$("#step_3").hide();
			$("#step_2").show();
		}*/
		else if ((report_type == 'data' || report_type == 'detail') && ( (report_fields <= 1) || (report_fields >= 2) ) ) 
		{
			var lis = document.getElementById("sort2").getElementsByTagName("li");
			var dtscore=false;
			var dtgen=false;
		
			$("#sort2 li").each(function()
			{
				if($(this).hasClass("score"))
					dtscore=true;
				else if ($(this).hasClass("general"))
					dtgen=true;		   
			});
			if(dtscore && dtgen)
			{
				next_step(3,2);
			}else
			{
				alert("You need to select atleast one score control and one data type control");
				$("#step_3").hide();
				$("#step_2").show();
			}
		}
		else
		{
			next_step(3,2);
		}
	//}
}

$(document).ready(function () 
{
     $('#addRow').click(function () {
	 	var div_len = $('.extraPerson').length;
           $('<div/>', {
		   	   'id'	: 'filter_'+div_len,
               'class' : 'extraPerson relative', 
                html: GetHtml1(div_len)
     		}).hide().appendTo('#container').slideDown('slow');        
     });
     
	$('.query_builder').click(function ()
	{
		// post data to query_builder
		request = $.ajax({
            type : 'POST',
			url : "<?php echo base_url().'reports/query_builder/'?>",
			data:$("#add_report").serialize(),
            success:function (data) {
            	if(data)
                {            	
                		jQuery('.queryBuilderHtml').html(data);                		
            	}
            }          
        });

		});	
	//	jQuery('.queryBuilderHtml').html(img);
	
});
	function GetHtml1(div_len)
	{
		$html =
			'<div class="extraPersonTemplate relative" style="display:block;">'+
	   		' <div class="controls controls-row">'+
	    	'<div class="form-group row">'+
	     	'   <div class="col-xs-2 col-w-110">'+
	      	'  	<select class="span2 sb-control" id="condition" name="condition[]">'+
	       	'         <option value="AND">And</option>'+
	        '        <option value="OR">Or</option>'+
	        '   </select>'+
	        '</div>'+
	        '<div class="col-xs-3">'+
	        '   <select class="span2 sb-control" id="data_type_'+div_len+'" name="data_type[]" onchange="callme(this);">'+
	        '      <option value="">Select</option>'+
	        '     <option value="user_pin">Agent PIN</option>'+
	        '   <option value="full_name">Agent Name</option>'+
	        '   <option value="dialed_number">Dialled Number</option>'+
	        '  <option value="cli">CLI</option>'+
	        '  <option value="q1">Q1 score</option>'+
	              '  <option value="q2">Q2 score</option>'+
	              '  <option value="q3">Q3 score</option>'+
	              '  <option value="q4">Q4 score</option>'+
	              '  <option value="q5">Q5 score</option>'+
	              '  <option value="total_score">Total Score</option>'+
	               ' <option value="average_score">Average Score</option>'+
	              '  <option value="recording">Recording</option>'+
	              '  <option value="transcription_id">Transcription ID</option>'+
	              '  <option value="sentiment_score">Sentiment Score</option>'+
	           ' </select>'+
	     '   </div>'+
	     '   <div class="col-xs-3">'+
	        '    <select class="span2 sb-control" id="filter1_'+div_len+'" name="filter[]">'+
	            '  	<option value="">Select</option>'+
	            '    <option value="e">Equal</option>'+
	             '   <option value="ne">Not Equal</option>'+
	             '   <option value="gt">Greater Than</option>'+
	              '  <option value="lt">Less Than</option>'+
	               ' <option value="b">Between</option>'+
	               ' <option value="like">Like</option>'+
	            '</select>'+
		        '</div>'+
		        '<div class="col-xs-3">'+
		            '<input class="span3 sb-control" placeholder="Detail" type="text" id="detail1" name="detail[]"><span id="detailbox'+div_len+'"></span>'+
		            '<!--<span><i>Note: Add values (comma separated)</i></span>-->'+
		        '</div>'                            +
		    	'</div>'                       + 
				'</div>'+
				<!-- .controls .controls-row -->
				'</div>';
		var $remove_link = '<a href="#" id="'+div_len+'" class="remove_filter report-filter-icon-remove-row" onClick="remove_filter('+div_len+')"><span class="glyphicon red glyphicon-minus-sign"></span></a>';
		
		return $html+$remove_link;
	}
//save Report
function saveReportData()
{
	// post data to query_builder
	
	$.ajax({
        type : 'POST',
		url : "<?php echo base_url().'reports/query_builder/'?>",
		data:"saveReport=saveReportData&"+$("#add_report").serialize(),
        success:function (data) {
        	if(data){
        			jQuery('#ajaxBusy').show();
        			window.location.replace("<?php echo base_url().'reports'?>");
            		jQuery('.querySaveDivRegion').html(data);
        	}
        }          
    });
}

//clear report html content
function clearContent(){

	jQuery('.queryBuilderHtml').html('Please Wait...');
}



/*
 * @author:	Muhammad Sajid
 * @name:	gen_pdf
 */
function gen_pdf()
{
	$('#report_html').val($('#queryBuilderHtml').html());
	//var dataURL = document.getElementById("JSChart_graph").toDataURL();
	$("#img").attr("src", dataURL);
	$.ajax({
		type : 'POST',
		url : "<?php echo base_url().'reports/generate_pdf/'?>",
		data: $("#add_report").serialize(),
		success:function (data) {
			console.log(data);
			alert(data);
		},
		error:function(data, errorThrown)
        {
            alert('request failed :'+errorThrown);			
		}
	});
}

/**
 * Set X-Axis Label 
 */
function setXAxisLabel(){

	var report_period 	= jQuery('#report_period').val();
	var report_interval = jQuery('#report_interval').val();

	//upper case fisrt letter
	report_period 	= report_period.charAt(0).toUpperCase() + report_period.slice(1);
	report_interval = report_interval.charAt(0).toUpperCase() + report_interval.slice(1);
	
	jQuery('#x_axis_label').val(report_period+' ( '+report_interval+' )');
 }

$(document).ready(function()
{	
	$("#op_req option[value='data']").hide();
	$("#op_req option[value='ftp']").hide();
	$('#pie_chart_base').hide();
	$("#filter").change(function()
	{
		var value = $(this).val();
		if (value == "b"){
			alert('Please specify range eg: start,end');
		}
	});	
	
	$("#report_type").change(function()
	{		
		var value = $(this).val();
		reportPeriodOptionCheck();

		$("#op_req option[value='']").attr('selected', 'selected');
		$('#email_tr').hide();
		
		if ( ((value == "bar chart") || (value == "line graph") || (value == "word cloud")) && (value != "pie chart") )
		{
			$('#assigned').show();		
			$("#op_req option[value='data']").hide();
			$("#op_req option[value='ftp']").hide();
			$('#reportPeriodRegion').show();
			$('#reportInetrvalRegion').show();		
			$('#ftp_tr').hide();
			$('#pie_chart_base').hide();
		}
		else if (value == "detail")
		{
			$('#assigned').show();		
			$('.customDateRegion').hide();
			$('#reportPeriodRegion').show();
			$('#reportInetrvalRegion').hide();
			$("#op_req option[value='ftp']").show();
			$('#dashboard').prop('checked', false); 
			$('#wallboard').prop('checked', false); 
			$('#pie_chart_base').hide();
		}
		else if(value == "pie chart")
		{
			$('#assigned').show();		
			$("#op_req option[value='data']").hide();
			$("#op_req option[value='ftp']").hide();
			$('#reportPeriodRegion').show();				
			$('#ftp_tr').hide();
			$("#reportInetrvalRegion").hide();
			$('#pie_chart_base').show();
		}
		else
		{
			$('#assigned').hide();		
			$("#op_req option[value='data']").show();
			$("#op_req option[value='ftp']").show();
			$('#reportPeriodRegion').show();
			$('#reportInetrvalRegion').show();
			$('#dashboard').prop('checked', false); 
			$('#wallboard').prop('checked', false); 
			$('#pie_chart_base').hide();
		}

		if ( (value == "bar chart") || (value == "line graph") )
		{
			$('#x_axis_label_div').show();
			$('#y_axis_label_div').show();
			$('#y_axis_midpoint_div').show();
		}
		else
		{
			$('#x_axis_label_div').hide();
			$('#y_axis_label_div').hide();
			$('#y_axis_midpoint_div').hide();
		}	
	});
}); 

var allnames = <?=json_encode($allnames)?>;
var allpins = <?=json_encode($allpins)?>;
	
	//validate custom date range
	function validateCustomDateRange(step)
	{
		isvalid=true;
		if(step==2){
			
			var report_period = jQuery('#report_period').val();
			var startDate     = jQuery('#datepicker').val();
			var endDate       = jQuery('#datepicker2').val();
			var report_name	  = jQuery('#report_name').val();
			var custom_date	  = jQuery('#custom_date').val();
			var	report_type	  = jQuery('#report_type').val();
			var reportnameErr = "";

			//report name validate
			if(report_name==""){
				reportnameErr = "Report name is required.";
				jQuery('#reportNameErr').html(reportnameErr);
				jQuery('#reportNameErr').css('display','block');
				isvalid= false;
			}else{
				jQuery('#reportNameErr').html('');
				jQuery('#reportNameErr').css('display','none');
				//return true;
			}
			if(report_name!=""&&report_period=='custom'&&report_type!='detail')
			{
				var errMessage	= "";
				
				if(startDate==''){
					errMessage = "Please Select Start Date.<br/>";
					jQuery('#start_dateErr').html(errMessage);
					jQuery('#start_dateErr').css('display','block');
					isvalid= false;
				}else{
					jQuery('#start_dateErr').html('');
					jQuery('#start_dateErr').css('display','none');
					//return true;
				}

				if(endDate==''){
					errMessage = "Please Select End Date.<br/>";
					jQuery('#end_dateErr').html(errMessage);
					jQuery('#end_dateErr').css('display','block');
					isvalid= false;
				}else{
					jQuery('#end_dateErr').html('');
					jQuery('#end_dateErr').css('display','none');
					//return true;
				}
			
				if(startDate!=''&&endDate!=''){
					 if( (new Date(startDate).getTime() >= new Date(endDate).getTime()))
					 {
						 errMessage = "End Date should be greater than start date.<br/>";
						 jQuery('#end_dateErr').html(errMessage);
						 jQuery('#end_dateErr').css('display','block');
						 isvalid= false;
					 }else{
							jQuery('#end_dateErr').html('');
							jQuery('#end_dateErr').css('display','none');
							//return true;
						}
				}			
			}
			else if(report_period=='day')
			{				
				var errMessage	= "";
				
				if(custom_date=='')
				{
					errMessage = "Please Select Date.<br/>";
				}

				//check err msg
				if(errMessage!=''){
					jQuery('#customDateErr').html(errMessage);
					jQuery('#customDateErr').css('display','block');
					isvalid= false;
				}
				else
				{					
					jQuery('#customDateErr').html('');
					jQuery('#customDateErr').css('display','none');
					//return true;
				}
			}			
			return isvalid;
		}else{
			return true;
		}
	}

	//if Report Peroid is custom then show 
	function reportPeriodOptionCheck()
	{		
		if(jQuery('#report_period').val()=='custom')
		{			
			jQuery('.customDateRegion').css('display','block');
			jQuery('.customDayRegion').css('display','none');
			
		}else if(jQuery('#report_period').val()=='day'){
			
			jQuery('.customDayRegion').css('display','block');
			jQuery('.customDateRegion').css('display','none');
			
		}else
		{			
			jQuery('.customDateRegion').css('display','none');
			jQuery('.customDayRegion').css('display','none');
		}
	}

function remove_filter(id)
{
	$("#filter_"+id).remove();
}

function getval(selectedVal) 
{	
//	alert(selectedVal.value);
	$("#detail").val('');
	if(selectedVal.value==="user_pin" || selectedVal.value==="full_name" || selectedVal.value==="cli" || selectedVal.value==="dialed_number" || selectedVal.value==="recording" )
	{
		$("#filter option[value='gt']").hide();
		$("#filter option[value='lt']").hide();
		$("#filter option[value='b']").hide();
	}else
	{
		$("#filter option[value='gt']").show();
		$("#filter option[value='lt']").show();
		$("#filter option[value='b']").show();
	}	
	if(selectedVal.value==="full_name" || selectedVal.value==="recording" )
	{
		$("#filter option[value='like']").show();
	}else
	{
		$("#filter option[value='like']").hide();
	}

//return;
	// show the special fields for agent name & agent PIN
	if(selectedVal.value==="full_name") {
		// change inner html of detail html
		$("#detailbox").html('<select multiple id="detail_fn" style="height:60px;" class="span3 sb-control" onchange="updateField(this,-1);"></select>');
		console.log("noop");console.log("noop");
		for (i = 0;i < allnames.length;i++) {
			$("#detail_fn").append(new Option(allnames[i],allnames[i]));

		}

	}

	if(selectedVal.value==="user_pin") {
		// change inner html of detail html
		$("#detailbox").html('<select multiple id="detail_pins" style="height:60px;" class="span3 sb-control" onchange="updateField(this,-1);"></select>');
		console.log("noop");console.log("noop");
		for (i = 0;i < allpins.length;i++) {
			$("#detail_pins").append(new Option(allpins[i],allpins[i]));

		}

	}


        if (selectedVal.value != "user_pin" && selectedVal.value != "full_name") {
                $("#detailbox").html('');
        }



}

function callme(val)
{
	id = val.id;

	arr = id.split('_');

	$("#detail_"+arr[2]).val('');
	
	if(val.value==="user_pin" || val.value==="full_name" || val.value==="cli" || val.value==="dialed_number" || val.value==="recording")
	{
		$("#filter_"+arr[2]+" option[value='gt']").hide();
		$("#filter_"+arr[2]+" option[value='lt']").hide();
		$("#filter_"+arr[2]+" option[value='b']").hide();
	}else
	{
		$("#filter_"+arr[2]+" option[value='gt']").show();
		$("#filter_"+arr[2]+" option[value='lt']").show();
		$("#filter_"+arr[2]+" option[value='b']").show();
	}	
	if(val.value === "full_name" || val.value==="recording" )
	{
		$("#filter_"+arr[2]+" option[value='like']").show();
	}else
	{
		$("#filter_"+arr[2]+" option[value='like']").hide();
	}

	// show the special fields for agent name & agent PIN
	if(val.value==="full_name") {
		// change inner html of detail html
		$("#detailbox"+ arr[2]).html('<select multiple id="detail_fn' + arr[2]  +'" style="height:60px;" class="span3 sb-control" onchange="updateField(this,arr[2]);"></select>');
		console.log("noop");console.log("noop");
		for (i = 0;i < allnames.length;i++) {
			$("#detail_fn" + arr[2]).append(new Option(allnames[i],allnames[i]));

		}

	}

	if(val.value==="user_pin") {
		// change inner html of detail html
		$("#detailbox"+ arr[2]).html('<select multiple id="detail_pins' + arr[2]  +'" style="height:60px;" class="span3 sb-control" onchange="updateField(this,arr[2]);"></select>');
		console.log("noop");console.log("noop");
		for (i = 0;i < allpins.length;i++) {
			$("#detail_pins"  + arr[2]).append(new Option(allpins[i],allpins[i]));

		}

	}

	if (val.value != "user_pin" && val.value != "full_name") {
		$("#detailbox"+ arr[2]).html('');
	}



}

function updateField(selectbox, idx) {
		var arr = $("#"+selectbox.id).val();
		var leparent = $("#"+selectbox.id).parent();

		var lesib = leparent.siblings()[0];
		lesib.value = arr;
}

</script>
