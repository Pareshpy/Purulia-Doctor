<?php
include ('./common/header.php');

// Initialize error and success messages
$error_message = "";
$success_message = "";
$form_success = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $profile_image = null;

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
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($imageFileType, $allowed_types)) {
                    $error_message = "Only JPG, JPEG, PNG & GIF files are allowed.";
                } else if ($_FILES["profile_image"]["size"] > 500000) { // 500KB max size
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
                $stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, email, phone, password, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $first_name, $middle_name, $last_name, $email, $phone, $hashed_password, $profile_image);

                // Execute the query
                if ($stmt->execute()) {
                    $success_message = "Your account has been created successfully.";
                    $form_success = true;
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
            <div class="login glass height" style="height : 200vh" id="login">
                <form action="signup.php" method="POST" class="login__form" enctype="multipart/form-data">
                    <h2 class="login__title">Sign up</h2>

                    <div class="login__group">
                        <div>
                            <label for="first_name" class="login__label">First Name</label>
                            <input type="text" name="first_name" placeholder="Write your First Name" id="first_name" class="login__input" required>
                        </div>
                        <div>
                            <label for="middle_name" class="login__label">Middle Name</label>
                            <input type="text" name="middle_name" placeholder="Write your Middle Name (optional)" id="middle_name" class="login__input">
                        </div>
                        <div>
                            <label for="last_name" class="login__label">Last Name</label>
                            <input type="text" name="last_name" placeholder="Write your Last Name" id="last_name" class="login__input" required>
                        </div>
                        <div>
                            <label for="email" class="login__label">Email</label>
                            <input type="email" name="email" placeholder="Write your email" id="email" class="login__input" required>
                        </div>
                        <div>
                            <label for="phone" class="login__label">Phone No</label>
                            <input type="number" name="phone" placeholder="Write your Phone No" id="phone" class="login__input" required>
                        </div>
                        <div>
                            <label for="profile_image" class="login__label">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image" class="login__input">
                        </div>
                        <div>
                            <label for="password" class="login__label">Password</label>
                            <input type="password" name="password" placeholder="Enter your password" id="password" class="login__input" required>
                        </div>
                        <div>
                            <label for="c-password" class="login__label">Confirm Password</label>
                            <input type="password" name="c_password" placeholder="Confirm password" id="c-password" class="login__input" required>
                        </div>
                        <?php if (!empty($error_message)): ?>
                        <div id="error-message" class="error-message"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <p class="login__signup">
                            have an account? <a href="login.php">Log In</a>
                        </p>

                        <button type="submit" class="login__button">Sign Up</button>
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
    }).then(function() {
        window.location.href = 'login.php';
    });
    <?php endif; ?>
</script>
</body>
</html>