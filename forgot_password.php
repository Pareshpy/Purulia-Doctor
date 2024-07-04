<?php
$title = "Forgot Password";
include ('./common/header.php');
require 'vendor/autoload.php'; // Ensure PHPMailer is loaded
use Ramsey\Uuid\Uuid;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'us1-mta1.sendclean.net'; // Update this with your SMTP host
$mail->SMTPAuth = true;
$mail->Username = 'smtp94454398'; // Update this with your SMTP username
$mail->Password = 'rZ7dMEh2sS'; // Update this with your SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Recipients
$mail->setFrom('no-reply@stringocean.com', 'Purulia Doctors');

// Initialize error and success messages
$error_message = "";
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    // Validate email
    if (empty($email)) {
        $error_message = "Email is required.";
    } else {
        // Check if the email exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $token = bin2hex(random_bytes(50));
            $token_expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

            // Update the database with the reset token and expiry
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
            $stmt->bind_param("sss", $token, $token_expiry, $email);

            if ($stmt->execute()) {
                try {
                    // Send reset email
                    $mail->setFrom('no-reply@stringocean.com', 'Purulia Doctors');
                    $mail->addAddress($email, $first_name . ' ' . $last_name);
                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset Request';
                    $mail->Body = "
                    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f6f6f6;
                margin: 0;
                padding: 0;
            }
            .container {
                background-color: #ffffff;
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                padding: 20px 0;
                border-bottom: 1px solid #eeeeee;
            }
            .header h1 {
                margin: 0;
                color: #333333;
            }
            .content {
                padding: 20px;
            }
            .content p {
                color: #555555;
                line-height: 1.5;
            }
            .otp {
                display: inline-block;
                padding: 10px 20px;
                margin: 20px 0;
                font-size: 24px;
                color: #ffffff;
                background-color: #007bff;
                border-radius: 4px;
                text-decoration: none;
            }
            .footer {
                text-align: center;
                padding: 10px 0;
                border-top: 1px solid #eeeeee;
                color: #999999;
                font-size: 12px;
            }
            .a p {
                color: #fffff;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>OTP Verification</h1>
            </div>
            <div class='content'>
                <p>Dear $first_name,</p>
                <p>Thank you for using our service. Please use the following link to reset your Password:</p>
                <a class='otp' href='https://puruliadoctors.in/reset_password.php?token=$token' ><p>Reset Password</p></a>
                <p>If you did not request it, please ignore this email.</p>
            </div>
            <div class='footer'>
                <p>&copy; " . date('Y') . " Purulia Doctors. All rights reserved.</p>
            </div>
        </div>
    </body>
    // </html>
                    ";

                    $mail->send();
                    $success_message = "A password reset link has been sent to your email.";
                } catch (Exception $e) {
                    $error_message = "Mailer Error: " . $mail->ErrorInfo;
                }
            } else {
                $error_message = "Error: " . $stmt->error;
            }
        } else {
            $error_message = "Email not found.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<main>
    <br>
    <div class="hero"
        style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
        <div class="login glass height" style="height: 100vh" id="login">
            <form action="forgot_password.php" method="POST" class="login__form">
                <h2 class="login__title">Forgot Password</h2>
                <div class="login__group">
                    <div>
                        <label for="email" class="login__label">Email</label>
                        <input type="email" name="email" placeholder="Enter your email" id="email" class="login__input"
                            required>
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <div id="error-message" class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="login__button" name="forgot_password">Send Reset Link</button>
            </form>
        </div>
    </div>
</main>

<!--=============== MAIN JS ===============-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (!empty($success_message)): ?>
        // Display success message with SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Email Sent',
            text: <?php echo json_encode($success_message); ?>,
            showConfirmButton: true,
        }).then(function () {
            window.location.href = 'login.php';
        });
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        // Display error message with SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: <?php echo json_encode($error_message); ?>,
            showConfirmButton: true,
        });
    <?php endif; ?>
</script>
</body>

</html>