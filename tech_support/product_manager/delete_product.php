<?php
session_start();

require('../model/database.php'); // Include the database connection

// Getting data from the form
$productCode = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);

if ($productCode && !empty($productCode)) {
    echo "Product Code: " . htmlspecialchars($productCode) . "<br>";  // Display for debugging
    
    // Prepare the DELETE statement
    $query = "DELETE FROM products WHERE productCode = :code";
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $productCode);
    
    try {
        // Execute the DELETE statement
        $statement->execute();
        $statement->closeCursor();
        echo "Product deleted successfully."; // Optional debug message
        
        // Redirect back to the index page after deletion
        header("Location: index.php");
        exit;
        
    } catch (PDOException $e) {
        // Error handling
        echo "Error executing query: " . $e->getMessage();
        exit;
    }
} else {
    // Error handling if product code is not received
    echo "Error: No product code received or code is invalid.";
    exit;
}
?>
