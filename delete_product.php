<?php
include_once 'connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id='$product_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

header("Location: sellerauctions.php"); 
exit();
?>
