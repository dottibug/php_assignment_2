<?php
// -----------------------------------------------------------------------------------------------
// Customer Search Results
// Displays search results in a table. Users can select a result to update a customer, which is
// handled by add_update_customer.php
// -----------------------------------------------------------------------------------------------
?>
<h2>Results</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Email Address</th>
        <th>City</th>
        <th></th>
    </tr>

    <!-- SEARCH RESULTS -->
    <?php foreach ($customers as $customer) : ?>
        <tr>
            <td><?php echo $customer['firstName'] . ' ' . $customer['lastName']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td><?php echo $customer['city']; ?></td>
            <td>
                <form action="add_update_customer.php" method="post">
                    <input type="hidden" name="customerID"
                           value="<?php echo $customer['customerID']; ?>">
                    <input type="hidden" name="action" value="update">
                    <input type="submit" value="Select">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


