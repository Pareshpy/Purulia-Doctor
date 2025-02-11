<?php
include 'common/connection.php';

session_start();
$user = null;

if (isset($_SESSION['user_id'])) {
  $userid = $_SESSION['user_id'];
  $get_user = "SELECT `id`, `first_name`, `middle_name`, `last_name`, `email`, `profile_image` FROM `users` WHERE `id` = ?";

  if ($stmt = $conn->prepare($get_user)) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $stmt->bind_result($id, $first_name, $middle_name, $last_name, $email, $profile_image);

    if ($stmt->fetch()) {
      $user = (object) [
        'id' => $id,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name,
        'email' => $email,
        'profile_image' => $profile_image,
        'name' => trim($first_name . ' ' . $middle_name . ' ' . $last_name)
      ];
    }

    // Close the statement
    $stmt->close();
  }
}
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

<body>

  <div class="bg-transparent">
    <!-- navbar -->
    <header class="absolute inset-x-0 top-0 z-50 ">
      <nav class="flex items-center lg:justify-between md:justify-start p-6 lg:px-44 h-24 bg-sky-50"
        aria-label="Global">
        <div class="flex lg:hidden">
          <button id="menu-button"
            class="-m-2.5 inline-flex items-center justify-start rounded-md pr-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="flex lg:flex-1">
          <a href="home.php" class="-m-1.5 p-1">
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
          <a href="clinic.php"
            class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">Clinics</a>
          <a href="#"
            class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">About</a>
        </div>
        <div class="flex flex-1 justify-end mr-5">
          <!-- Full Search Bar (Visible on lg and above) -->
          <form class="hidden lg:flex relative items-center max-w-md w-full">
            <label for="search-input" class="sr-only">Search</label>
            <!-- use ajax search -->
            <input type="search" id="search-input"
              class="hidden md:flex md:w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-sky-50 focus:ring-indigo-300 focus:border-indigo-300"
              placeholder="Search doctors, clinics..." aria-label="Search" required />
            <button type="submit"
              class="absolute right-[5px] top-1/2 transform -translate-y-1/2 bg-indigo-400 text-white hover:bg-indigo-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
              Search
            </button>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
              </svg>
            </div>
          </form>

          <!-- Search Icon (Visible on md and below) -->
          <button class="lg:hidden flex items-center text-gray-500 hover:text-blue-600 focus:outline-none"
            aria-label="Search">
            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </button>
        </div>


        <div class="lg:flex lg:justify-end mr-10" id="profile">
          <div>
            <?php if (!$user): ?>
              <a href="#" class="text-xl font-medium leading-6 text-slate-800">
                <i data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="ri-user-line"
                  id="login"></i>
              </a>
            <?php else: ?>
              <?php $user_image = $user->profile_image ? $user->profile_image : './assets/img/pic.svg'; ?>
              <img src="<?= htmlspecialchars($user_image) ?>" class="w-10 h-10 rounded-full cursor-pointer object-cover"
                onclick="profileDropDown()">
            <?php endif ?>
          </div>
        </div>
      </nav>
      <div class="p-5 min-w-56 max-w-64 absolute right-44 left-auto mt-0 border bg-sky-50 hidden" id="dropDown">
        <!-- dropdown show -->

        <div class="border-b-2 flex flex-col items-center mb-2">
          <!-- dropdown header(pic,name,email) -->

          <div>
            <!-- pic -->
            <img src="<?= htmlspecialchars($user_image) ?>" class="w-20 h-20 rounded-full object-cover mb-3">


          </div>
          <div>
            <!-- username -->
            <h3 class="text-base font-medium leading-6 text-slate-800"><?= htmlspecialchars($user->name) ?></h3>

          </div>
          <div>
            <!-- email -->

            <h3 class="text-sm font-normal leading-6 text-slate-600 mb-4"><?= htmlspecialchars($email) ?></h3>
          </div>
        </div>

        <div class="mt-3">
          <!-- options -->


          <div class="w-full py-2 pr-4">
            <!-- profile -->
            <a href=""
              class="sub-menu-link text-base font-normal leading-6 text-slate-800 ml-4 sub-menu-link transition ease-in-out delay-150 hover:text-indigo-500 duration-200">
              <i class="ri-settings-line"></i>
              <span class="ml-6">Profile</span>
            </a>

          </div>
          <div class="w-full py-2 pr-4 ">
            <!-- logout -->
            <a href="logout.php"
              class="text-base font-normal leading-6 text-slate-800 ml-4 sub-menu-link transition ease-in-out delay-150 hover:text-indigo-500 duration-200">
              <i class="ri-logout-circle-line"></i>
              <span class="ml-6 w-max">Logout</span>
            </a>
          </div>
        </div>
      </div>

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
                <a href="clinic.php"
                  class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Clinics</a>
                <a href="#"
                  class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About</a>
              </div>
              <div class="py-6">
                <a href="#"
                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                  in</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php
    include('login2.php');
    ?>
    <!-- navbar end -->
    <!-- hero section -->
    <section class="hero h-[80vh] bg-cover bg-center flex flex-col justify-center items-center relative"
      style="background-image: url('assets/img/hero-bg.jpg');">
      <!-- Background overlay for fade effect -->
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-transparent">
      </div>

      <!-- Text content -->
      <div class="text-center relative z-10 px-4">
        <h1 class="text-4xl font-bold text-white">Expert Specialist Doctors at Your Fingertips</h1>
        <p class="mt-2 text-base text-white">Book online consultations with top specialists from the comfort of your
          home.</p>
        <p class="mt-2 text-lg font-semibold text-white">Get your first appointment absolutely free!</p>
        <a href="#signup"
          class="mt-4 inline-block bg-blue-600 text-white font-semibold py-3 px-6 rounded-full hover:bg-blue-700">Sign
          In / Register</a>
      </div>
    </section>
  </div>
  <!-- hero section ends -->

  <!-- stats section -->
  <section id="stats"
    class="h-auto flex flex-col justify-center items-center w-full gap-28 bg-slate-50 overflow-x-auto">
    <div class="w-[70vw] flex flex-wrap justify-center gap-10 m-9 ">

      <div
        class=" w-64 h-40  text-center self-center bg-white max-w-xs overflow rounded-lg shadow-md  hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <i class="ri-user-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
          style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
        <div>
          <span class="text-3xl font-bold block my-2.5 mx-0 ">0</span>
          <p class="text-xl font-medium">Doctors</p>
        </div>
      </div>
      <div
        class=" w-64 h-40  text-center self-center bg-white max-w-xs overflow rounded-lg shadow-md  hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <i class="ri-hospital-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
          style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
        <div>
          <span class="text-3xl font-bold block my-2.5 mx-0 ">0</span>
          <p class="text-xl font-medium">Clinics</p>
        </div>
      </div>
      <div
        class=" w-64 h-40  text-center self-center bg-white max-w-xs overflow rounded-lg shadow-md  hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <i class="ri-contrast-drop-2-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
          style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
        <div>
          <span class="text-3xl font-bold block my-2.5 mx-0 ">0</span>
          <p class="text-xl font-medium">Blood Banks</p>
        </div>
      </div>
    </div>
  </section>
  <!-- stats section end -->

  <!-- categories section -->
  <?php
  include('./common/categories-names.php');
  ?>


  <!-- Doctor section -->
  <section class="h-auto flex flex-col justify-center items-center">
    <div>
      <p class="flex items-center justify-center text-3xl font-bold text-slate-600 item-center mt-6">Doctors</p>
      <hr class="w-24 h-px mx-auto my-4 bg-gray-100 border-0 rounded dark:bg-gray-500">
      <p class="flex items-center justify-center mb-3 text-lg text-gray-500 md:text-xl">Book appointments with verified
        doctors & minimum waiting time </p>
    </div>


    <div
      class="w-[70vw] grid lg:grid-cols-2 sm:grid-cols-1 gap-4 justify-center m-9 from-slate-50 to-gray-100 bg-gradient-to-br">
      <?php
      $query = "SELECT * FROM doctors ";
      $query_run = mysqli_query($conn, $query);
      $check_doctor = mysqli_num_rows($query_run) > 0;

      if ($check_doctor) {
        while ($row = mysqli_fetch_assoc($query_run)) {
          ?>
          <div
            class="p-4 items-center justify-center w-full rounded-xl group sm:flex space-x-6 bg-white bg-opacity-50 shadow-xl bg-gradient-to-br">
            <img
              class="mx-auto block max-h-80 xl:w-4/12 xl:h-full lg:w-1/2 lg:h-1/2 md:w-3/5 md:h-3/5 sm:w-1/6 sm:h-1/6 rounded-lg object-scale-down"
              src="<?php echo $row['photo'] ?>" alt="<?php echo $row['full_name'] ?>" loading="lazy">
            <div class="sm:w-8/12 pl-0 p-5">
              <div class="space-y-2">
                <div class="space-y-4 pb-5">
                  <h4 class="lg:text-xl md:text-lg font-bold text-cyan-900 text-justify pb-2">
                    <?php echo $row['full_name'] ?>
                  </h4>
                  <span class="md:text-sm sm:text-xs font-semibold text-gray-500"><?php echo $row['category'] ?></span>
                </div>
                <div class="">
                  <span class="md:text-sm sm:text-xs font-semibold text-gray-500 pt-2">12+ Years of experience</span>
                  <br>
                  <i class="fa fa-map-marker" aria-hidden="true" style="color:#767676;"></i>
                  <!-- <span class="lg:text-medium md:text-sm sm:text-xs font-bold text-gray-500 ">Deep medical</span> -->
                  <span
                    class="lg:text-medium md:text-sm sm:text-xs font-semibold text-gray-500"><?php echo $row['address'] ?></span>
                  <br>
                  <i class="fa fa-rupee " style="color:#164E63;"></i>
                  <span class="lg:text-lg md:text-medium sm:text-sm font-bold text-cyan-900 pt-4">500</span>
                  <span class="lg:text-medium md:text-sm sm:text-xs font-semibold text-gray-500 pt-4"> Consultation fee at
                    clinic</span>
                </div>
                <div class="py-6 min-w-10 min-h-7 object-scale-down">
                  <a href="#" style="text-decoration:none"
                    class="object-scale-down py-3 px-5 min-w-10 min-h-7 bg-indigo-500 text-white lg:text-medium md:text-xs font-semibold rounded-md shadow-lg shadow-indigo-500/50 focus:outline-none">
                    Book Clinic Visit
                  </a>
                </div>

              </div>
            </div>

          </div>
          <?php
        }
      } else {
        echo "No Doctor Found";
      }
      ?>
    </div>
    <div class="more">
      <a href="doctor.php" style="text-decoration:none"
        class="py-3 px-5 bg-indigo-500 text-white text-sm font-semibold rounded-md shadow-lg shadow-indigo-500/50 focus:outline-none">
        More
      </a>
    </div>
  </section>
  <!-- Doctor section end -->

  <!-- Article section -->
  <section class="h-auto flex flex-col justify-center items-center">
    <div class="w-[70vw] gap-4 justify-center m-9 ">
      <div class="mt-6 item-center text-gray-500 ">
        <hr class="border-gray-300 ">
      </div>
      <div class="mt-10">
        <h2 class="text-center text-2xl font-semibold text-gray-800">Read top articles from health experts</h2>
        <?php
        include('./common/blogPost.php');
        ?>
      </div>
      <div class="mt-6 item-center text-gray-500 ">
        <hr class="border-gray-300 ">
      </div>
    </div>
  </section>
  <!-- Article section ends -->





  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <!-- scroll example -->
  <div class=" hidden flex-col bg-white m-auto p-auto">
    <h1 class="flex py-5 lg:px-20 md:px-10 px-5 lg:mx-40 md:mx-20 mx-5 font-bold text-4xl text-gray-800">
      Example
    </h1>
    <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
      <div class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 ">
        <div class="inline-block px-3 pt-10">

          <div
            class=" w-64 h-40  text-center self-center bg-white max-w-xs overflow rounded-lg shadow-md  hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <i class="ri-user-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
              style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
            <div>
              <span class="text-3xl font-bold block my-2.5 mx-0 ">0</span>
              <p class="text-xl font-medium">Doctors</p>
            </div>

          </div>
        </div>
        <div class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 ">
          <div class="inline-block px-3 pt-10">

            <div
              class=" w-64 h-40  text-center self-center bg-white max-w-xs overflow rounded-lg shadow-md  hover:shadow-xl transition-shadow duration-300 ease-in-out">
              <i class="ri-user-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
                style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
              <div>
                <span class="text-3xl font-bold block my-2.5 mx-0 ">0</span>
                <p class="text-xl font-medium">Doctors</p>
              </div>

            </div>
          </div>
          <div class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 ">
            <div class="inline-block px-3 pt-10">

              <div
                class=" w-64 h-40  text-center self-center bg-white max-w-xs overflow rounded-lg shadow-md  hover:shadow-xl transition-shadow duration-300 ease-in-out">
                <i class="ri-user-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
                  style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
                <div>
                  <span class="text-3xl font-bold block my-2.5 mx-0 ">0</span>
                  <p class="text-xl font-medium">Doctors</p>
                </div>

              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">


              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
              </div>
            </div>
            <div class="inline-block px-3">
              <div
                class="w-64 h-64 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
      .hide-scroll-bar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }

      .hide-scroll-bar::-webkit-scrollbar {
        display: none;
      }
    </style>
  </div>

  <div class="bg-cover bg-center flex items-center justify-center min-h-screen min-w-full overflow-hidden"
    style=" background-repeat: no-repeat; background-size: cover;">

    <div class="backdrop-blur-sm bg-white/30 p-8 min-h-screen min-w-full flex items-center justify-center">
      <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
          <div class="p-8 rounded-2xl bg-white shadow">
            <h2 class="text-gray-800 text-center text-2xl font-bold">Sign in</h2>
            <form class="mt-8 space-y-4">
              <div>
                <label class="text-gray-800 text-sm mb-2 block">User name</label>
                <div class="relative flex items-center">
                  <input name="username" type="text" required
                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                    placeholder="Enter user name" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4"
                    viewBox="0 0 24 24">
                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                    <path
                      d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                      data-original="#000000"></path>
                  </svg>
                </div>
              </div>

              <div>
                <label class="text-gray-800 text-sm mb-2 block">Password</label>
                <div class="relative flex items-center">
                  <input name="password" type="password" required
                    class="block w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                    placeholder="Enter password" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                    class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                    <path
                      d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                      data-original="#000000"></path>
                  </svg>
                </div>
              </div>

              <div class="flex flex-wrap items-center justify-between gap-4 select-none">
                <div class="flex items-center select-none">
                  <input id="remember-me" name="remember-me" type="checkbox"
                    class="h-4 w-4 shrink-0 text-blue-600 border-gray-300 rounded select-none" />
                  <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                    Remember me
                  </label>
                </div>
                <div class="text-sm">
                  <a href="javascript:void(0);" class="text-blue-600 hover:underline font-semibold">
                    Forgot your password?
                  </a>
                </div>
              </div>

              <div class="!mt-8">
                <button type="button"
                  class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  Sign in
                </button>
              </div>
              <p class="text-gray-800 text-sm !mt-8 text-center">Don't have an account? <a href="javascript:void(0);"
                  class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register
                  here</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- <div class="h-screen dark:bg-gray-900">
  <div class="pt-12 bg-gray-50 dark:bg-gray-900 sm:pt-20">
    <div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-extrabold leading-9 text-gray-900 dark:text-white sm:text-4xl sm:leading-10">
          Trusted by developers
        </h2>
        <p class="mt-3 text-xl leading-7 text-gray-600 dark:text-gray-400 sm:mt-4">
          This package powers many production applications on many different hosting platforms.
        </p>
      </div>
    </div>
    <div class="pb-12 mt-10 bg-gray-50 dark:bg-gray-900 sm:pb-16">
      <div class="relative">
        <div class="absolute inset-0 h-1/2 bg-gray-50 dark:bg-gray-900"></div>
        <div class="relative max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
          <div class="max-w-4xl mx-auto">
            <dl class="bg-white dark:bg-gray-800 rounded-lg shadow-lg sm:grid sm:grid-cols-3">
              <div
                class="flex flex-col p-6 text-center border-b border-gray-100 dark:border-gray-700 sm:border-0 sm:border-r">
                <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 dark:text-gray-400" id="item-1">
                  Stars on GitHub
                </dt>
                <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 dark:text-indigo-100"
                  aria-describedby="item-1" id="starsCount">
                  0
                </dd>
              </div>
              <div
                class="flex flex-col p-6 text-center border-t border-b border-gray-100 dark:border-gray-700 sm:border-0 sm:border-l sm:border-r">
                <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 dark:text-gray-400">
                  Downloads
                </dt>
                <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 dark:text-indigo-100"
                  id="downloadsCount">
                  0
                </dd>
              </div>
              <div
                class="flex flex-col p-6 text-center border-t border-gray-100 dark:border-gray-700 sm:border-0 sm:border-l">
                <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 dark:text-gray-400">
                  Sponsors
                </dt>
                <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 dark:text-indigo-100"
                  id="sponsorsCount">
                  0
                </dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const targets = [
    { element: document.getElementById('starsCount'), count: 4670, suffix: '+' },
    { element: document.getElementById('downloadsCount'), count: 80000, suffix: '+' },
    { element: document.getElementById('sponsorsCount'), count: 100, suffix: '+' }
  ];

  // Find the maximum count among all targets
  const maxCount = Math.max(...targets.map(target => target.count));

  // Function to animate count-up effect
  function animateCountUp(target, duration) {
    let currentCount = 0;
    const increment = Math.ceil(target.count / (duration / 10));

    const interval = setInterval(() => {
      currentCount += increment;
      if (currentCount >= target.count) {
        clearInterval(interval);
        currentCount = target.count;
        target.element.textContent = currentCount + target.suffix;
      } else {
        target.element.textContent = currentCount;
      }
    }, 10);
  }

  // Animate count-up for each target with adjusted duration
  targets.forEach(target => {
    animateCountUp(target, maxCount / 100); // Adjust duration based on max count
  });
</script> -->


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Get URL parameters
      const urlParams = new URLSearchParams(window.location.search);

      // Check if showLogin=true exists
      if (urlParams.has('showLogin')) {
        let loginButton = document.querySelector("#login");

        if (loginButton) {
          loginButton.click(); // Open the modal
        }
      }
    });
    // Define the profileDropDown function globally
    function profileDropDown() {
      let dropDown = document.querySelector('#dropDown');
      dropDown.classList.toggle("hidden");
    }

    function login() {
      let login = document.querySelector()
    }

    // Wait for the DOM to be fully loaded before attaching event listeners
    document.addEventListener("DOMContentLoaded", function () {
      const mobileMenuButton = document.getElementById("menu-button");
      const mobileMenu = document.getElementById("mobile-menu");
      const closeMenuButton = document.getElementById("close-menu-button");

      // Function to open the mobile menu
      mobileMenuButton.addEventListener("click", function () {
        mobileMenu.classList.remove("hidden");
        mobileMenu.classList.add("flex");
      });

      // Function to close the mobile menu
      closeMenuButton.addEventListener("click", function () {
        mobileMenu.classList.remove("flex");
        mobileMenu.classList.add("hidden");
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>