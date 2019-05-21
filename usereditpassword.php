<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_POST['id'];
    $newpassword = $_POST['password'];

	if (changePassword($id, $newpassword) === TRUE) {
		echo "<script>alert('Data updated'); window.location.href = 'user.php';</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	            	<span>Edit User</span>
	            </div>
	            <div class="input-wrapper">
	            	<h4>New Password</h4>
					<input class="input" type="password" name="password" autocomplete="off" placeholder="New Password" required/>
	            </div>
	            <div class="button-wrapper">
	            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
					<button type="submit" name="update">Update</button>
	    			<a href="user.php"><button type="button">Back</button></a>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>