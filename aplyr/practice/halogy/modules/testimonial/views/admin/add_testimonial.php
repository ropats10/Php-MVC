<script type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/templates.js" /></script>
<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" class="default" name="form">
            <h1 class="headingleft">Add Testimonials<small>(<a href="<?php echo site_url('/admin/testimonial/viewtestimonial'); ?>">Back to Testimonial</a>)</small>
		</h1>
	
	<div class="headingright">
		<input type="submit" value="Save Changes" class="button" />
	</div>
	
	<div class="clear"></div>
            <?php 
            if ($errors = validation_errors()): ?>
		<div class="error">
			<?php echo $errors; ?>
		</div>
            <?php endif; ?>
            <?php if (isset($message)): ?>
		<div class="message">
			<?php echo $message; ?>
		</div>
            <?php endif; ?>
            <label for="description">Description:</label>
                <?php echo @form_textarea('description', set_value('description', $data['description']), 'id="description" class="formelement small"'); ?>
            <span class="tip">Give your brief description here</span>   
            <br class="clear" />
           
            <label for="author">Author:</label>
                <?php echo @form_input('author', set_value('author', $data['author']), 'id="author" class="formelement"'); ?>
            <span class="tip">Give Author name here</span>      
            <br class="clear" />  
                
            <label for="location">Location:</label>
                <?php echo @form_input('location', set_value('location', $data['location']), 'id="location" class="formelement"'); ?>
               <span class="tip">Author Location  here</span>  
               <br class="clear" />  <br>
           
    <p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>
	
</form>
