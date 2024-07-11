<?php
include ('connection.php');

session_start();
$user = null;

if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    $get_user = "SELECT `id`, `first_name`, `middle_name`, `last_name`, `email`, `profile_image` FROM `users` WHERE `id` = ?";

    if ($stmt = $conn->prepare($get_user)) {
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $middle_name, $last_name, $email, $profile_image);

        if ($stmt->fetch()) {
            $user = (object) [
                'id' => $id,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'email' => $email,
                'profile_image' => $profile_image,
                'name' => trim($first_name . ' ' . $middle_name . ' ' . $last_name)
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
    <meta name="color-scheme" content="light only">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/notify.css" />
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <style>
        html.no-js {
            visibility: hidden;
        }
    </style>
    <script>
        (function() {
            document.documentElement.classList.remove('no-js');

            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <title><?= isset($title) ? $title . ' - Purulia Doctors' : 'Purulia Doctors' ?></title>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo"><a style="text-decoration:none;" href="index.php" class="nav__logo">PURULIA DOCTORS</a>
            </div>
            <ul class="links">
                <li><a href="#home" style="text-decoration:none;" class="nav__link">Home</a></li>
                <li><a href="catagories.php" style="text-decoration:none;" class="nav__link">Catagories</a></li>
                <li><a href="doctor.php" style="text-decoration:none;" class="nav__link">Doctors</a></li>
                <li><a href="clinic.php" style="text-decoration:none;" class="nav__link">Clinics</a></li>
                <li><a href="#about" style="text-decoration:none;" class="nav__link">About</a></li>
            </ul>

            <div class="a-group">
                <?php if (!$user): ?>
                    <a href="login.php" style="text-decoration:none;" class="action_btn"><i class="ri-user-line" id="login"></i></a>
                <?php else: ?>
                    <?php
                    // Use user's profile image if available, otherwise use default image
                    $user_image = $user->profile_image ? $user->profile_image : './assets/img/pic.svg';
                    ?>
                    <img src="<?= htmlspecialchars($user_image) ?>" class="user-pic" onclick="toggleMenu()">
                <?php endif ?>
            </div>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="<?= htmlspecialchars($user_image) ?>">
                        <h3><?= htmlspecialchars($user->first_name) ?></h3>
                    </div>
                    <hr>
                    <a href="" class="sub-menu-link">
                        <i class="ri-settings-line"></i>
                        <p>Profile</p>
                        <!-- <span>></span> -->
                    </a>
                    <a href="logout.php" class="sub-menu-link">
                        <i class="ri-logout-circle-line"></i>
                        <p>Logout</p>
                        <!-- <span>></span> -->
                    </a>
                </div>
            </div>
        </div>
    </header>
    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>

</html>