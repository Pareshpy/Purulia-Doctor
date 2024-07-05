<?php
session_start();
include ("./includes/config.php");
if (isset($_SESSION['username'])) {
  header("location: ./dashboard.php");
}
$error = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Purulia Doctors - Login</title>
  <!-- core:css -->
  <link rel="stylesheet" href="<?= base_url ?>/assets/vendors/core/core.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url ?>/assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="<?= base_url ?>/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= base_url ?>/assets/css/demo_5/style.css">
  <!-- End layout styles -->
  <!-- <link rel="shortcut icon" href="<?= base_url ?>/assets/images/favicon.png" /> -->
</head>

<body>
  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-6 col-xl-4 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-6 pr-md-0 d-flex align-items-center justify-content-center">
                  <div class="auth_logo">
                    <!-- <img src="./assets/images/auth_logo.jpg" class="auth_img"> -->
                  </div>
                </div>
                <div class="col-md-6 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">Purulia&nbsp;<span>Doctors</span></a>
                    <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                    <form class="forms-sample" method="post">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" autocomplete="current-password"
                          placeholder="Password" name="password">
                      </div>
                      <!-- <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          Remember me
                        </label>
                      </div> -->
                      <div class="mt-3">
                        <input type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white w-100" value="Login"
                          name="login">
                        <!-- <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                          <i class="btn-icon-prepend" data-feather="twitter"></i>
                          Login with twitter
                        </button> -->
                      </div>
                      <?php
                      if ($error):
                        ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                      <?php endif ?>
                      <!-- <a href="register.html" class="d-block mt-3 text-muted">Not a user? Sign up</a> -->
                    </form>
                    <?php

                    if (isset($_POST['login'])) {
                      $username = $conn->real_escape_string($_POST['username']);
                      $password = $conn->real_escape_string($_POST['password']);

                      $stmt = "SELECT * FROM `admin` WHERE `username` = '$username'";
                      $run = $conn->query($stmt);

                      if ($run->num_rows > 0) {
                        $data = $run->fetch_object();
                        if (password_verify($password, $data->password)) {
                          $_SESSION['username'] = $username;
                          header("location: ./dashboard.php");
                        } else {
                          echo "<br/><p style='color:crimson'>Incorrect Password!</p>";
                        }
                      } else {
                        echo "<br/><p style='color:crimson'>Incorrect Username!</p>";

                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- core:js -->
  <script src="<?= base_url ?>/assets/vendors/core/core.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- end plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url ?>/assets/vendors/feather-icons/feather.min.js"></script>
  <script src="<?= base_url ?>/assets/js/template.js"></script>
  <!-- endinject -->
  <!-- custom js for this page -->
  <!-- end custom js for this page -->
</body>

</html>