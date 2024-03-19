<br>
<h2>Results</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Email Address</th>
        <th>City</th>
        <th></th>
    </tr>
    
    <!-- Search Results -->
    <?php foreach ($customers as $customer) : ?>
        <tr>
            <td><?php echo $customer->getFullName(); ?></td>
            <td><?php echo $customer->getAddress(); ?></td>
            <td><?php echo $customer->getCity(); ?></td>
            <td>
                <form action="index.php" method="post" id="show_update_form">
                    <input type="hidden" name="customerID"
                           value="<?php echo $customer->getID(); ?>">
                    <input type="hidden" name="action" value="show_update_form">
                    <input type="submit" value="Select">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
