<?php
session_start();
require('../model/database.php');

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
        <h2>Customer Login</h2>
        <p>You must enter the customer's email address to select teh customer</p>
        <form action="validation_page.php" method="post" style="display: flex; align-items: center; flex-direction: row; justify-content: start;">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="Enter customer's email" style = "width: 200px;">
        <input type="hidden" name="custID" value="<?php echo $customer['customerID']; ?>"/>
        <input type="submit" value="Get Customer">
    </form>
      </main>
      <footer>
    <p class="copyright">
        &copy; <?php echo date("Y"); ?> SportsPro, Inc.
    </p>
</footer>
</body>
</html>