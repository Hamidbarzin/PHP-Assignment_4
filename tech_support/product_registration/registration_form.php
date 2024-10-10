<?php
session_start();
require('../model/database.php');

$queryProducts = 'SELECT * FROM products';
$statement = $db-> prepare($queryProducts);
$statement-> execute();
$products = $statement->fetchAll();
$statement-> closeCursor();

// $query = 'SELECT * FROM customers WHERE customerID = :custID';
// $statement = $db->prepare($query);
// $statement->bindValue(':custID', $custID);
// $statement->execute();
// $customer = $statement->fetch();
// $statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" type="text/css"
          href="../main.css">
</head>

<!-- the body section -->
<body>
<header>
    <h1>SportsPro Technical Support</h1>
    <p>Sports management software for the sports enthusiast</p>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
        </ul>
    </nav>
</header>
      <main>
        <p>Customer: <?php echo $_SESSION['customer']?></p>
        <form action="confirmation.php" method="post" style="display: inline-block;">
            <div  style="display: flex; flex-direction: row; justify-content: start; align-items: center;">
                <label for="product">Product:</label>
                    <select name="productCode" style="margin-left: 10px; width: fit-content;">
                        <option value="">Select a product</option>
                            <?php foreach ($products as $product): ?>
                                <option value="<?php echo $product['productCode']; ?>">
                                    <?php echo $product['name']; ?>
                                 </option>
                            <?php endforeach; ?>
                    </select>
            </div>
            <input type="submit" value = "Register" style="margin: 20px; margin-left: 69px ">
            
    </form>
    
      </main>
      <p>You logged in as <?php echo $_SESSION['email']?></p>
      <form action="logout.php" method="post">
        <input type="submit" value="Logout" style="margin: 20px; margin-left: 69px;">
    </form>
      
      <footer>
    <p class="copyright">
        &copy; <?php echo date("Y"); ?> SportsPro, Inc.
    </p>
</footer>
</body>
</html>