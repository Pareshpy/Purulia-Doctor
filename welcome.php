<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        /* Center the main content */
        .welcome-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Adjust as needed */
            text-align: center;
        }

        .welcome-message {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .logout-button {
            padding: 0.5rem 2rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="index.php" class="nav__logo">PURULIA DOCTOR</a></div>
            <ul class="links">
                <li><a href="index.php" class="nav__link">Home</a></li>
                <li><a href="services.php" class="nav__link">Services</a></li>
                <li><a href="doctors.php" class="nav__link">Doctors</a></li>
                <li><a href="clinics.php" class="nav__link">Clinics</a></li>
                <li><a href="about.php" class="nav__link">About</a></li>
            </ul>
            <!-- No logout option in header -->
        </div>
    </header>

    <main>
        <div class="welcome-container">
            <h1 class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <form action="logout.php" method="POST">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </main>
</body>

</html>
