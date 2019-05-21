<?php require_once 'core/init.php'; 
date_default_timezone_set('Asia/Jakarta');
if(not_logged_in()) {
	header('location: index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$karyawan_id = $userdata['karyawan_id'];

if (isset($_POST['submit_in'])) {
	$alasan = $_POST['alasan'];
	$tanggal_masuk = date('Y-m-d\TH:i:s');
	$lokasi_id = $_POST['lokasi_id'];

	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama = $_FILES['file']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$acak = rand(1,999);
	$nama_file_unik = $acak.$nama; 

	if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
	{
		if($ukuran > 0 && $ukuran < 1044070)
		{			
			move_uploaded_file($file_tmp, 'file/'.$nama_file_unik);
			$sql = "INSERT into absensi(tanggal_masuk, alasan, foto, karyawan_id, lokasi_id) VALUES('$tanggal_masuk', '$alasan', '$nama_file_unik', '$karyawan_id', '$lokasi_id')";
			$query = $connect->query($sql);
			if ($query) {
				echo "<script>alert('Attendance In Submitted'); window.location.href = 'dashboardkaryawan.php'; </script>";
			}
			else {
				echo "<script>alert('Attendance In Failed'); window.location.href = 'dashboardkaryawan.php'; </script>";
			}
		}
		else
		{		
			echo "<script>alert('File size too big'); window.location.href = 'dashboardkaryawan.php'; </script>";
		}
	}
	else
	{
		echo "<script>alert('File extension not allowed'); window.location.href = 'dashboardkaryawan.php'; </script>";
	}
}
elseif (isset($_POST['submit_out'])) {
	$tanggal_keluar = date('Y-m-d\TH:i:s');

	$sql = "SELECT * FROM absensi WHERE karyawan_id = '$karyawan_id' and CONVERT(tanggal_masuk, date) = CONVERT(NOW(), date)";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	$id = $result['id'];
	$sql = "UPDATE absensi set tanggal_keluar = '$tanggal_keluar' where id = '$id'";
	$query = $connect->query($sql);
	if ($query) {
		echo "<script>alert('Attendance Out Submitted'); window.location.href = 'dashboardkaryawan.php'; </script>";
	}
	else {
		echo "<script>alert('Attendance Out Failed'); window.location.href = 'dashboardkaryawan.php'; </script>";
	}
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
	    	<?php
	    		$sql = "SELECT * FROM absensi WHERE karyawan_id = '$karyawan_id' and CONVERT(tanggal_masuk, date) = CONVERT(NOW(), date)";
	    		$query = $connect->query($sql);
	    		if ($query) {
		    		$result = $query->fetch_assoc();
	    			if ($result['tanggal_masuk'] && $result['tanggal_keluar']) {
	    				include "dashboardkaryawanselesai.php";
	    			}
	    			elseif ($result['tanggal_masuk']) {
			    		include "dashboardkaryawankeluar.php";
	    			}
	    			else {
	    				include "dashboardkaryawanmasuk.php";
	    			}
	    		}
	    	?>
	    </div>
	</div>
</body>
</html>