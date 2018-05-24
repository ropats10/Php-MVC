<script type="text/javascript" src="<?php echo $this->config->item('staticPath'); ?>/js/templates.js" /></script>
<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" class="default" name="form">
            <h1 class="headingleft">Add Plans <small>(<a href="<?php echo site_url('/admin/plans/viewplans'); ?>">Back to plans</a>)</small>
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
            <label for="planName">Plan Name:</label>
                <?php echo @form_input('planName', set_value('planName', $data['plan_name']), 'id="planName" class="formelement"'); ?>
            <span class="tip">Your Plan here.Having minimum 5 upto 15 characters</span>   
            <br class="clear" />
           
            <label for="noOfCredits">No Of credits:</label>
                <?php echo @form_input('noOfCredits', set_value('noOfCredits', $data['no_of_credit']), 'id="noOfCredits" class="formelement"'); ?>
            <span class="tip">Numeric No Of Credits here </span>      
            <br class="clear" />  
                
            <label for="CreditValidity">Credit Validity:</label>
                <?php echo @form_input('CreditValidity', set_value('CreditValidity', $data['credit_validity']), 'id="CreditValidity" class="formelement"'); ?>
               <span class="tip">Credit Validity here</span>  
                <br class="clear" />  
            
            <label for="perDayLimits">Limits Per Day:</label>
                <?php echo @form_input('perDayLimits', set_value('perDayLimits', $data['per_day_limit']), 'id="perDayLimits" class="formelement"'); ?>
            <span class="tip">Limits of per Day Links</span>     
                <br class="clear" />  
            
            <label for="customerSupport">Customer Support:</label>
                <?php echo @form_input('customerSupport', set_value('customerSupport', $data['customer_support']), 'id="customerSupport" class="formelement"'); ?>
               <span class="tip">Customer Support here</span>  
                <br class="clear" />         
              <label for="days">Days:</label>
		<?php echo @form_input('days', set_value('days', $data['days']), 'id="days" class="formelement"'); ?>
               <span class="tip">Customer Support here</span>  
                <br class="clear" /> 
            <label for="planPrice">Plan Price:</label>
                <?php echo @form_input('planPrice', set_value('planPrice', $data['plan_price']), 'id="planPrice" class="formelement"'); ?>
             <span class="tip">Plan Price here in Decimal Value</span>    
                <br class="clear" />  
            
            <label for="status">Status:</label>
                <?php 
                        $values = array(
                                0 => 'Active',
                                1 => 'Inactive',
                        );
                        echo @form_dropdown('status',$values,set_value('status', $data['status']), 'id="status" class="formelement"'); 
                ?>    
            <span class="tip">Status to keep You plan active or not</span>  
            <br class="clear" />  
            <label for="className">Choose Your class:</label>
                <?php 
                        $values = array(
                                'plantitle1' => 'Singal plan',
                                'plantitle2' => 'bronze plan',
                                'plantitle3' => 'Silver plan',
                                'plantitle4' => 'Gold plan'
                        );
                        echo @form_dropdown('className',$values,set_value('className', $data['class_name']), 'id="className" class="formelement"'); 
                ?>    
            <span class="tip">Choose Your class here For Styling Your Plan</span>  
            <br class="clear" />  
           
    <p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>
	
</form>
