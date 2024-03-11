<?php
// -----------------------------------------------------------------------------------------------
// Customer Search
// Search for customer by last name. Displays error messages if there are no results. Search
// results are processed by customer_search.php
// -----------------------------------------------------------------------------------------------

$lastName = filter_input(INPUT_POST, 'lastName');

// Get customer(s) by last name
if ($lastName) {
    require_once '../database.php';

    $query = 'SELECT * FROM customers WHERE lastName = :lastName';
    $statement = $db->prepare($query);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();

    // Display error message if customer not found
    if (!$customers) {
        $errors['lastName'] = 'No customer results. Try again.';
    }
}
?>

<h2>Customer Search</h2>

<form action="" method="post">
    <div class="formLabelInput">
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName"
               value="<?php echo $lastName ?? ''; ?>">

        <!-- Conditionally render error -->
        <?php if (isset($errors['lastName'])) : ?>
            <p class="error"><?php echo $errors['lastName']; ?></p>
        <?php endif; ?>
    </div>
    <input class="submitButtonIndent" type="submit">
</form>

