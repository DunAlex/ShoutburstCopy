<script src="<?php echo base_url()?>js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>js/spectrum.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>css/spectrum.css" />

<script type="text/javascript">
/**
 * Color Picker Bind 
 */
//Custom Color Picker - http://bgrins.github.io/spectrum/
$(document).ready(function(){
	$("input.custom-color-picker").spectrum(
		{
		}
	);
	$("input.custom-txt-color-picker").spectrum(
		{
		}
	);

	$("input.custom-color-picker-tg").spectrum(
		{
		}
	);
	$("input.custom-txt-color-picker-tg").spectrum(
		{
		}
	);
});


function check_tags(leform)
{
	//var time_tag_name = jQuery('#tag_name').val();	

	// time tags
	var source_form = $(leform).attr('id');
	var tag_name="";
	console.log(source_form);
	
	if (source_form == "tags") {
		tag_name = jQuery('#tag_name').val();
	} 
	else if (source_form == "time_tags") {
		jQuery('#tag_name').val( jQuery('#time_tag_name').val() );
		tag_name = jQuery('#tag_name').val();

	} 
	else if(source_form == "actual_tags"){
		jQuery('#tag_name').val( jQuery('#actual_tag_name').val() );
		tag_name = jQuery('#tag_name').val();
	}

	//tag name validate
	if(tag_name==""){
		tagnameErr = "Tag name is required";
		if (source_form == "time_tags") {
		jQuery('#timeTagNameErr').html(tagnameErr);
		jQuery('#timeTagNameErr').css('display','block');
		}
		else if(source_form == "actual_tags") {
		jQuery('#ActualtagNameErr').html(tagnameErr);
		jQuery('#ActualtagNameErr').css('display','block');
		}
		else {
		jQuery('#tagNameErr').html(tagnameErr);
		jQuery('#tagNameErr').css('display','block');
		}
		return false;
	}else{
		if (source_form == "time_tags") {
                jQuery('#timeTagNameErr').html('');
                jQuery('#timeTagNameErr').css('display','none');
		}
		else if(source_form == "actual_tags") {
		jQuery('#ActualtagNameErr').html('');
		jQuery('#ActualtagNameErr').css('display','none');
		}
		else {
		jQuery('#tagNameErr').html('');
		jQuery('#tagNameErr').css('display','none');
		}
		return true;
	}
}




function check_tags_group()
{
	var tags_group_name	= jQuery('#tags_group_name').val();
	var i = 0;
	var data = new Array();
	
	//tag group name validate
	if(tags_group_name==""){
		tagGroupNameErr = "Tags Group name is required";
		jQuery('#tagGroupNameErr').html(tagGroupNameErr);
		jQuery('#tagGroupNameErr').css('display','block');
		return false;
	}else{
		jQuery('#tagGroupNameErr').html('');
		jQuery('#tagGroupNameErr').css('display','none');
	}
	
	$("#dragged_tags").each(function(k, items_list){
		$(items_list).find('li').each(function(j, li){
			//data[i++] = $(li).text();
			data[i++] = $(li).attr('tag_id');
		});
	});
	if (data == ''){
		$("#tag_ids").val(0);
	} else {
		$("#tag_ids").val(data);
	}
	return true;
}

$(function () {	
	$("ul.dragdrop").sortable({
		connectWith: "ul"
    });
});
</script>

