<!--<script src="< ?php echo base_url()?>js/jquery-ui.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url()?>js/jquery.min.js" type="text/javascript"></script>
<!-- JS Chart file need to be here because when ajax request send it will loaded again for each -->
<script type="text/javascript" src="<?php echo base_url()?>js/jscharts.js"></script>

<style>
#graph img {
display:none;
visibility:hidden
}
</style>

<?php echo $this->session->flashdata('message');?>
<div id="content">
	<div class="container">	
		<div id="report_content" class="cf">
			<div class='queryBuilderHtml'>
			<?php render_chart($report);?>
			</div>
		</div><!-- #report_content -->
	</div>
</div>