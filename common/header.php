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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tailgrids@2.2.2/plugin.min.js"></script>
<link
  href="https://cdn.jsdelivr.net/npm/tailgrids@2.2.2/assets/css/tailwind.min.css"
  rel="stylesheet"
/>
<link href="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/css/pagedone.css " rel="stylesheet"/>

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
          <a href="doctor.php"
            class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">Doctors</a>
          <a href="clinic.php"
            class="text-base font-semibold leading-6 text-slate-800 transition ease-in-out delay-150 hover:text-indigo-500 duration-200">Clinics</a>
          <a href=""
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
                <a href="#"
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