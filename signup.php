<?php
include ('./common/header.php');

// Initialize error and success messages
$error_message = "";
$success_message = "";
$form_success = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    // $email = strip_tags($email);
    // Validate form fields
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($c_password)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $c_password) {
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
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $otp = rand(111111,999999);
            $vid = rand(11111111,99999999);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password,otp,vid) VALUES (?, ?, ?, ?,?,?)");
            $stmt->bind_param("ssssss", $name, $email, $phone, $hashed_password,$otp,$vid);

            // Execute the query
            if ($stmt->execute()) {
                $success_message = "New record created successfully. Redirecting to login page...";
                $form_success = true;
            } else {
                $error_message = "Error: " . $stmt->error;
            }
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection

?>

    <main>
        <br>
        <div class="hero"
            style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
            <!--==================== LOGIN ====================-->
            <div class="login glass height" style="height : 200vh" id="login">
                <form action="signup.php" method="POST" class="login__form">
                    <h2 class="login__title">Sign up</h2>

                    <div class="login__group">
                        <div>
                            <label for="name" class="login__label">Name</label>
                            <input type="text" name="name" placeholder="Write your Name" id="Name" class="login__input" required>
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
                            Don't have an account? <a href="login.php">Log In</a>
                        </p>

                        <button type="submit" class="login__button">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!--=============== MAIN JS ===============-->
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
        alert("<?php echo $success_message; ?>");
        setTimeout(function() {
            window.location.href = 'verify.php?vid='.$vid;
        }, 3000); // Redirect after 3 seconds
        <?php endif; ?>
    </script>
</body>

</html>
