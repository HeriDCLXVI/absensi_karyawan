<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

$result = mysqli_query($connect, "SELECT users.id as user_id, * FROM users join karyawan on users.karyawan_id = karyawan.id where users.id != 1");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	    	<form class="login-form">
	    		<div class="title">
	    			<span>Users</span>
	    		</div>
		        <table width='100%' border=1>
			        <tr>
			            <th>Username</th>
			            <th>Name</th>
			            <th>Address</th>
			            <th>Gender</th>
			            <th>Phone Number</th>
			            <th>Status</th>
			            <th>Update</th>
			        </tr>
			        <?php
				        while($data = mysqli_fetch_array($result)) {         
				            echo "<tr>";
				            echo "<td>".$data['username']."</td>";
				            echo "<td>".$data['nama']."</td>";
				            echo "<td>".$data['alamat']."</td>";
				            echo "<td>".$data['jenis_kelamin']."</td>";
				            echo "<td>".$data['nohp']."</td>";
				            echo "<td>".$data['status']."</td>";
				            echo "<td><a href='usereditstatus.php?id=$data[user_id]'>Edit Status</a> | <a href='usereditpassword.php?id=$data[user_id]'>Edit Password</a> | <a href='userdelete.php?id=$data[user_id]'>Delete</a></td></tr>";
				        }
			        ?>
			    </table>
		        <div class="button-wrapper">
					<a href="useradd.php"><button type="button">Add New User</button></a>
					<a href="dashboard.php"><button type="button">Back</button></a>
				</div>
			</form>
	    </div>
	</div>
</body>
</html>