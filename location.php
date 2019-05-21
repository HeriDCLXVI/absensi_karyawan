<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

$result = mysqli_query($connect, "SELECT * FROM lokasi");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Location</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	    	<form class="login-form">
	    		<div class="title">
	    			<span>Location</span>
	    		</div>
		        <table width='100%' border=1>
			        <tr>
			            <th>Name</th>
			            <th>Update</th>
			        </tr>
			        <?php
				        while($data = mysqli_fetch_array($result)) {         
				            echo "<tr>";
				            echo "<td>".$data['nama']."</td>";
				            echo "<td class='center'><a href='locationedit.php?id=$data[id]'>Edit</a> | <a href='locationdelete.php?id=$data[id]'>Delete</a></td></tr>";
				        }
			        ?>
			    </table>
		        <div class="button-wrapper">
					<a href="locationadd.php"><button type="button">Add New Location</button></a>
					<a href="dashboard.php"><button type="button">Back</button></a>
				</div>
			</form>
	    </div>
	</div>
</body>
</html>