<div id="content">
<div class="container">
	<div class="row content-header">
	<!-- 	<a href="<?php echo base_url().'tags'?>" class="sb-btn sb-btn-blue" role="button">Add New Team Tag</a>-->
		<a href="#" class="main-nav-toggle"></a><?php echo heading('&nbsp;&nbsp;&nbsp;&nbsp;'.'Tag Store', 1);?>
		<?php echo $this->session->flashdata('message');?>
	</div>
	
	<div class="row content-body">
		
		<!-- Tags/Team -->
		<div class="col-md-12">
			<div class="row" style="width: 49%;float:left;border-style: solid;padding: 10px;margin-left: 10px;border-width: 1px;border-color: #cccccc;">
				<div class="col-sm-6">
					<div class="store-header" style='height:30px;text-align:center;'>
						<span style='text-align:middle;font-size:18px;font-weight:bold;'>Virtual Team Tags</span>
					</div>
					<div class="tag-store">
						<div class="store-body">
						<?php if (!empty($tags)){?>
							<ul class="teams row dragdrop">
							<?php foreach ($tags as $k){?>
								<li class="team" tag_id="<?php echo $k->tag_id?>" style="background-color: <?php echo $k->color?>;">
									<a class="team-href" style="color:<?php echo $k->txt_color?>" href="<?php echo base_url().'tags/edit/tags/'.$k->tag_id?>"><?php echo $k->tag_name?></a>
									<a class="delete confirm" href="<?php echo base_url().'tags/delete/tags/'.$k->tag_id?>" id="tags__<?php echo $k->tag_id?>"></a>
								</li>
							<?php }?>								
							</ul>
						<?php }else{?>
							<ul class="teams row dragdrop">
							</ul>
						<?php }?>							
						</div><!-- .store-body -->
					</div><!-- .tag-store -->
				</div>
				<div class="col-sm-6">
				<?php
				$team_name = '';
				$color = '#FFFFFF';
				$txt_color = '#000000';
				$tag_id = '';
				$action = 'tags/add/tags';
				
				if(isset($tag_info)){
					$team_name = $tag_info[0]->tag_name;
					$color = $tag_info[0]->color;
					$txt_color = $tag_info[0]->txt_color;
					$tag_id = $tag_info[0]->tag_id;
					$action = 'tags/edit/tags';
					?>
					<script type="text/javascript">
					// Color Picker Bind //Custom Color Picker - http://bgrins.github.io/spectrum/
					$(document).ready(function(){
						$("input.custom-color-picker").spectrum(
						 	{
						 		color : "<?php echo $color?>"
						 	}
						);

						$("input.custom-txt-color-picker").spectrum(
						 	{
						 		color : "<?php echo $txt_color?>"
						 	}
						);
					});
					</script>
					<?php
				}
				?>
				<?php echo form_open_multipart($action, array('name'=>'tags', 'id'=>'tags', 'onsubmit'=>"return check_tags(this)")) ?>
					<div class="form-inline">
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Name: &nbsp;</label>						
							<input type="text" id="tag_name" name="tag_name" value="<?php echo $team_name?>" class="form-control">
							<div id='tagNameErr' style='color:red;diplay:none;'></div>
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $color?>" name="color" class="custom-color-picker">
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Text Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $txt_color?>" name="txt_color" class="custom-txt-color-picker">
						  </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="tag_id" value="<?php echo $tag_id?>" id="tag_id" />
							<button type="submit" class="sb-btn sb-btn-green">Save Tag</button>
						</div>
					</div>
				</form>	
				</div>
			</div><!-- .row -->			

			<div class="row" style="width: 49%;float:left;border-style: solid;padding: 10px;margin-left: 30px;border-width: 1px;border-color: #cccccc;">
				<div class="col-sm-6">
					<div class="store-header" style='height:30px;text-align:center;'>
                        <span style='text-align:center;font-size:18px;font-weight:bold;'>Time Tags</span>
					</div>
					<div class="tag-store">
						
						<div class="store-body">
						<?php if (!empty($tags)){?>
							<ul class="teams row dragdrop">
							<?php foreach ($tags as $k){ /*?>
								<li class="team" tag_id="<?php echo $k->tag_id?>" style="background-color: <?php echo $k->color?>;">
									<a class="team-href" style="color:<?php echo $k->txt_color?>" href="<?php echo base_url().'tags/edit/tags/'.$k->tag_id?>"><?php echo $k->tag_name?></a>
									<a class="delete confirm" href="<?php echo base_url().'tags/delete/tags/'.$k->tag_id?>" id="tags__<?php echo $k->tag_id?>"></a>
								</li>
							<?php */ }?>
					<li class="team" tag_id="dummytag22" style="background-color: #1a20df">

							<a class="team-href" style="color:#fbf5f5" href="#">Early Shift</a>						
								<a class="delete confirm" href="#" id="dummydel22"></a>

</li>
							</ul>
						<?php }else{?>
							<ul class="teams row dragdrop">
							</ul>
						<?php }?>							
						</div><!-- .store-body -->
					</div><!-- .tag-store -->
				</div>
				<div class="col-sm-6">
				<?php
				$team_name = '';
				$color = '#FFFFFF';
				$txt_color = '#000000';
				$tag_id = '';
				$action = 'tags/add/tags';
				
				if(isset($tag_info)){
					$team_name = $tag_info[0]->tag_name;
					$color = $tag_info[0]->color;
					$txt_color = $tag_info[0]->txt_color;
					$tag_id = $tag_info[0]->tag_id;
					$action = 'tags/edit/tags';
					?>
					<script type="text/javascript">
					// Color Picker Bind //Custom Color Picker - http://bgrins.github.io/spectrum/
					$(document).ready(function(){
						$("input.custom-color-picker").spectrum(
						 	{
						 		color : "<?php echo $color?>"
						 	}
						);

						$("input.custom-txt-color-picker").spectrum(
						 	{
						 		color : "<?php echo $txt_color?>"
						 	}
						);
					});
					</script>
					<?php
				}
				?>
				<?php echo form_open_multipart($action, array('name'=>'tags', 'id'=>'time_tags', 'onsubmit'=>"return check_tags(this)")) ?>
					<div class="form-inline">
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Name: &nbsp;</label>						
							<input type="text" id="time_tag_name" name="time_tag_name" value="<?php echo $team_name?>" class="form-control">
							<div id='timeTagNameErr' style='color:red;diplay:none;'></div>
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $color?>" name="color" class="custom-color-picker">
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Text Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $txt_color?>" name="txt_color" class="custom-txt-color-picker">
						  </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="tag_id" value="<?php echo $tag_id?>" id="tag_id" />
							<button type="submit" class="sb-btn sb-btn-green">Save Tag</button>
						</div>
					</div>
				</form>	
				</div>
			</div><!-- .row -->			

		</div><!-- .col-md-12 -->
		<!--// Tags/Team -->









		



















		<!-- Drop Tags Here -->
		<div class="col-md-12">
			<div style='text-align:center;margin:10px;'><img src='img/downarrow.png' /></div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="drag-tags-here" style="margin:10px;">
					<div class="store-header" style='height:30px;text-align:center;'>
						<span style='text-align:center;font-size:18px;font-weight:bold;color:white;margin:0;'>Drop Tags Here</span>
					</div>
					<div class="tag-store">
						<div class="store-body">
						<?php if (!empty($tg_tags)){?>
							<ul id="dragged_tags" class="teams row dragdrop">
							<?php foreach ($tg_tags as $tg_t){?>
								<li class="team" tag_id="<?php echo $tg_t->tag_id?>" style="background-color: <?php echo $tg_t->color?>;">
								<a class="team-href" style="color:<?php echo $tg_t->txt_color?>" href="<?php echo base_url().'tags/edit/tags/'.$tg_t->tag_id?>"><?php echo $tg_t->tag_name?></a>
								<a class="delete confirm" href="<?php echo base_url().'tags/delete/tags/'.$tg_t->tag_id?>" id="tags__<?php echo $tg_t->tag_id?>"></a></li>
							<?php }?>								
							</ul>
						<?php } else {?>
							<ul id="dragged_tags" class="teams row dragdrop">
							</ul>
						<?php }?>
						</div><!-- .store-body -->
					</div><!-- .tag-store -->
				</div><!-- .drag-tags-here -->
			</div>
		</div><!-- .row -->
		
		<!-- Tags/Team Group -->
		<div class="col-md-12">			
			<div class="row">
				<div class="col-sm-6">
					<div class="store-header" style='height:30px;text-align:center;'>
						<span style='text-align:center;font-size:18px;font-weight:bold;'>Group Tag Store</span>
					</div>
					<div class="tag-store">
						<div class="store-body">
						<?php if (!empty($tags_group)){?>
							<ul class="teams row">
							<?php foreach ($tags_group as $tg){?>
								<li class="team" style="background-color: <?php echo $tg->tg_color?>;">
								<a class="team-href" style="color:<?php echo $tg->tg_txt_color?>" href="<?php echo base_url().'tags/edit/tags_group/'.$tg->tg_id?>"><?php echo $tg->tg_name?></a>
								<a class="delete confirm" href="<?php echo base_url().'tags/delete/tags/'.$tg->tg_id?>" id="tags_group__<?php echo $tg->tg_id?>"></a>
								</li>
							<?php }?>								
							</ul>
						<?php }?>
						</div><!-- .store-body -->
					</div><!-- .tag-store -->
				</div>
				<div class="col-sm-6">
				<?php
				$team_group_name = '';
				$tg_color = '#FFFFFF';
				$tg_txt_color = '#000000';
				$tg_id = '';
				$action_team_group = 'tags/add/tags_group';

				if(isset($team_group_info)){
					$team_group_name = $team_group_info[0]->tg_name;
					$tg_color = $team_group_info[0]->tg_color;
					$tg_txt_color = $team_group_info[0]->tg_txt_color;
					$tg_id = $team_group_info[0]->tg_id;
					$action_team_group = 'tags/edit/tags_group';
					?>
					<script type="text/javascript">
					// Color Picker Bind //Custom Color Picker - http://bgrins.github.io/spectrum/
					$(document).ready(function(){
						$("input.custom-color-picker-tg").spectrum(
						 	{
						 		color : "<?php echo $tg_color?>"
						 	}
						);

						$("input.custom-txt-color-picker-tg").spectrum(
						 	{
						 		color : "<?php echo $tg_txt_color?>"
						 	}
						);
					});
					</script>
					<?php
				}
				?>
				<?php echo form_open_multipart($action_team_group, array('name'=>'tags_group', 'id'=>'tags_group', 'onsubmit'=>"return check_tags_group(this)")) ?>
					
					<div class="form-inline">
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Group Team Name: &nbsp;</label>						
							<input type="text" id="tags_group_name" name="tags_group_name" value="<?php echo $team_group_name?>" class="form-control">
							<div id='tagGroupNameErr' style='color:red;diplay:none;'></div>
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $tg_color?>" name="tg_color" class="custom-color-picker-tg">
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Text Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $tg_txt_color?>" name="tg_txt_color" class="custom-txt-color-picker-tg">
						  </div>
						</div>
					</div><!-- .form-inline -->
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="tg_id" value="<?php echo $tg_id?>" id="tg_id" />
							<input type="hidden" id="tag_ids" name="tag_ids">
							<button type="submit" class="sb-btn sb-btn-green">Save Group Tag</button>
						</div>
					</div>
				</form>	
				</div>
			</div><!-- .row -->			
		</div><!-- .col-md-12 -->
		<!--// Tags/Team Group -->







		<!-- Actual team Tags -->
		<div class="col-md-12">
			<div class="row" style="width: 49%;float:left;border-style: solid;padding: 10px;margin-left: 10px;border-width: 1px;border-color: #cccccc;">
				<div class="col-sm-6">
					<div class="store-header" style='height:30px;text-align:center;'>
						<span style='text-align:middle;font-size:18px;font-weight:bold;'>Actual Team Tags</span>
					</div>
					<div class="tag-store">
						<div class="store-body">
						<?php if (!empty($actual_tags)){?>
							<ul class="teams row dragdrop">
							<?php foreach ($actual_tags as $k){?>
								<li class="team" tag_id="<?php echo $k->actual_tag_id?>" style="background-color: <?php echo $k->color?>;">
									<a class="team-href" style="color:<?php echo $k->txt_color?>" href="<?php echo base_url().'tags/edit/actual_tags/'.$k->actual_tag_id?>"><?php echo $k->actual_tag_name?></a>
									<a class="delete confirm" href="<?php echo base_url().'tags/delete/actual_tags/'.$k->actual_tag_id?>" id="actual_tags__<?php echo $k->actual_tag_id?>"></a>
								</li>
							<?php }?>								
							</ul>
						<?php }else{?>
							<ul class="teams row dragdrop">
							</ul>
						<?php }?>							
						</div><!-- .store-body -->
					</div><!-- .tag-store -->
				</div>
				<div class="col-sm-6">
				<?php
				$actual_team_name = '';
				$color = '#FFFFFF';
				$txt_color = '#000000';
				$tag_id = '';
				$action = 'tags/add/actual_tags';
				
				if(isset($actual_tag_info)){
					$actual_team_name = $actual_tag_info[0]->actual_tag_name;
					$color = $actual_tag_info[0]->color;
					$txt_color = $actual_tag_info[0]->txt_color;
					$tag_id = $actual_tag_info[0]->actual_tag_id;
					$action = 'tags/edit/actual_tags';
					?>
					<script type="text/javascript">
					// Color Picker Bind //Custom Color Picker - http://bgrins.github.io/spectrum/
					$(document).ready(function(){
						$("input.custom-color-picker").spectrum(
						 	{
						 		color : "<?php echo $color?>"
						 	}
						);

						$("input.custom-txt-color-picker").spectrum(
						 	{
						 		color : "<?php echo $txt_color?>"
						 	}
						);
					});
					</script>
					<?php
				}
				?>
				<?php echo form_open_multipart($action, array('name'=>'tags', 'id'=>'actual_tags', 'onsubmit'=>"return check_tags(this)")) ?>
					<div class="form-inline">
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Name: &nbsp;</label>						
							<input type="text" id="actual_tag_name" name="tag_name" value="<?php echo $actual_team_name?>" class="form-control">
							<div id='ActualtagNameErr' style='color:red;diplay:none;'></div>
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $color?>" name="color" class="custom-color-picker">
						  </div>
						</div>
						<div class="row" style="margin-bottom: 15px;">
						  <div class="col-sm-12">
							<label for="team_name">Select Text Colour: &nbsp;</label>						
							<input type="text" value="<?php echo $txt_color?>" name="txt_color" class="custom-txt-color-picker">
						  </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="tag_id" value="<?php echo $tag_id?>" id="tag_id" />
							<button type="submit" class="sb-btn sb-btn-green">Save Tag</button>
						</div>
					</div>
				</form>	
				</div>
			</div><!-- .row -->			

					

		</div><!-- .col-md-12 -->
		<!--// actual team tags -->
		
	</div><!-- .row -->







	
	<script>
		//confirm box for enable and disable agent
		jQuery(".confirm").confirm({
			text: "Are you sure you want to perform this action?",
			title: "Confirmation required",
			confirm: function( urlAndid ) {
				//split to get url and id
				var urlAndidArr	=	urlAndid.split('__==__');
				if(urlAndidArr[0]&&urlAndidArr[1]){
					url	=	urlAndidArr[0];
					parse_me	=	urlAndidArr[1];

					//split id to determine which action is perform
					var Arr	= parse_me.split('__');
					var entity = Arr[0];
					var currentId = Arr[1];
					$.ajax({
			            type : 'GET',
						url : '<?php echo site_url("tags/delete/");?>'+"/?entity="+entity+"&id="+currentId,
			            success:function (data) {
				            window.location = "<?php echo base_url().'tags'?>";	            	
			            }
			        });
				}
				
			},
			cancel: function(button) {
				// do something
			},
			confirmButton: "Yes",
			cancelButton: "No",
			post: true
		});		
	</script>
</div>
</div><!-- #content -->
