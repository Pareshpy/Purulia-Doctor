<?php
// Include the connection file
if (file_exists('connection.php')) {
    include('connection.php');
} else {
    die('File not found.');
}

// Initialize error message
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate form fields
    if (empty($email) || empty($password)) {
        $error_message = "Email and password are required.";
    } else {
        // Check if email exists
        if ($stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?")) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id, $user_name, $hashed_password);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // Start a session and store user information
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    header("Location: welcome.php");
                    exit();
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "No account found with that email.";
            }

            // Close the statement
            $stmt->close();
        } else {
            $error_message = "Failed to prepare statement.";
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>PD | Purulia Doctor</title>
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
            <div class="a-group">
                <a href="signup.php" class="a-login">Sign Up</a>
                <a href="login.php" class="a-login">Log In</a>
            </div>
        </div>
    </header>
    <main>
        <br>
        <div class="hero" style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
            <div class="login glass height" id="login">
                <form action="login.php" method="POST" class="login__form">
                    <h2 class="login__title">Log In</h2>
                    <div class="login__group">
                        <div>
                            <label for="email" class="login__label">Email</label>
                            <input type="email" name="email" placeholder="Write your email" id="email" class="login__input" required>
                        </div>
                        <div>
                            <label for="password" class="login__label">Password</label>
                            <input type="password" name="password" placeholder="Enter your password" id="password" class="login__input" required>
                            <i class="ri-eye-off-line login__toggle-password" id="toggle-password"></i>
                        </div>
                        <?php if (!empty($error_message)): ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="login__signup">
                            Don't have an account? <a href="signup.php">Sign up</a>
                        </p>
                        <a href="forgot.php" class="login__forgot">Forgot password</a>
                        <button type="submit" class="login__button">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        // Toggle password visibility
        const togglePassword = document.querySelector('#toggle-password');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the icon
            this.classList.toggle('ri-eye-line');
            this.classList.toggle('ri-eye-off-line');
        });
    </script>
</body>
</html>
