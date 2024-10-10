<?php
session_start();
require('../model/database.php');
require('../model/Technician.php');

// Fetch technicians from the database
$queryProducts = 'SELECT * FROM technicians';
$statement = $db->prepare($queryProducts);
$statement->execute();
$techniciansData = $statement->fetchAll(); 
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
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
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>&nbsp;</th> <!-- for delete button -->
        </tr>
        <?php foreach ($techniciansData as $technicianData): ?> <!-- using correct variable name -->
            <?php
            // Instantiate Technician object inside the loop
            $technician = new Technician(
                (int)$technicianData['techID'], 
                $technicianData['firstName'],
                $technicianData['lastName'], 
                $technicianData['email'],
                $technicianData['phone'],
                $technicianData['password']
            );
            ?>
            <tr>
                <td><?php echo htmlspecialchars($technician->getFullName()); ?></td>
                <td><?php echo htmlspecialchars($technician->getEmail()); ?></td>
                <td><?php echo htmlspecialchars($technician->getPhone()); ?></td>
                <td><?php echo htmlspecialchars($technician->getPassword()); ?></td>
                <td>
                    <form action="delete_tech.php" method="post">
                        <input type="hidden" name="techID" value="<?php echo htmlspecialchars($technician->getTechID()); ?>" />  
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p class="option"><a href="add_technician_form.php">Add a technician</a></p>
</main>

<?php include '../view/footer.php'; ?>
</body>
</html>
