<?php
// ------------------------------------------------------------------------------
// Interacts with product_manager table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Product.php';

class ProductDB
{
    // ------------------------------------------------------------------------------
    // Get list of product_manager (array of Product objects)
    // ------------------------------------------------------------------------------
    public static function getProducts()
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM products';
        $statement = $db->query($query);
        $result = $statement->fetchAll();
        $statement->closeCursor();

        // Create array of Product objects
        $products = array();
        foreach ($result as $row) {
            $product = new Product(
                $row['productCode'],
                $row['name'],
                $row['version'],
                $row['releaseDate']
            );
            $products[] = $product; // add new product to products array
        }
        return $products;
    }

    // ------------------------------------------------------------------------------
    // Add product to products table
    // ------------------------------------------------------------------------------
    public static function addProduct($product)
    {
        $db = Database::getDB(); // database connection

        $productCode = $product->getProductCode();
        $name = $product->getName();
        $version = $product->getVersion();
        $releaseDate = $product->getReleaseDate();

        // Format release date for MySQL datetime datatype
        $dateObject = new DateTime($releaseDate);
        $releaseDate_f = $dateObject->format('Y-m-d H:i:s');

        $query = "INSERT INTO products (productCode, name, version, releaseDate) VALUES (:productCode, :name, :version, :releaseDate)";
        $statement = $db->prepare($query);
        $statement->bindValue(':productCode', $productCode);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':releaseDate', $releaseDate_f);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    // ------------------------------------------------------------------------------
    // Delete product (by productCode) from products table
    // ------------------------------------------------------------------------------
    public static function deleteProduct($productCode)
    {
        $db = Database::getDB(); // database connection
        $query = "DELETE FROM products WHERE productCode = :productCode";
        $statement = $db->prepare($query);
        $statement->bindValue(':productCode', $productCode);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
}

?>