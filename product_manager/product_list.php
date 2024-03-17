<?php include '../view/header.php'; ?>
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
            <td><?php echo $product->getProductCode(); ?></td>
            <td><?php echo $product->getName(); ?></td>
            <td><?php echo $product->getVersion(); ?></td>
            <td><?php echo $product->getReleaseDate(); ?></td>
            <td>
                <form action="index.php" method="post" id="delete_product_form">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="productCode" value="<?php echo
                    $product->getProductCode(); ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="index.php?action=show_add_form">Add Product</a>
<?php include '../view/footer.php'; ?>
