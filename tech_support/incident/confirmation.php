<?php
session_start();
require_once('../model/database.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $customerID = $_SESSION['custID'];
    $productCode = filter_input(INPUT_POST, 'productCode', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    // Get the current date
    $dateOpened = date("Y-m-d");

    // Validate form inputs
    if (empty($productCode) || empty($title) || empty($description)) {
        $_SESSION['error'] = "All fields are required.";
        include '../errors/error.php';  // A simple error page to display errors
        exit();
    }

    // Insert the data into the incidents table
    $query = 'INSERT INTO incidents
                (customerID, productCode, dateOpened, title, description)
              VALUES
                (:customerID, :productCode, :dateOpened, :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->bindValue(':dateOpened', $dateOpened);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();

    // Redirect or display success message
    header("Location: confirmation.php");
    exit();
}
?>


<!DOCTYPE html>
<html>

<!-- The head section -->
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>

<!-- The body section -->
<body>
<header>
    <h1>SportsPro Technical Support</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Back home</a></li>
        </ul>
    </nav>
</header>

<main id="confirmation">
    <h2>Register Product</h2>
    <p>Thank you <?php echo $_SESSION['customer']?></p>
    <p>The incident was registered successfully.</p>


</main>

<footer>
    <p class="copyright">
        &copy; <?php echo date("Y"); ?> SportsPro, Inc.
    </p>
</footer>
</body>
</html>