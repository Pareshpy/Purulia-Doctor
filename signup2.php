<?php
$title = "Signup";
include('common/connection.php');
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
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'avif'];
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

  <title>Purulia Doctors</title>
</head>

<body class="bg-gray-1 ">
  <!-- navbar -->
  <header class="absolute inset-x-0 top-0  ">
    <nav class="flex items-center lg:justify-between md:justify-start p-6 lg:px-44 h-20 bg-white drop-shadow-lg"
      aria-label="Global">
      <div class="flex lg:hidden">
        <button id="menu-button" class="-m-2.5 inline-flex items-center justify-start rounded-md pr-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1">
          <span
            class="self-center lg:text-2xl  md:text-xl font-semibold whitespace-nowrap text-indigo-500 ml-4 ">PURULIA
            DOCTORS</span>
        </a>
      </div>
      <div class="hidden lg:flex lg:gap-x-12 ">
        <a href="#"
          class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">Categories</a>
        <a href="#"
          class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">Doctors</a>
        <a href="#"
          class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">Clinics</a>
        <a href="#"
          class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">About</a>
      </div>


      <div class="flex flex-1 justify-end mr-5">
        <a href="home.php"
          class="text-lg font-semibold text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-100 cursor-pointer">
          Log In
        </a>
      </div>

    </nav>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="lg:hidden hidden" role="dialog" aria-modal="true">
      <div class="fixed inset-0 z-50 bg-black/50"></div>
      <div
        class="fixed inset-y-0 left-0 z-50 w-2/3 overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="text-xl font-semibold whitespace-nowrap text-indigo-600">Purulia Doctors</span>
          </a>
          <button id="close-menu-button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Categories</a>
              <a href="#"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Doctors</a>
              <a href="#"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Clinics</a>
              <a href="#"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About</a>
            </div>
            <div class="py-6">
              <a href="home.php"
                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                In</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- navbar end -->



  <main class="w-full h-screen flex flex-col items-center justify-center bg-gray-50 sm:px-4">
    <div class="flex flex-col items-center mb-20 -mt-10">
      <ol
        class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
        <li
          class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
          <span
            class="flex items-center after:content-['-'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <svg class="w-5 h-5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            Personal <span class="hidden sm:inline-flex sm:ms-2">Info</span>
          </span>
        </li>
        <li
          class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
          <span
            class="flex items-center after:content-['-'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">2</span>
            Account <span class="hidden sm:inline-flex sm:ms-2">Info</span>
          </span>
        </li>
        <li class="flex items-center">
          <span class="me-2">3</span>
          Confirmation
        </li>
      </ol>
    </div>
    <div class="flex items-center justify-center text-center mb-14">
      <h2 class="text-2xl font-bold text-slate-600">Verify your email</h2>
    </div>
    <div class="w-full space-y-6 text-gray-600 sm:max-w-md">
      <div class="bg-white shadow p-4 py-6 sm:p-6 sm:rounded-lg">
        <div class="mt-5">
          <button
            class="w-full flex items-center justify-center gap-x-3 py-2.5 mt-5 border rounded-lg text-sm font-medium hover:bg-gray-50 duration-150 active:bg-gray-100">
            <!-- Comment: Google Icon SVG here -->
            <img
              src="https://raw.githubusercontent.com/sidiDev/remote-assets/7cd06bf1d8859c578c2efbfda2c68bd6bedc66d8/google-icon.svg"
              alt="Google" class="w-5 h-5" />
            Continue with Google
          </button>
        </div>
        <div class="inline-flex items-center justify-center w-full">
          <hr class="w-64 h-px my-8 bg-gray-200 border-0 ">
          <span
            class="absolute px-3 font-medium text-gray-600 -translate-x-1/2 bg-white left-1/2  ">or</span>
        </div>
        <form onSubmit="event.preventDefault()" class="space-y-5">
          <div>
            <label class="font-medium">Email</label>
            <input type="email" required
              class="w-full mt-2 px-3 py-2 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
          </div>
          <button
            class="w-full px-4 py-2 text-white font-medium bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-600 rounded-lg duration-150">
            Verify
          </button>
        </form>
      </div>
    </div>
  </main>


















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