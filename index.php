<?php 

require_once 'core/init.php';

if(logged_in() === TRUE) {
    header('location: dashboard.php');
}

// form submiited
if($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username && $password) {
        if(userExists($username) == TRUE) {
            $login = login($username, $password);
            if($login) {
                $userdata = userdata($username);

                $_SESSION['id'] = $userdata['id'];
                $_SESSION['username'] = $userdata['username'];
                $_SESSION['status'] = $userdata['status'];

                header('location: dashboard.php');
                exit();
                    
            } else {
                echo "<script>alert('Incorrect username/password combination')</script>";
            }
        } else{
            echo "<script>alert('Username does not exist')</script>";
        }
    }

} //

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/website.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <form class="login-form" action="" method="POST">
                <div class="title">
                    <span>
                        Login
                    </span>
                </div>
                <div class="input-wrapper">
                    <input class="input" type="text" name="username" id="username" autocomplete="off" placeholder="Username" required/>
                </div>

                <div class="input-wrapper">
                    <input class="input" type="password" name="password" id="password" autocomplete="off" placeholder="Password" required/>
                </div>
                <div class="button-wrapper">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>