<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

$result = mysqli_query($connect, "SELECT karyawan.*, department.nama as department_name, shift.nama as shift_name FROM karyawan join department on karyawan.department_id = department.id join shift on karyawan.shift_id = shift.id where karyawan.id != 1");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	    	<form class="login-form">
	    		<div class="title">
	    			<span>Employee</span>
	    		</div>
		        <table width='100%' border=1>
			        <tr>
			            <th>Name</th>
			            <th>Address</th>
			            <th>Gender</th>
			            <th>Phone Number</th>
			            <th>Department</th>
			            <th>Shift</th>
			            <th>Update</th>
			        </tr>
			        <?php
				        while($data = mysqli_fetch_array($result)) {         
				            echo "<tr>";
				            echo "<td>".$data['nama']."</td>";
				            echo "<td>".$data['alamat']."</td>";
				            echo "<td>".$data['jenis_kelamin']."</td>";
				            echo "<td>".$data['nohp']."</td>";
				            echo "<td>".$data['department_name']."</td>";
				            echo "<td>".$data['shift_name']."</td>";
				            echo "<td><a href='employeeedit.php?id=$data[id]'>Edit</a> | <a href='employeedelete.php?id=$data[id]'>Delete</a></td></tr>";
				        }
			        ?>
			    </table>
		        <div class="button-wrapper">
					<a href="employeeadd.php"><button type="button">Add New Employee</button></a>
					<a href="dashboard.php"><button type="button">Back</button></a>
				</div>
			</form>
	    </div>
	</div>
</body>
</html>