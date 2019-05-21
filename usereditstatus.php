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
    $status = $_POST['status'];

	$sql = "UPDATE users set status = '$status' where id = '$id'";
	$query = $connect->query($sql);
	if($query === TRUE) {
		echo "<script>alert('Data updated'); window.location.href = 'user.php';</script>";
	}
	$connect->close();
}

?>

<?php

$id = $_GET['id'];
$data = getUserDataByUserId($id);

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
	            	<h4>Status</h4>
	                <select class="input" name="status" required>
	                	<option value="" selected disabled>Select Status</option>
	                	<option value="admin" <?php if ($data['status'] == 'admin') { echo "selected"; } ?>>Admin</option>
	                	<option value="employee" <?php if ($data['status'] == 'employee') { echo "selected"; } ?>>Employee</option>
	            	</select>
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