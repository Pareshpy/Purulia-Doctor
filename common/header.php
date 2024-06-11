<?php

include('connection.php');
session_start();

$user = null;

if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    $get_user = "SELECT `id`, `first_name`, `email` FROM `users` WHERE `id` = ?";
    
    if ($stmt = $conn->prepare($get_user)) {
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $email);
        
        if ($stmt->fetch()) {
            $user = (object)[
                'id' => $id,
                'first_name' => $first_name,
                'email' => $email
            ];
        }

        // Close the statement
        $stmt->close();
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
                <!-- <li>
                    <?php if(!$user):?>
                    <a href="login.php" class="action_btn" ><i class="ri-user-line" id="login"></i></a>
                    <<?php else:?>
                        <p class="nav__link">Hello , <?= htmlspecialchars($user->first_name) ?></p></li>
                        <li>
                        <a href="logout.php" class="nav__link"><i class="ri-logout-circle-r-line"></i></a>
                    <?php endif?>
                </li> -->

                
            </ul>






            <div class="a-group">
                <?php if(!$user):?>
                <a href="login.php" class="action_btn"><i class="ri-user-line" id="login"></i></a>
                <?php else:?>
                        <p class="nav__link">Hi, <?= htmlspecialchars($user->first_name) ?></p></li>
                        <li>
                        <a href="logout.php" class="nav__link"><i class="ri-logout-circle-r-line"></i></a>
                    <?php endif?>
            </div>
        </div>
        
    </header>
</body>
</html>
