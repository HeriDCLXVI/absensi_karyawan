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

	$sql = "UPDATE lokasi set nama = '$nama' where id = '$id'";
	$query = $connect->query($sql);
	if($query === TRUE) {
		echo "<script>alert('Data updated'); window.location.href = 'location.php';</script>";
	}
	$connect->close();
}

?>

<?php

$id = $_GET['id'];
$data = getLocationDataById($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Location</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	            	<span>Edit Location</span>
	            </div>
	            <div class="input-wrapper">
	            	<h4>Name</h4>
					<input class="input" type="text" name="nama" autocomplete="off" placeholder="Name" value="<?php echo $data['nama']; ?>" required/>
	            </div>
	            <div class="button-wrapper">
	            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
					<button type="submit" name="update">Update</button>
	    			<a href="location.php"><button type="button">Back</button></a>
	            </div>
	        </form>
	    </div>
	</div>
</body>
</html>