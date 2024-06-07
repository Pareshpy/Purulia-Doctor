<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
// Include the connection file
include('./common/header.php');
// global $conn;
?>

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
