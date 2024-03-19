<?php
// ------------------------------------------------------------------------------
// Interacts with product_manager table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Product.php';

class ProductsDB
{
    // ------------------------------------------------------------------------------
    // Get list of products (array of Product objects)
    // ------------------------------------------------------------------------------
    public function getProducts()
    {
        try {
            $db = Database::getDB();
            $query = 'SELECT * FROM products';
            $statement = $db->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
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
                $products[] = $product;
            }
            return $products;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Add product to products table
    // ------------------------------------------------------------------------------
    public function addProduct($product)
    {
        try {
            $db = Database::getDB();
            $productCode = $product->getProductCode();
            $name = $product->getName();
            $version = $product->getVersion();
            $releaseDate = $product->getReleaseDate();

            // Format release date for MySQL datetime datatype
            $dateObject = new DateTime($releaseDate);
            $releaseDate_f = $dateObject->format('Y-m-d H:i:s');

            $query = "INSERT INTO products (productCode, name, version, releaseDate) 
                        VALUES (:productCode, :name, :version, :releaseDate)";
            $statement = $db->prepare($query);
            $statement->bindValue(':productCode', $productCode);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':version', $version);
            $statement->bindValue(':releaseDate', $releaseDate_f);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Delete product (by productCode) from products table
    // ------------------------------------------------------------------------------
    public function deleteProduct($productCode)
    {
        try {
            $db = Database::getDB();
            $query = "DELETE FROM products WHERE productCode = :productCode";
            $statement = $db->prepare($query);
            $statement->bindValue(':productCode', $productCode);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }
}

?>