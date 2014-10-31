	//Add Campaign By New Plugin
jQuery(document).ready(function(){
       jQuery('.chosen-select-no-results').chosen({no_results_text:'Oops, nothing found!'} );
});	   
	   //show add campaign region
		function addNewCampaignShowRegion(){
		  jQuery('#new-campiagn-region').css('display','block');
		  jQuery('#addNewCampaignRegionLink').css('display','none');
		  //hide error div
			jQuery('#errorRegion').html('');
			jQuery('#errorRegion').css('display','none');
		}
		
		 //hide add campaign region
		function removeNewCampaign(){
		  jQuery('#new-campiagn-region').css('display','none');
		  jQuery('#addNewCampaignRegionLink').css('display','block');
		  
		  //error region hide if show
		  jQuery('#errorRegion').html('');
		  jQuery('#errorRegion').css('display','none');
		  
		  //reset value
		  jQuery('#addNewCampaign').val('');
		}
		
		//add new campaign
		function addNewCampaign(){
		
			var addNewCampaign = jQuery.trim(jQuery('#addNewCampaign').val());
			var routingPlan = jQuery.trim(jQuery('#addNewRoutingPlan').val());
			//remove special characters from string
			 addNewCampaign = addNewCampaign.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ' ');
			 routingPlan = routingPlan.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ' ')
			//set value on text box to show user
			jQuery('#addNewCampaign').val(addNewCampaign);
			
			var error = '';
			
			//validate value
			if(addNewCampaign==''){
				error += 'Please Enter Campaign Name';
			}else if(routingPlan==''){
				error += 'Please Enter Routing Plan';
			}
			
			if(error!=''){			
				jQuery('#errorRegion').html(error);
				jQuery('#errorRegion').css('display','block');			
				
			}else{
				jQuery('#errorRegion').html('');
				jQuery('#errorRegion').css('display','none');
				
				var urlPath	=	jQuery('#addCamapaignHiddenUrlForJS').val();			
				
				//add campaign by ajax
				jQuery.ajax({
							type: "POST",
							url: urlPath,
							data:"camp_name="+addNewCampaign+"&routingPlan="+routingPlan,
							cache:false,
							success: function(msg){	
								var msg = jQuery.trim(msg);
								//if message are true then we update list
								if(msg > 0){
									jQuery('.chosen-select-no-results').append("<option value='"+msg+"'>"+addNewCampaign+"</option>");		
									jQuery('.chosen-select-no-results').trigger("chosen:updated");
									
									 //add campaign successfuly hide 
									jQuery('#new-campiagn-region').css('display','none');
									jQuery('#addNewCampaignRegionLink').css('display','block');
									
									//reset value
									jQuery('#addNewCampaign').val('');
									
									jQuery('#errorRegion').html('Campaign added successfully.');
									jQuery('#errorRegion').css('color','green');	
								}else{
									jQuery('#errorRegion').html('Campaign is already added in list.');
									jQuery('#errorRegion').css('color','red');	
									
								}
								jQuery('#errorRegion').css('display','block');	
							}
						});
			}
			
			
		}

	//----