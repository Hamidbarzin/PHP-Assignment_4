<?php 
ini_set('session.cookie_lifetime', 0); 
session_start();
include 'view/header.php'; ?>
<main>
    <nav>
    <div class="admin">
    <h2>Administrators</h2>
    <ul>
        <li><a href="product_manager/index.php">Manage Products</a></li>
        <li><a href="technician_manager/index.php">Manage Technicians</a></li>
        <li><a href="customer_manager/index.php">Manage Customers</a></li>
        <li><a href="incident/customer_search.php">Create Incident</a></li>
        <li><a href="under_construction.php">Assign Incident</a></li>
        <li><a href="under_construction.php">Display Incidents</a></li>
    </ul>
    </div>
   
    <div class="tech">
    <h2>Technicians</h2>    
    <ul>
        <li><a href="under_construction.php">Update Incident</a></li>
    </ul>
    </div>
    
    <div class="customer">
    <h2>Customers</h2>
        <ul>
            <li><a href="product_registration/login_page.php">Register Product</a></li>
        </ul>
    </div>
   
    
    </nav>
</main>
<?php include 'view/footer.php'; ?>