<?php 

require_once 'core/init.php'; 

if(not_logged_in() === TRUE) {
	header('location: index.php');
}

if($_POST) {
	$currentpassword = $_POST['currentpassword'];
	$newpassword = $_POST['password'];
	$conformpassword = $_POST['conformpassword'];

	if($currentpassword && $newpassword && $conformpassword) {
		if(passwordMatch($_SESSION['id'], $currentpassword) === TRUE) {

			if($newpassword != $conformpassword) {
				echo "<script>alert('New password does not match confirm password')</script>";
			} else {
				if(changePassword($_SESSION['id'], $newpassword) === TRUE) {
					echo "<script>alert('Successfully updated'); window.location.href = 'index.php';</script>";
				} else {
					echo "<script>alert('Error while updating the information')</script>";
				}
			}
			
		} else {
			echo "<script>alert('Current Password is incorrect')</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	                <span>
	                    Change Password
	                </span>
	            </div>
	            <div class="input-wrapper">
					<input class="input" type="password" name="currentpassword" autocomplete="off" placeholder="Current Password" required/>
	            </div>
	            <div class="input-wrapper">
					<input class="input" type="password" name="password" autocomplete="off" placeholder="New Password" required/>
	            </div>
	            <div class="input-wrapper">
					<input class="input" type="password" name="conformpassword" autocomplete="off" placeholder="Confirm Password" required/>
	            </div>

	            <div class="button-wrapper">
	                <button type="submit">Change Password</button>
					<a href="dashboard.php"><button type="button">Back</button></a>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>