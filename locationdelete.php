<?php
// include database connection file
require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($connect, "DELETE FROM lokasi WHERE id= '$id'");

// After delete redirect to Home, so that latest user list will be displayed.
    header("Location: location.php");
?>