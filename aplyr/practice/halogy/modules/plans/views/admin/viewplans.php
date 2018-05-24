<h1 class="headingleft">Plans</h1>

<div class="headingright">
	<?php //if (in_array('plans_edit', $this->permission->permissions)): ?>
		<a href="<?php echo site_url('/admin/plans/add_plans'); ?>" class="button">Add Plan</a>
	<?php //endif; ?>
</div>

<?php if ($plans): ?>

<?php echo $this->pagination->create_links(); ?>

<table class="default clear">
	<tr>
		<th>Plans</th>
		<th>Created Date</th>
		<th class="narrow">Published</th>
		<th class="tiny">&nbsp;</th>
		<th class="tiny">&nbsp;</th>
	</tr>
<?php foreach ($plans as $plan): ?>
	<tr class="<?php echo (!$plan['created_date']) ? 'draft' : ''; ?>">
		<td><?php //echo (in_array('plans_edit', $this->permission->permissions)) ? anchor('/admin/plans/edit_plans/'.$plan['planID'], $plan['plan_name']) : $plan['plan_name']; ?>
                <?php echo $plan['plan_name']; ?>
                </td>
		<td><?php echo dateFmt($plan['created_date'], '', '', TRUE); ?></td>
		<td>
			<?php
				if ($plan['created_date']) echo '<span style="color:green;">Yes</span>';
				else echo 'No';
			?>
		</td>
		<td class="tiny">
			<?php //if (in_array('plans_edit', $this->permission->permissions)): ?>
				<?php echo anchor('/admin/plans/edit_plans/'.$plan['planID'], 'Edit'); ?>
			<?php //endif; ?>
		</td>
		<td class="tiny">			
			<?php //if (in_array('plans_delete', $this->permission->permissions)): ?>
				<?php echo anchor('/admin/plans/delete_plans/'.$plan['planID'], 'Delete', 'onclick="return confirm(\'Are you sure you want to delete this?\')"'); ?>
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