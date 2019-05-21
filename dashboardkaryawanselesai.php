<form class="login-form">
    <div class="title">
        <h3>
            Today's Attendance
        </h3><br/>
        <span>
            Hello, <?php echo $userdata['username']; ?>
        </span><br/>
    </div>
    <table width='100%' border=1>
        <tr>
            <th>Date In</th>
            <th>Date Out</th>
            <th>Reason</th>
            <th>Location</th>
            <th>Image</th>
        </tr>
        <?php
            $sql = "SELECT absensi.*, lokasi.nama as nama_lokasi FROM absensi join lokasi on absensi.lokasi_id = lokasi.id WHERE karyawan_id = '$karyawan_id' and CONVERT(tanggal_masuk, date) = CONVERT(NOW(), date)";
            $query = $connect->query($sql);
            while($data = mysqli_fetch_array($query)) {         
                echo "<tr>";
                echo "<td>".$data['tanggal_masuk']."</td>";
                echo "<td>".$data['tanggal_keluar']."</td>";
                echo "<td>".$data['alasan']."</td>";
                echo "<td>".$data['nama_lokasi']."</td>";
                echo "<td><img src='file/".$data['foto']."''></td></tr>";
            }
        ?>
    </table>
    <div class="button-wrapper">
        <a href="logout.php"><button type="button">Logout</button></a>
    </div>
</form>