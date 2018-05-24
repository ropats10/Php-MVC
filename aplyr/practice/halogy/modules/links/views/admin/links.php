<h1 class="headingleft">Links</h1>
<div class="headingright">
	<?php if (in_array('pages_edit', $this->permission->permissions)): ?>
		<a href="<?php echo site_url('/admin/links/link_add'); ?>" class="button">Add Links</a>
	<?php endif; ?>
</div>

<?php if ($links): ?>
<?php echo $this->pagination->create_links(); ?>
<table class="default clear">
	<thead>
		<tr>
			<th class="narrow">Link ID</th>
			<th>URL</th>
			<th class="narrow">Comments</th>
			<th class="narrow">Link Status</th>
			<th class="tiny">&nbsp;</th>
            <th class="tiny">&nbsp;</th>
		</tr>
	</thead>
	<tbody id="shop_products">
	<?php foreach ($links as $link): ?>
		<tr id="event-<?php echo $link['ID']; ?>">
			<td class="col1"><?php echo $link['ID']; ?></td>
			<td class="col2"><?php echo (in_array('pages_edit', $this->permission->permissions)) ? anchor('/admin/links/edit_link/'.$link['ID'], $link['link_url']) : $link['link_url']; ?></td>
			<td class="col3"><?php echo $link['comments']; ?></td>
			<td class="col4"><?php 
					$values = array(
			'1'  => 'In Progress',
			'2' => 'Rejected',
			'3' => 'Action Required',
			'4' => 'Completed'
			);

			echo $values[$link['status']]; ?></td>
			<td class="col5">
				<?php if (in_array('pages_edit', $this->permission->permissions)): ?>	
					<?php echo anchor('/admin/links/edit_link/'.$link['ID'], 'Edit'); ?>
				<?php endif; ?>
			</td>
			<td>
				<?php if (in_array('pages_edit', $this->permission->permissions)): ?>	
					<?php echo anchor('/admin/links/delete_link/'.$link['ID'], 'Delete', 'onclick="return confirm(\'Are you sure you want to delete this?\')"'); ?>
				<?php endif; ?>
            
            </td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo $this->pagination->create_links(); ?>
<p style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>

<?php else: ?>
<br/>
<p>You haven't set up any Links yet.</p>

<?php endif; ?>
