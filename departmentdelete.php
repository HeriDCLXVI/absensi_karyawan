<?php
// include database connection file
require_once 'core/init.php';

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($connect, "DELETE FROM department WHERE id= '$id'");

// After delete redirect to Home, so that latest user list will be displayed.
    header("Location: department.php");
?>