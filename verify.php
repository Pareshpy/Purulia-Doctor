<?php
$title = "Verify";
include ('./common/header.php');
if (!isset($_GET['vid'])) {
    header("location:./login.php");
} else {
    $vid = $_GET['vid'];
    // echo $vid;
    $data = null;
    $stmt = "SELECT * FROM users WHERE `vid` = '$vid'";
    $run = $conn->query($stmt);
    if ($run->num_rows > 0) {
        $data = $run->fetch_object();
        // print_r($data);
    } else {
        header("location:./login.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify'])) {
        $otp = strip_tags(trim($conn->real_escape_string($_POST['otp'])));

        // Validate form fields
        if (empty($otp)) {
            $error_message = "OTP is required.";
        } elseif ($data->otp !== $otp) {
            $error_message = "Incorrect OTP.";
        } else {
            if (empty($error_message)) {
                $stmt = $conn->prepare("UPDATE users SET vid = ?, otp = ?, status = 1 WHERE vid = ?");
                $null = null;
                $stmt->bind_param("sss", $null, $null, $vid);

                // Execute the query
                if ($stmt->execute()) {
                    $success_message = "Your account has been verified successfully.";
                    $form_success = true;
                    echo "<script>location.href='./login.php'</script>";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
            }
        }
    }

}
?>
<main>
    <br>
    <div class="hero"
        style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
        <div class="login glass height" id="login">
            <form method="POST" class="login__form">
                <h2 class="login__title">Verify</h2>
                <p><?= $data->email ?></p>
                <div class="login__group">
                    <div>
                        <label for="otp" class="login__label">OTP</label>
                        <input type="text" name="otp" placeholder="XXXXXX" id="otp" class="login__input" maxlength="6"
                            required>
                    </div>
                    <!-- <div>
                        <label for="password" class="login__label">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" id="password"
                            class="login__input" required value="0000">
                        <i class="ri-eye-off-line login__toggle-password" id="toggle-password"></i>
                    </div> -->
                    <?php if (!empty($error_message)): ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                </div>
                <div>
                    <!-- <p class="login__signup">
                        Don't have an account? <a href="signup.php">Sign up</a>
                    </p>
                    <a href="forgot.php" class="login__forgot">Forgot password</a> -->
                    <button type="submit" class="login__button" name="verify">Verify</button>
            </form>
        </div>
    </div>
</main>