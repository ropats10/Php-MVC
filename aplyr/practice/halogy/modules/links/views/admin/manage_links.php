<script language="javascript" type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/jquerydate.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/jquery.datetimepicker.js"></script>

<script type="text/javascript">
function preview(el){
	$.post('<?php echo site_url('/admin/shop/preview'); ?>', { body: $(el).val() }, function(data){
		$('div.preview').html(data);
	});
}
$(function(){
	$('#startDate').datetimepicker({
		dayOfWeekStart : 1,
		lang:'en',
		disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
		format: 'd M Y h:i A',
		formatTime:'g:i A', 
		validateOnBlur:false,
		allowBlank:true
	});
	$('#endDate').datetimepicker({
		dayOfWeekStart : 1,
		lang:'en',
		disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
		format: 'd M Y h:i A',
		formatTime:'g:i A', 
		validateOnBlur:false,
		allowBlank:true
	});
	
	$('div.category>span, div.category>input').hover(
		function() {
			if (!$(this).prev('input').attr('checked') && !$(this).attr('checked')){
				$(this).parent().addClass('hover');
			}
		},
		function() {
			if (!$(this).prev('input').attr('checked') && !$(this).attr('checked')){
				$(this).parent().removeClass('hover');
			}
		}
	);	
	$('div.category>span').click(function(){
		if ($(this).prev('input').attr('checked')){
			$(this).prev('input').attr('checked', false);
			$(this).parent().removeClass('hover');
		} else {
			$(this).prev('input').attr('checked', true);
			$(this).parent().addClass('hover');
		}
	});
	$('a.showtab').click(function(event){
		event.preventDefault();
		var div = $(this).attr('href'); 
		$('div#details, div#desc, div#variations').hide();
		$(div).show();
	});
	$('ul.innernav a').click(function(event){
		event.preventDefault();
		$(this).parent().siblings('li').removeClass('selected'); 
		$(this).parent().addClass('selected');
	});
	$('.addvar').click(function(event){
		event.preventDefault();
		$(this).parent().parent().siblings('div').toggle('400');
	});
	$('div#desc, div#variations').hide();

	$('input.save').click(function(){
		var requiredFields = 'input#productName, input#catalogueID';
		var success = true;
		$(requiredFields).each(function(){
			if (!$(this).val()) {
				$('div.panes').scrollTo(
					0, { duration: 400, axis: 'x' }
				);					
				$(this).addClass('error').prev('label').addClass('error');
				$(this).focus(function(){
					$(this).removeClass('error').prev('label').removeClass('error');
				});
				success = false;
			}
		});
		if (!success){
			$('div.tab').hide();
			$('div.tab:first').show();
		}
		return success;
	});	
	$('textarea#body').focus(function(){
		$('.previewbutton').show();
	});
	$('textarea#body').blur(function(){
		preview(this);
	});
	preview($('textarea#body'));
});
</script>

<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" enctype="multipart/form-data" class="default">

<h1 class="headingleft">

           <span>Edit Link</span>

<small>(<a href="<?php echo site_url('/admin/links/viewall'); ?>">View all Links</a>)</small></h1>

<div class="headingright">
	<input type="submit" value="Save Changes" class="button save" />
</div>

<div class="clear"></div>

<?php if ($errors = validation_errors()): ?>
	<div class="error">
		<?php echo $errors; ?>
	</div>
<?php endif; ?>

<?php if (isset($message)): ?>
	<div class="message">
		<?php echo $message; ?>
	</div>
<?php endif; ?>

<div id="details" class="tab">
	<label for="offerCode">Link URL</label>
	<?php echo @form_input('link_url',set_value('link_url', $data['link_url']), ' id="link_url" class="formelement"'); ?>
	<br class="clear" />

	<label for="offerCode">Comments</label>
	<?php echo @form_textarea('comments',set_value('comments', $data['comments']), ' id="comments" class="formelement"'); ?>
	<br class="clear" />
	
	<label for="offerCode">Link Status</label>
	<?php 
					$values = array(
			'1'  => 'In Progress',
			'2' => 'Rejected',
			'3' => 'Action Required',
			'4' => 'Completed'
			);

	echo @form_dropdown('status',$values,$data['status'], ' id="status" class="formelement"'); ?>
	
	<br class="clear" />


	<label for="offerCode">User</label>
	<?php 
		echo @form_dropdown('userID',$users,$data['userID'], ' id="userID" class="formelement"'); ?>
	
	<br class="clear" />
	
</div>

<p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>
	
</form>
