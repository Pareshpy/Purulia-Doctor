<?php

include('connection.php');
session_start();

$user = null;

if(isset($_SESSION['user_id'])){
    $userid = $_SESSION['user_id'];
    $get_user = "SELECT `id`,`name`,`email` FROM `users` WHERE `id` = '$userid'";
    $run_user = $conn->query($get_user);
    if($run_user->num_rows > 0){
        $user = $run_user->fetch_object();
        // print_r($user);
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/notify.css" />
   
    <title>PD | Purulia Doctor</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="index.php" class="nav__logo">PURULIA DOCTOR</a></div>
            <ul class="links">
                <li><a href="#home" class="nav__link">Home</a></li>
                <li><a href="services.php" class="nav__link">Services</a></li>
                <li><a href="doctor.php" class="nav__link">Doctors</a></li>
                <li><a href="clinics.php" class="nav__link">Clinics</a></li>
                <li><a href="#about" class="nav__link">About</a></li>
            </ul>
            <div class="a-group">
                <?php if(!$user):?>
                <!-- <a href="signup.php" class="a-login">Sign Up</a>
                <a href="login.php" class="a-login">Log In</a> -->
                <a href="login.php" class="action_btn"><i class="ri-user-line" id="login"></i></a>
                <?php else:?>
                    <p><?=$user->name?></p>
                   <a href="logout.php"><i class="ri-logout-circle-r-line"></i></a>  
                    <?php endif?>
            </div>
        </div>
    </header>
