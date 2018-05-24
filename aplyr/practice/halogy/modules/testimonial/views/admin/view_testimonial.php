<h1 class="headingleft">Testimonials</h1>

<div class="headingright">
	<?php //if (in_array('plans_edit', $this->permission->permissions)): ?>
		<a href="<?php echo site_url('/admin/testimonial/add_testimonial'); ?>" class="button">Add Testimonial</a>
	<?php //endif; ?>
</div>

<?php if ($testimonial): ?>

<?php echo $this->pagination->create_links(); ?>

<table class="default clear">
	<tr>
		<th>Description</th>
                <th>Author</th>
                <th>Location</th>
                <th>Created Date</th>
		<th class="narrow">Published</th>
		<th class="tiny">&nbsp;</th>
		<th class="tiny">&nbsp;</th>
	</tr>
<?php foreach ($testimonial as $testimonials): ?>
	<tr class="<?php echo (!$testimonials['created_date']) ? 'draft' : ''; ?>">
		<td><?php //echo (in_array('plans_edit', $this->permission->permissions)) ? anchor('/admin/plans/edit_plans/'.$plan['planID'], $plan['plan_name']) : $plan['plan_name']; ?>
                <?php echo $testimonials['description']; ?>
                </td>
                <td><?php echo $testimonials['author']; ?></td>
                <td><?php echo $testimonials['location']; ?></td>
                <td><?php echo dateFmt($testimonials['created_date'], '', '', TRUE); ?></td>
		<td>
			<?php
				if ($testimonials['created_date']) echo '<span style="color:green;">Yes</span>';
				else echo 'No';
			?>
		</td>
		<td class="tiny">
			<?php //if (in_array('plans_edit', $this->permission->permissions)): ?>
				<?php echo anchor('/admin/testimonial/edit_testimonial/'.$testimonials['testID'], 'Edit'); ?>
			<?php //endif; ?>
		</td>
		<td class="tiny">			
			<?php //if (in_array('plans_delete', $this->permission->permissions)): ?>
				<?php echo anchor('/admin/testimonial/delete_testimonial/'.$testimonials['testID'], 'Delete', 'onclick="return confirm(\'Are you sure you want to delete this?\')"'); ?>
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
