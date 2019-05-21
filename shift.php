<?php 

require_once 'core/init.php';
if(not_logged_in()) {
	header('location: index.php');
}
if (logged_in() && $_SESSION['status'] == 'employee') {
	header('location: dashboardkaryawan.php');
}

$result = mysqli_query($connect, "SELECT * FROM shift");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shift</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
	<div class="container">
	    <div class="form-wrapper">
	    	<form class="login-form">
	    		<div class="title">
	    			<span>Shift</span>
	    		</div>
		        <table width='100%' border=1>
			        <tr>
			            <th>Name</th>
			            <th>Start Time</th>
			            <th>End Time</th>
			            <th>Update</th>
			        </tr>
			        <?php
				        while($data = mysqli_fetch_array($result)) {         
				            echo "<tr>";
				            echo "<td>".$data['nama']."</td>";
				            echo "<td>".$data['jam_mulai']."</td>";
				            echo "<td>".$data['jam_selesai']."</td>";
				            echo "<td class='center'><a href='shiftedit.php?id=$data[id]'>Edit</a> | <a href='shiftdelete.php?id=$data[id]'>Delete</a></td></tr>";
				        }
			        ?>
			    </table>
		        <div class="button-wrapper">
					<a href="shiftadd.php"><button type="button">Add New Shift</button></a>
					<a href="dashboard.php"><button type="button">Back</button></a>
				</div>
			</form>
	    </div>
	</div>
</body>
</html>