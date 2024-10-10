<?php
session_start();
declare(strict_types=1);
require_once('../model/database.php');

// Getting data from the form
$code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$version = filter_input(INPUT_POST, 'version', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Cast version as a float
$release = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING); // Release date input from form

// Code to save data to SQL database
// Validating the inputs from add_product_form
if ($code == null || $name == null || $version == null || $release == null) {
    $_SESSION['error'] = 'Invalid data. Please make sure all fields are filled.';
    // Redirecting to an error page
    $url = "../errors/error.php";
    header("Location: " . $url);
    die(); 
}

//  switch statement to handle different date formats
switch (true) {
    case preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $release):
        // MM/DD/YYYY format (e.g., 10/02/2024)
        $releaseDateObj = DateTime::createFromFormat('m/d/Y', $release);
        break;

    case preg_match('/^\d{4}-\d{2}-\d{2}$/', $release):
        // YYYY-MM-DD format (e.g., 2024-10-02)
        $releaseDateObj = DateTime::createFromFormat('Y-m-d', $release);
        break;

    case preg_match('/^[A-Za-z]+\s+\d{1,2},?\s+\d{4}$/i', $release):
        // Month Day, Year format (e.g., October 2, 2024)
        $releaseDateObj = new DateTime($release); 
        break;

    case preg_match('/^\d{1,2}\s+[A-Za-z]+,?\s+\d{4}$/i', $release):
        // Day Month, Year format (e.g., 2 October, 2024)
        $releaseDateObj = new DateTime($release); 
        break;

    case preg_match('/^\d{1,2}[A-Za-z]+\s+\d{4}$/i', $release):
        // DayMonth Year format without spaces (e.g., 2October 2024)
        $releaseDateObj = new DateTime($release);
        break;

    case preg_match('/^\d{1,2}-[A-Za-z]+-\d{4}$/i', $release):
        // Day-Month-Year format with hyphens (e.g., 2-October-2024)
        $releaseDateObj = new DateTime($release); 
        break;

    case preg_match('/^[A-Za-z]+\s+\d{1,2}(?:st|nd|rd|th)?,?\s+\d{4}$/i', $release):
        // Month Day with ordinal suffix (e.g., October 2nd, 2024)
        $releaseDateObj = new DateTime($release); 
        break;

    default:
        // Invalid date format
        $_SESSION['error'] = 'Invalid date format. Please use a valid date format (MM/DD/YYYY, YYYY-MM-DD, Month Day Year, Day Month Year).';
        header("Location: ../errors/error.php");
        die();
}


// Ensure $releaseDateObj is valid
if (!$releaseDateObj) {
    $_SESSION['error'] = 'Invalid date format. Please use a valid date.';
    header("Location: ../errors/error.php");
    die();
}

// Format the date for SQL storage as 'Y-m-d'
$release = $releaseDateObj->format('Y-m-d');

    // Adding data to the database
    $query = "INSERT INTO products (productCode, name, version, releaseDate) VALUES (:code, :name, :version, :releaseDate)";
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':releaseDate', $release); // Insert properly formatted date
    $statement->execute();
    $statement->closeCursor();


// Set session to show the product name and version
$_SESSION['product'] = $name . ', version of (' . $version . ')';

// Redirect to confirmation page
header("Location: confirmation.php");
die();
?>
