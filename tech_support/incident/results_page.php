<?php
session_start();
require_once('../model/database.php');

// Retrieve the customer ID from the session
$customerID = $_SESSION['custID'];


// Fetch products registered by the customer using a join between registrations and products
$query = 'SELECT products.productCode, products.name
          FROM products
          INNER JOIN registrations ON products.productCode = registrations.productCode
          WHERE registrations.customerID = :customerID';
$statement = $db->prepare($query);
$statement->bindValue(':customerID', $customerID);
$statement->execute();
$registeredProducts = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">

<!-- The head section -->
<head>
    <meta charset="UTF-8">
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>

<!-- The body section -->
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
    <h2>Create Incident</h2>
    <form action="confirmation.php" method="post" style="display: block; float: left;">
        <p>Customer Name: <?php echo $_SESSION['customer'] ?></p>
        <p>Product:
            <select name="productCode" style="margin-left: 10px; width: fit-content;">
                <option value="">Select a product</option>
                <?php foreach ($registeredProducts as $product): ?>
                    <option value="<?php echo $product['productCode']; ?>">
                        <?php echo $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>Title:
            <input type="text" name="title">
        </p>

        <p>Description:<br>
            <textarea name="description" rows="5" cols="50"></textarea>
        </p>

        
        <input type="submit" value="Create Incident">
    </form>
</main>

<?php include '../view/footer.php'; ?>
</body>
</html>

