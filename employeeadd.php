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
    if(addEmployee() === TRUE) {
		header("location: employee.php");
    }

}
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	                <div class="button-wrapper">
	    				<a href="index.php"><button type="button">Go to Home</button></a>
	    				<a href="employee.php"><button type="button">Back</button></a>
	                </div>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Name</h4>
	                <input class="input" type="text" name="nama" placeholder="Name" autocomplete="off" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Address</h4>
	                <input class="input" type="text" name="alamat" placeholder="Address" autocomplete="off" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Gender</h4>
	                <select class="input" name="jenis_kelamin" required>
	                	<option value="" selected disabled>Select Gender</option>
	                	<option value="L">Male</option>
	                	<option value="P">Female</option>
	                </select>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Phone Number</h4>
	                <input class="input" type="number" name="nohp" placeholder="Phone Number" autocomplete="off" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Department</h4>
	                <select class="input" name="department_id" required>
	                	<option value="" selected disabled>Select Department</option>
	            		<?php
							$result = mysqli_query($connect, "SELECT * FROM department");
							while($data = mysqli_fetch_array($result)) {         
							    echo "<option value='$data[id]'>".$data['nama']."</td>";
							}
	            		?>
	            	</select>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Shift</h4>
	                <select class="input" name="shift_id" required>
	                	<option value="" selected disabled>Select Shift</option>
	            		<?php
							$result = mysqli_query($connect, "SELECT * FROM shift");
							while($data = mysqli_fetch_array($result)) {         
							    echo "<option value='$data[id]'>".$data['nama']."</td>";
							}
	            		?>
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