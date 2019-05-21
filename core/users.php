<?php 

function addUser() {
	global $connect;

	$username = $_POST['username'];
	$password = $_POST['password'];
	$karyawan_id = $_POST['karyawan_id'];
	$status = $_POST['status'];
	
	$salt = salt(32);
	$newPassword = makePassword($password, $salt);
	if($newPassword) {
		$sql = "INSERT INTO users (username, password, salt, karyawan_id, status) VALUES ('$username', '$newPassword', '$salt' , '$karyawan_id', '$status')";
		$query = $connect->query($sql);
		echo $query;
		if($query === TRUE) {
			return true;
		} else {
			return false;
		}
	}
	$connect->close();
}

function addDepartment() {
	global $connect;

	$nama = $_POST['nama'];
	$sql = "INSERT INTO department (nama) VALUES ('$nama')";
	$query = $connect->query($sql);
	if($query === TRUE) {
		return true;
	} else {
		return false;
	}
	$connect->close();
}

function addShift() {
	global $connect;

	$nama = $_POST['nama'];
	$jam_mulai = $_POST['jam_mulai'];
	$jam_selesai = $_POST['jam_selesai'];

	$sql = "INSERT INTO shift (nama, jam_mulai, jam_selesai) VALUES ('$nama', '$jam_mulai', '$jam_selesai')";
	$query = $connect->query($sql);
	if($query === TRUE) {
		return true;
	} else {
		return false;
	}
	$connect->close();
}

function addLocation() {
	global $connect;

	$nama = $_POST['nama'];
	$sql = "INSERT INTO lokasi (nama) VALUES ('$nama')";
	$query = $connect->query($sql);
	if($query === TRUE) {
		return true;
	} else {
		return false;
	}
	$connect->close();
}

function addEmployee() {
	global $connect;

	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$nohp = $_POST['nohp'];
	$department_id = $_POST['department_id'];
	$shift_id = $_POST['shift_id'];

	$sql = "INSERT INTO karyawan (nama, alamat, jenis_kelamin, nohp, department_id, shift_id) VALUES ('$nama', '$alamat', '$jenis_kelamin', '$nohp', '$department_id', '$shift_id')";
	$query = $connect->query($sql);
	if($query === TRUE) {
		return true;
	} else {
		return false;
	}
	$connect->close();
}

function userExists($username) {
	// global keywords is used to access a global variable from within a function
	global $connect;

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$query = $connect->query($sql);
	if($query->num_rows == 1) {
		return true;
	} else {
		return false;
	}

	$connect->close();
	// close the database connection
}

function salt($length) {
	return mcrypt_create_iv($length);
}

function makePassword($password, $salt) {
	return hash('sha256', $password.$salt);
}

function userdata($username) {
	global $connect;
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	if($query->num_rows == 1) {
		return $result;
	} else {
		return false;
	}

	$connect->close();
	// close the database connection
}

function login($username, $password) {
	global $connect;
	$userdata = userdata($username);

	if($userdata) {
		$makePassword = makePassword($password, $userdata['salt']);
		$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$makePassword'";
		$query = $connect->query($sql);

		if($query->num_rows == 1) {
			return true;
		} else {
			return false;
		}
	}

	$connect->close();
	// close the database connection
}

function getUserDataByUserId($id) {
	global $connect;

	$sql = "SELECT * FROM users WHERE id = $id";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	return $result;

	$connect->close();
}

function getDepartmentDataById($id) {
	global $connect;

	$sql = "SELECT * FROM department WHERE id = $id";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	return $result;

	$connect->close();
}

function getShiftDataById($id) {
	global $connect;

	$sql = "SELECT * FROM shift WHERE id = $id";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	return $result;

	$connect->close();
}

function getLocationDataById($id) {
	global $connect;

	$sql = "SELECT * FROM lokasi WHERE id = $id";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	return $result;

	$connect->close();
}

function getEmployeeDataById($id) {
	global $connect;

	$sql = "SELECT * FROM karyawan WHERE id = $id";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
	return $result;

	$connect->close();
}

function users_exists_by_id($id, $username) {
	global $connect;

	$sql = "SELECT * FROM users WHERE username = '$username' AND id != $id";
	$query = $connect->query($sql);
	if($query->num_rows >= 1) {
		return true;
	} else {
		return false;
	}

	$connect->close();
}

function logged_in() {
	if(isset($_SESSION['id'])) {
		return true;
	} else {
		return false;
	}
}

function not_logged_in() {
	if(isset($_SESSION['id']) === FALSE) {
		return true;
	} else {
		return false;
	}
}

function logout() {
	if(logged_in() === TRUE){
		// remove all session variable
		session_unset();

		// destroy the session
		session_destroy();

		header('location: index.php');
	}
}

function passwordMatch($id, $password) {
	global $connect;

	$userdata = getUserDataByUserId($id);

	$makePassword = makePassword($password, $userdata['salt']);

	if($makePassword == $userdata['password']) {
		return true;
	} else {
		return false;
	}

	// close connection
	$connect->close();
}

function changePassword($id, $password) {
	global $connect;

	$salt = salt(32);
	$makePassword = makePassword($password, $salt);

	$sql = "UPDATE users SET password = '$makePassword', salt = '$salt' WHERE id = $id";
	$query = $connect->query($sql);

	if($query === TRUE) {
		return true;
	} else {
		return false;
	}
}
