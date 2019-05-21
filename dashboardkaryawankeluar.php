<form class="login-form" action="" method="POST">
    <div class="title">
        <h3>
            Attendance Out
        </h3><br/>
        <span>
            Hello, <?php echo $userdata['username']; ?>
        </span>
    </div>
    <div class="input-wrapper">
        <h4>Date Out</h4>
        <input class="input-time" type="datetime-local" name="tanggal_keluar" value="<?php echo date('Y-m-d\TH:i:s'); ?>" required readonly/>
    </div>
    <div class="button-wrapper">
        <button type="submit" name="submit_out">Submit</button>
        <a href="logout.php"><button type="button">Logout</button></a>
    </div>
</form>