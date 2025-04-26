<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['terms']) && $_POST['terms'] == 'on') {
        // The user accepted the terms
        // You can store this information in a database, or redirect to another page
        echo "You have accepted the terms!";
        // Redirect or store info as needed
    } else {
        echo "You must accept the terms to proceed.";
    }
}
?>
