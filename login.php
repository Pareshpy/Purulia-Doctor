<?php
// Include the connection file
include('./common/header.php');

// Initialize error message
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($conn->real_escape_string($_POST['email']));
    $password = $conn->real_escape_string($_POST['password']);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_DEFAULT);

    // Validate form fields
    if (empty($email) || empty($password)) {
        $error_message = "Email and password are required.";
    } else {
        // Check if email exists
        if ($stmt = $conn->prepare("SELECT id, first_name, middle_name, last_name, password FROM users WHERE email = ?")) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id, $first_name, $middle_name, $last_name, $hashed_password);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // Start a session and store user information
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = trim($first_name . ' ' . $middle_name . ' ' . $last_name);
                    header("Location: index.php");
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
// $conn->close();
?>

<main>
    <br>
    <div class="hero" style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
        <div class="login glass height" id="login">
            <form action="login.php" method="POST" class="login__form">
                <h2 class="login__title">Log In</h2>
                <div class="login__group">
                    <div>
                        <label for="email" class="login__label">Email</label>
                        <input type="email" name="email" placeholder="Write your email" id="email" class="login__input" required value="prltubu@gmail.com">
                    </div>
                    <div>
                        <label for="password" class="login__label">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" id="password" class="login__input" required value="0000">
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
