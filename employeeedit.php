<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

if(isset($_POST['update']))
{   
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nohp = $_POST['nohp'];
    $department_id = $_POST['department_id'];
    $shift_id = $_POST['shift_id'];

	$sql = "UPDATE karyawan set nama = '$nama', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', nohp = '$nohp', department_id = '$department_id', shift_id = '$shift_id' where id = '$id'";
	$query = $connect->query($sql);
	if($query === TRUE) {
		echo "<script>alert('Data updated'); window.location.href = 'employee.php';</script>";
	}
	$connect->close();
}

?>

<?php

$id = $_GET['id'];
$data = getEmployeeDataById($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	            	<span>Edit Employee</span>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Name</h4>
					<input class="input" type="text" name="nama" autocomplete="off" placeholder="Name" value="<?php echo $data['nama']; ?>" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Address</h4>
	                <input class="input" type="text" name="alamat" placeholder="Name" autocomplete="off" value="<?php echo $data['alamat']; ?>" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Gender</h4>
	                <select class="input" name="jenis_kelamin" required>
	                	<option value="" selected disabled>Select Gender</option>
	                	<option value="L" <?php if ($data['jenis_kelamin'] == 'L') { echo "selected"; } ?>>Male</option>
	                	<option value="P" <?php if ($data['jenis_kelamin'] == 'P') { echo "selected"; } ?>>Female</option>
	                </select>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Phone Number</h4>
	                <input class="input" type="number" name="nohp" placeholder="Phone Number" autocomplete="off" value="<?php echo $data['nohp']; ?>" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Department</h4>
	                <select class="input" name="department_id" required>
	                	<option value="" selected disabled>Select Department</option>
	            		<?php
							$result = mysqli_query($connect, "SELECT * FROM department");
							while($department_data = mysqli_fetch_array($result)) {
								if ($data['department_id'] == $department_data['id']) {
								    echo "<option value='$department_data[id]' selected>".$department_data['nama']."</td>";
								}
								else {
								    echo "<option value='$department_data[id]'>".$department_data['nama']."</td>";
								}
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
							while($shift_data = mysqli_fetch_array($result)) {
								if ($data['shift_id'] == $shift_data['id']) {
								    echo "<option value='$shift_data[id]' selected>".$shift_data['nama']."</td>";
								}
								else {
								    echo "<option value='$shift_data[id]'>".$shift_data['nama']."</td>";
								}
							}
	            		?>
	            	</select>
	            </div>
	            <div class="button-wrapper">
	            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
					<button type="submit" name="update">Update</button>
	    			<a href="employee.php"><button type="button">Back</button></a>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>