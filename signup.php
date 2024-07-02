<?php
$title = "Signup";
include ('./common/header.php');
use Ramsey\Uuid\Uuid;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'us1-mta1.sendclean.net';
$mail->SMTPAuth = true;
$mail->Username = 'smtp94454398';
$mail->Password = 'rZ7dMEh2sS';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Recipients
$mail->setFrom('no-reply@stringocean.com', 'Purulia Doctors');

// Initialize error and success messages
$error_message = "";
$success_message = "";
$form_success = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $first_name = $_POST['first_name'];
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $profile_image = null;
    $vid = Uuid::uuid4();
    $otp = rand(111111, 999999);
    // Validate form fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($password) || empty($c_password)) {
        $error_message = "All fields except middle name are required.";
    } else if ($password !== $c_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = "Email already exists.";
        } else {
            // Handle file upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "uploads/";
                $file_name = basename($_FILES["profile_image"]["name"]);
                $target_file = $target_dir . $file_name;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Validate file type and size
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif' , 'avif'];
                if (!in_array($imageFileType, $allowed_types)) {
                    $error_message = "Only JPG, JPEG, PNG & GIF files are allowed.";
                } else if ($_FILES["profile_image"]["size"] > 50000000) { // 5000KB max size
                    $error_message = "Your file is too large.";
                } else {
                    // Check if the directory exists
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                        $profile_image = $target_file;
                    } else {
                        $error_message = "There was an error uploading your file.";
                    }
                }
            }

            // If no error, proceed to insert user data
            if (empty($error_message)) {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, email, phone, password, profile_image, vid, otp) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");
                $stmt->bind_param("sssssssss", $first_name, $middle_name, $last_name, $email, $phone, $hashed_password, $profile_image, $vid, $otp);

                // Execute the query
                if ($stmt->execute()) {
                    $mail->addAddress($email, $first_name . ' ' . $last_name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Verify your email!';
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
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>OTP Verification</h1>
            </div>
            <div class='content'>
                <p>Dear $first_name,</p>
                <p>Thank you for using our service. Please use the following OTP to complete your verification process:</p>
                <a class='otp'>$otp</a>
                <p>If you did not request this OTP, please ignore this email.</p>
            </div>
            <div class='footer'>
                <p>&copy; " . date('Y') . " Purulia Doctors. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";

                    $mail->send();
                    $success_message = "Your account has been created successfully.";
                    $form_success = true;
                    echo "<script>location.href='./verify.php?vid=$vid'</script>";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
            }
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
<main>
    <br>
    <div class="hero"
        style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
        <!--==================== LOGIN ====================-->
        <div class="login glass height" style="height : 180vh" id="login">
            <form action="signup.php" method="POST" class="login__form" enctype="multipart/form-data">
                <h2 class="login__title">Sign up</h2>

                <div class="login__group">
                    <div>
                        <label for="first_name" class="login__label">First Name</label>
                        <input type="text" name="first_name" placeholder="Write your First Name" id="first_name"
                            class="login__input" required>
                    </div>
                    <div>
                        <label for="middle_name" class="login__label">Middle Name</label>
                        <input type="text" name="middle_name" placeholder="Write your Middle Name (optional)"
                            id="middle_name" class="login__input">
                    </div>
                    <div>
                        <label for="last_name" class="login__label">Last Name</label>
                        <input type="text" name="last_name" placeholder="Write your Last Name" id="last_name"
                            class="login__input" required>
                    </div>
                    <div>
                        <label for="email" class="login__label">Email</label>
                        <input type="email" name="email" placeholder="Write your email" id="email" class="login__input"
                            required>
                    </div>
                    <div>
                        <label for="phone" class="login__label">Phone No</label>
                        <input type="number" name="phone" placeholder="Write your Phone No" id="phone"
                            class="login__input" required>
                    </div>
                    <div>
                        <label for="profile_image" class="login__label">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="login__input">
                    </div>
                    <div>
                        <label for="password" class="login__label">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" id="password"
                            class="login__input" required>
                    </div>
                    <div>
                        <label for="c-password" class="login__label">Confirm Password</label>
                        <input type="password" name="c_password" placeholder="Confirm password" id="c-password"
                            class="login__input" required>
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <div id="error-message" class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                </div>

                <div>
                    <p class="login__signup">
                        have an account? <a href="login.php">Log In</a>
                    </p>

                    <button type="submit" class="login__button" name="signup">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</main>

<!--=============== MAIN JS ===============-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('phone').addEventListener('input', function (e) {
        var phoneInput = e.target;
        var phoneValue = phoneInput.value;
        if (phoneValue.length > 10) {
            phoneInput.value = phoneValue.slice(0, 10);
        }
    });
    document.getElementById('c-password').addEventListener('input', function () {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('c-password').value;
        var errorMessage = document.getElementById('error-message');

        if (confirmPassword === '') {
            document.getElementById('c-password').classList.remove('error');
            errorMessage.style.display = 'none';
        } else if (password !== confirmPassword) {
            document.getElementById('c-password').classList.add('error');
            errorMessage.style.display = 'block';
        } else {
            document.getElementById('c-password').classList.remove('error');
            errorMessage.style.display = 'none';
        }
    });

    <?php if ($form_success): ?>
        // Display success message and redirect
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?php echo $success_message; ?>',
            showConfirmButton: false,
            timer: 3000 // Auto close after 3 seconds
        }).then(function () {
            window.location.href = 'verify.php?vid='<?= $vid ?>;
        });
    <?php endif; ?>
</script>
</body>

</html>