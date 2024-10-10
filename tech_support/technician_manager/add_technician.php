<?php
session_start();
declare(strict_types=1);
require_once('../model/database.php');
//getting data from form
$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


// code to save data to SQL database
//validating the inputs from add_contact_form
if ($firstName == null || $lastName == null || $email == null || $phone == null || $password == null) {
    $_SESSION['error'] = 'Invalid data. Please make sure all fields are filled';
    //redirecting to an error page
    $url = "../errors/error.php";
    header("Location: " . $url); //header is the method to redirect
    die(); // similar to return or break 
} else {

    //adding data to the database
    $query = "INSERT INTO technicians (firstName, lastName, email, phone, password) VALUES (:firstName, :lastName, :email, :phone, :password)";
    $statement = $db->prepare($query);

    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);

      $statement->execute();
      $statement->closeCursor();

}

$_SESSION['technician'] = $firstName . ' ' . $lastName;

// redirecting to confirmation page
header("Location: confirmation.php");
die();
?>
