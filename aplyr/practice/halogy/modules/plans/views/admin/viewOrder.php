<h1 class="headingleft">Orders</h1>

<div class="headingright">

</div>

<?php if ($order): ?>

    <?php echo $this->pagination->create_links(); ?>

    <table class="default clear">




        <tr>
            <td>ID</td>
            <td><?php //echo (in_array('plans_edit', $this->permission->permissions)) ? anchor('/admin/plans/edit_plans/'.$order['planID'], $order['plan_name']) : $order['plan_name'];   ?>
                <?php echo $order['order_id']; ?>
        </tr>
        <tr>
            <td>Date</td>
            <td><?php echo dateFmt($order['date'], '', '', TRUE); ?></tr>
        <tr>
            <td>User</td>
            <td>
                <?php echo $order['firstName'] . '   ' . $order['lastName']; ?>
        </tr>
        <tr>
            <td>Credit</td>
            <td>
                <?php echo $order['no_of_credit']; ?>
        </tr>
        <tr>
            <td>Per Day Limit</td>
            <td>
                <?php echo $order['per_day_limit']; ?>
        </tr>
        <tr>
            <td>Price</td>
            <td>
                <?php echo $order['plan_price']; ?>
        </tr>
        <tr>
            <td>bil_email</td>
            <td>
                <?php echo $order['bil_email']; ?>
        </tr>



    </table>

    <?php echo $this->pagination->create_links(); ?>

    <p style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>

<?php else: ?>

    <p class="clear">There are no blog posts yet.</p>

<?php endif; ?>