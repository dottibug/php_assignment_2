<?php
// -----------------------------------------------------------------------------------------------
// Product Manager
// The main interface for managing products. Users can add or delete products.
// -----------------------------------------------------------------------------------------------

// Database connection
require_once '../database.php';

// Get all products
$query = "SELECT *, DATE_FORMAT(releaseDate, '%m-%d-%y') AS releaseDate FROM products";
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2>Product List</h2>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th></th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['version']; ?></td>
                <td><?php echo $product['releaseDate']; ?></td>
                <td>
                    <form action="db_delete_product.php" method="post">
                        <input type="hidden" name="productCode"
                               value="<?php echo $product['productCode']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="add_product.php">Add Product</a>
</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>

