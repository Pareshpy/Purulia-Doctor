<?php
$title = "Reset Password";
include ('./common/header.php');

// Initialize error and success messages
$error_message = "";
$success_message = "";

// Check if token is present in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $error_message = "No token provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    // Validate token
    $stmt = $conn->prepare("SELECT email FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Validate form fields
        if (empty($password) || empty($c_password)) {
            $error_message = "Both password fields are required.";
        } else if ($password !== $c_password) {
            $error_message = "Passwords do not match.";
        } else {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Update the password in the database
            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
            $stmt->bind_param("ss", $hashed_password, $token);

            if ($stmt->execute()) {
                $success_message = "Your password has been reset successfully.";
                echo "<script>location.href='./login.php'</script>";
            } else {
                $error_message = "There was an error resetting your password.";
            }
        }
    } else {
        $error_message = "Invalid or expired token.";
    }

    $stmt->close();
}

$conn->close();
?>

<main>
    <br>
    <div class="hero" style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
        <div class="login glass height" style="height: 100vh" id="login">
            <form action="reset_password.php" method="POST" class="login__form">
                <h2 class="login__title">Reset Password</h2>
                <div class="login__group">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" />
                    <div>
                        <label for="password" class="login__label">New Password</label>
                        <input type="password" name="password" placeholder="Enter new password" id="password" class="login__input" required>
                    </div>
                    <div>
                        <label for="c-password" class="login__label">Confirm Password</label>
                        <input type="password" name="c_password" placeholder="Confirm new password" id="c-password" class="login__input" required>
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <div id="error-message" class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($success_message)): ?>
                        <div id="success-message" class="success-message"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="login__button" name="reset_password">Reset Password</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
