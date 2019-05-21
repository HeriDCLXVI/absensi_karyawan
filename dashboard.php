<?php require_once 'core/init.php'; 

if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	        <form class="login-form">
	            <div class="title">
	                <span>
	                    Hello, <?php echo $userdata['username']; ?>
	                </span>
	            </div>
	            <div class="button-wrapper">
					<a href="department.php"><button type="button">Department</button></a>
					<a href="shift.php"><button type="button">Shift</button></a>
					<a href="location.php"><button type="button">Location</button></a>
					<a href="employee.php"><button type="button">Employee</button></a>
					<a href="user.php"><button type="button">Users</button></a>
					<a href="reportattendance.php"><button type="button">Attendance Report</button></a>
					<a href="changepassword.php"><button type="button">Change Password</button></a>
					<a href="logout.php"><button type="button">Logout</button></a>
	            </div>
	        </form>
	    </div>

	    <div class="form-wrapper" style="margin-left: 20px;">
	        <form class="login-form">
	            <div class="title">
	                <span>
	                    Latest Attendance
	                </span>
	            </div>
			    <table width='100%' border=1>
			        <tr>
			            <th>Name</th>
			            <th>Date In</th>
			            <th>Date Out</th>
			            <th>Reason</th>
			            <th>Location</th>
			            <th>Image</th>
			        </tr>
			        <?php
			            $sql = "SELECT absensi.*, karyawan.nama as nama_karyawan, lokasi.nama as nama_lokasi 
			            FROM absensi join lokasi on absensi.lokasi_id = lokasi.id 
			            join karyawan on absensi.karyawan_id = karyawan.id 
			            WHERE CONVERT(tanggal_masuk, date) = CONVERT(NOW(), date) ORDER BY tanggal_masuk DESC LIMIT 5";
			            $query = $connect->query($sql);
			            while($data = mysqli_fetch_array($query)) {         
			                echo "<tr>";
			                echo "<td>".$data['nama_karyawan']."</td>";
			                echo "<td>".$data['tanggal_masuk']."</td>";
			                echo "<td>".$data['tanggal_keluar']."</td>";
			                echo "<td>".$data['alasan']."</td>";
			                echo "<td>".$data['nama_lokasi']."</td>";
			                echo "<td><img src='file/".$data['foto']."''></td></tr>";
			            }
			        ?>
			    </table>
			</form>
		</div>
	</div>
</body>
</html>