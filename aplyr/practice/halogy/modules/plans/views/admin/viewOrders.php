<h1 class="headingleft">All Orders</h1>

<div class="headingright">
	
</div>

<?php
if ($orders): ?>

<?php echo $this->pagination->create_links(); ?>

<table class="default clear">
	<tr>
		<th>Orders</th>
		<th>Created Date</th>
                <th>User</th>
		<th>Selected Plan</th>
		<th class="tiny">&nbsp;</th>
		
	</tr>
       
<?php 
foreach ($orders as $order):
    ?>
        
	<tr >
		<td><?php //echo (in_array('plans_edit', $this->permission->permissions)) ? anchor('/admin/plans/edit_plans/'.$order['planID'], $order['plan_name']) : $order['plan_name']; ?>
                <?php echo $order['order_id']; ?>
                </td>
		<td><?php echo dateFmt($order['date'], '', '', TRUE); ?></td>
                <td>
                    	<?php echo $order['firstName'] .'   '.$order['lastName'];?>
		</td>
		<td>
			<?php echo $order['plan_name'];?>
		</td>
		<td class="tiny">
			<?php //if (in_array('plans_edit', $this->permission->permissions)): ?>
				<?php echo anchor('/admin/plans/viewOrder/'.$order['order_id'], 'View Order'); ?>
			<?php //endif; ?>
		</td>
		
	</tr>
<?php endforeach; ?>
</table>

<?php echo $this->pagination->create_links(); ?>

<p style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>

<?php else: ?>

<p class="clear">There are no blog posts yet.</p>

<?php endif; ?>