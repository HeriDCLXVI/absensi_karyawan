<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

    // Check If form submitted, insert form data into users table.
if(isset($_POST['submit'])) {
    // Insert user data into table
    if(addShift() === TRUE) {
		header("Location: shift.php");
    }

}
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Shift</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	                <div class="button-wrapper">
	    				<a href="index.php"><button type="button">Go to Home</button></a>
	    				<a href="shift.php"><button type="button">Back</button></a>
	                </div>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Name</h4>
	                <input class="input" type="text" name="nama" placeholder="Name" autocomplete="off" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Start Time</h4>
	                <input class="input-time" type="time" name="jam_mulai" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>End Time</h4>
	                <input class="input-time" type="time" name="jam_selesai" required/>
	            </div>
	            <div class="button-wrapper">
					<button type="submit" name="submit">Create</button>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>