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
    if(addUser() === TRUE) {
		header("Location: user.php");
    }

}
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	                <div class="button-wrapper">
	    				<a href="index.php"><button type="button">Go to Home</button></a>
	    				<a href="user.php"><button type="button">Back</button></a>
	                </div>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Username</h4>
	                <input class="input" type="text" name="username" placeholder="Username" autocomplete="off" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Password</h4>
	            	<input class="input" type="password" name="password" placeholder="Password" autocomplete="off" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Related Employee</h4>
	            	<select class="input" name="karyawan_id" required>
	                	<option value="" selected disabled>Select Related Employee</option>
	            		<?php
							$result = mysqli_query($connect, "SELECT * FROM karyawan where id != 1 and id not in (SELECT karyawan_id from users)");
							while($data = mysqli_fetch_array($result)) {         
							    echo "<option value='$data[id]'>".$data['nama']."</td>";
							}
	            		?>
	            	</select>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Status</h4>
	            	<select class="input" name="status" required>
	                	<option value="" selected disabled>Select Status</option>
	                	<option value="admin">Admin</option>
	                	<option value="employee">Employee</option>
	            	</select>
	            </div>
	            <div class="button-wrapper">
					<button type="submit" name="submit">Create</button>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>