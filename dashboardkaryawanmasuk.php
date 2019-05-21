<form class="login-form" action="" method="POST" enctype="multipart/form-data">
    <div class="title">
        <h3>
            Attendance In
        </h3><br/>
        <span>
            Hello, <?php echo $userdata['username']; ?>
        </span>
    </div>
    <div class="input-wrapper">
        <h4>Date In</h4>
        <input class="input-time" type="datetime-local" name="tanggal_masuk" value="<?php echo date('Y-m-d\TH:i:s'); ?>" required readonly/>
    </div>
    <div class="input-wrapper">
        <h4>Reason</h4>
        <input class="input" type="text" name="alasan" placeholder="Reason" autocomplete="off"/>
    </div>
    <div class="input-wrapper">
        <h4>Location</h4>
        <select class="input" name="lokasi_id" required>
            <option value="" selected disabled>Select Location</option>
            <?php
                $result = mysqli_query($connect, "SELECT * FROM lokasi");
                while($data = mysqli_fetch_array($result)) {         
                    echo "<option value='$data[id]'>".$data['nama']."</td>";
                }
            ?>
        </select>
    </div>
    <div class="input-wrapper">
        <h4>Upload Photo</h4>
        <input type="file" name="file" required>
    </div>
    <div class="button-wrapper">
        <button type="submit" name="submit_in">Submit</button>
        <a href="logout.php"><button type="button">Logout</button></a>
    </div>
</form>