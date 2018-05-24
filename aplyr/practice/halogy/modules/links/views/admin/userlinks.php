<style type="text/css">
    .first,.second,.third
    {
        display: inline;
    }
</style>
<h1 class="headingleft">User</h1>

<br><br><br>
<?php if ($users): ?><?php foreach ($users as $user): ?>
<div class="message">
    <div class="first" style="float:left;margin-left: 15px;padding-right:60px;"><h4>Username:</h4><?php echo $user['username']; ?></div>
    <div class="second" style="float:left;padding-right:60px;"><h4>Fullname:</h4><?php echo $user['firstName']." ".$user['lastName']; ?></div>
    <div class="third"><h4>Email:</h4><?php echo $user['email']; ?></div>
    <br><br>
            
               
    <?php endforeach; ?>
<?php endif; ?>
</div>
<?php if ($links): ?>
<h1 class="headingleft">User's links</h1>
<table class="default clear">
	<thead>
		<tr>
			
			<th class="narrow">URL</th>
			<th class="narrow">Comments</th>
			<th class="narrow">Link Status</th>
			
		</tr>
	</thead>
	<tbody id="shop_products">
	<?php foreach ($links as $link): ?>
		<tr id="event-<?php echo $link['ID']; ?>">
			<td class="col2"><?php echo (in_array('pages_edit', $this->permission->permissions)) ? anchor('/admin/links/edit_link/'.$link['ID'], $link['link_url']) : $link['link_url']; ?></td>
			<td class="col3"><?php echo $link['comments']; ?></td>
                        <td class="col4"><?php 
					//$values = array(
			//'1'  => 'In Progress',
			//'2' => 'Rejected',
			//'3' => 'Action Required',
			//'4' => 'Completed'
			//);

			echo $link['status']; ?></td>
                </tr>
	<?php endforeach; ?>
	</tbody>
</table>

    <?php echo $this->pagination->create_links(); ?><br>
<p style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>



<?php endif; ?>
