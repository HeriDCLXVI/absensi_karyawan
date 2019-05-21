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
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

	$sql = "UPDATE shift set nama = '$nama', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai' where id = '$id'";
	$query = $connect->query($sql);
	if($query === TRUE) {
		echo "<script>alert('Data updated'); window.location.href = 'shift.php';</script>";
	}
	$connect->close();
}

?>

<?php

$id = $_GET['id'];
$data = getShiftDataById($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Shift</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	            	<span>Edit Shift</span>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Name</h4>
	                <input class="input" type="text" name="nama" placeholder="Name" autocomplete="off" value="<?php echo $data['nama']; ?>" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Start Time</h4>
					<input class="input-time" type="time" name="jam_mulai" autocomplete="off" value="<?php echo $data['jam_mulai']; ?>" required/>
	            </div>
	            <div class="input-wrapper">
	            	<h4>End Time</h4>
					<input class="input-time" type="time" name="jam_selesai" autocomplete="off" value="<?php echo $data['jam_selesai']; ?>" required/>
	            </div>
	            <div class="button-wrapper">
	            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
					<button type="submit" name="update">Update</button>
	    			<a href="shift.php"><button type="button">Back</button></a>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>