<?php
// Initialize error message
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($conn->real_escape_string($_POST['email']));
    $password = $conn->real_escape_string($_POST['password']);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_DEFAULT);

    // Validate form fields
    if (empty($email) || empty($password)) {
        $error_message = "Email and password are required.";
    } else {

        // Check if email exists
        if ($stmt = $conn->prepare("SELECT id, first_name, middle_name, last_name, password,status,vid FROM users WHERE email = ?")) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id, $first_name, $middle_name, $last_name, $hashed_password, $status, $vid);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    if ($status != 1) {
                        // print_r($status);
                        // exit();
                        echo "<script>location.href='verify.php?vid='$vid</script>";
                        exit();
                    } else {

                        // Start a session and store user information
                        // session_start();
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_name'] = trim($first_name . ' ' . $middle_name . ' ' . $last_name);
                        echo "<script>location.href='home.php'</script>";
                        exit();
                    }
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


<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-xl self-center font-semibold text-gray-900 ">
                    Sign in
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                    data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="name@company.com" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Your
                            password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                required />
                            <i class="ri-eye-off-line login__toggle-password absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer text-gray-500"
                                id="toggle-password">
                            </i>
                        </div>
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value=""
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                            </div>
                            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 ">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline =">Forgot your password?</a>
                    </div>
                    <button type="submit" name="login"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Login
                        to your account</button>
                    <div class="text-sm font-medium text-gray-500 ">
                        Not registered? <a data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" href="signup2.php" class="text-blue-700 hover:underline ">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


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