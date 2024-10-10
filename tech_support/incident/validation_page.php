<?php
session_start();
require_once('../model/database.php');

// Get email from form submission
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


$query = 'SELECT * FROM customers WHERE email = :email';
$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->execute();
$customer = $statement->fetch();
$statement->closeCursor();

// Check if customer is found
if ($customer) {
    // If found, set session variables
    $_SESSION['customer'] = $customer['firstName'] . ' ' . $customer['lastName'];
    $_SESSION['custID'] = $customer['customerID'];

    // Redirect to registration form
    header("Location: results_page.php");
    die();
} else {
    // If not found, set error message and redirect
    $_SESSION['error'] = 'Invalid email. No customer found with this email address.';
    header("Location: ../errors/error.php");
    die();
}
?>