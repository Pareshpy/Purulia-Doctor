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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/notify.css" />
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <style>
        html.no-js {
            visibility: hidden;
        }
    </style>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
        
    </script>
   

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <title><?= isset($title) ? $title . ' - Purulia Doctors' : 'Purulia Doctors' ?></title>
</head>

<body class="bg-white dark:bg-gray-700">
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
                <!-- <button id="theme-toggle" type="button" class="gap-2 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
              <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
              <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
          </button> -->
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


