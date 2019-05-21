<?php require_once 'core/init.php'; 

if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

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
	        <form class="login-form" action="" method="POST">
	            <div class="title">
	                <span>
	                	Attendance Report
	                </span>
	            </div>
	            <div class="input-wrapper">
	                <h4>Date From</h4>
	                <input class="input-time" type="date" name="tanggal_masuk" value="<?php 
	                	if (isset($_POST['tanggal_masuk'])) {
	                		echo $_POST['tanggal_masuk'];
	                	}
	                	else {
		                	echo date('Y-m-d');
	                	} ?>"
	                	required /><br/>
	                <h4>Date To</h4>
	                <input class="input-time" type="date" name="tanggal_keluar" value="<?php 
	                	if (isset($_POST['tanggal_keluar'])) {
	                		echo $_POST['tanggal_keluar'];
	                	}
	                	else {
		                	echo date('Y-m-d');
	                	} ?>"
	                	required /><br/>
	                <input type="checkbox" name="telat" <?php 
	                	if (isset($_POST['telat'])) {
	                		echo 'checked';
	                	}?> > Late<br>
	                <input type="checkbox" name="masalah" <?php 
	                	if (isset($_POST['masalah'])) {
	                		echo 'checked';
	                	}?>> Problem<br>
	            </div>
	            <div class="button-wrapper">
	                <button type="submit" name="submit">Filter</button>
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
	                	if (isset($_POST['submit'])) {
	                		$tanggal_masuk = $_POST['tanggal_masuk'];
	                		$tanggal_keluar = $_POST['tanggal_keluar'];

	                		$sql = "SELECT absensi.*, karyawan.nama as nama_karyawan, lokasi.nama as nama_lokasi 
	                		FROM absensi join lokasi on absensi.lokasi_id = lokasi.id 
	                		join karyawan on absensi.karyawan_id = karyawan.id 
	                		join shift on karyawan.shift_id = shift.id 
	                		WHERE CONVERT(absensi.tanggal_masuk, date) >= '$tanggal_masuk' AND
	                		CONVERT(absensi.tanggal_masuk, date) <= '$tanggal_keluar'";

	                		if (isset($_POST['telat'])) {
	                			$sql = $sql." AND CONVERT(absensi.tanggal_masuk, time) > CONVERT(shift.jam_mulai, time)";
	                		}
	                		if (isset($_POST['masalah'])) {
	                			$sql = $sql." AND absensi.alasan = ''";
	                		}

	                		$sql = $sql." ORDER BY absensi.tanggal_masuk DESC";
	                	}
	                	else {
	                		$sql = "SELECT absensi.*, karyawan.nama as nama_karyawan, lokasi.nama as nama_lokasi 
	                		FROM absensi join lokasi on absensi.lokasi_id = lokasi.id 
	                		join karyawan on absensi.karyawan_id = karyawan.id 
	                		join shift on karyawan.shift_id = shift.id 
	                		WHERE CONVERT(absensi.tanggal_masuk, date) = CONVERT(NOW(), date)
	                		ORDER BY absensi.tanggal_masuk DESC";	                		
	                	}
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
                <div class="button-wrapper">
        			<a href="dashboard.php"><button type="button">Back</button></a>
        		</div>
	        </form>
	    </div>
	</div>
</body>
</html>