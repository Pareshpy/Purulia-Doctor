<?php
$title = "Signup";
include('common/functions.php');
$pd = new PD();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />


  <title>Purulia Doctors</title>
</head>

<body class="bg-gray-1 ">
  <!-- navbar -->
  <header class=" inset-x-0 top-0  ">
    <nav class="flex items-center lg:justify-between md:justify-start p-6 lg:px-44 h-16 bg-white drop-shadow-lg"
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
    <div class="flex flex-col items-center mb-16 -mt-36">
      <ol
        class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
        <li
          class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
          <span
            class="flex items-center after:content-['-'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <svg id="svg" class="w-5 h-5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            Valid <span class="hidden sm:inline-flex sm:ms-2">Email</span>
          </span>
        </li>
        <li id="firstOneColor"
          class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
          <span
            class="flex items-center after:content-['-'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">2</span> Account <span id="firstOnePNG" class="hidden sm:inline-flex sm:ms-2">Info</span>
          </span>
        </li>
        <li id="secondOneColor" class="flex items-center"><span id="svg" class="me-2">3</span>Verify</li>
      </ol>
    </div>

    <div class="w-full space-y-6 text-gray-600 sm:max-w-md sm:max-h-md " id="eVerify">
      <div class="flex items-center justify-center text-center mb-14">
        <h2 class="text-2xl font-bold text-slate-600">Verify your email</h2>
      </div>
      <div class="w-full space-y-6 text-gray-600 sm:max-w-md sm:max-h-md">
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
            <span class="absolute px-3 font-medium text-gray-600 -translate-x-1/2 bg-white left-1/2  ">or</span>
          </div>
          <form method="" id="checkEmail" class="space-y-5">
            <div>
              <label for="email" class="font-medium">Email</label>
              <input type="email" id="email" name="email" required autocomplete="disable"
                class="w-full mt-2 px-3 py-2 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
              <div class="py-4">
                <input type="checkbox" name="policy" id="policy"
                  class="text-indigo-500 bg-transparent outline-none border-gray-400 focus:border-indigo-200 shadow-sm rounded">
                <label for="" class="px-3 mr-7 my-3  text-gray-600 hover:text-gray-800">
                  I accept
                  <a href="#" class="underline text-gray-600 hover:text-gray-800">Privacy Policy</a>
                </label>
              </div>
              <button onclick="emailVerify(event)" id="continue" type="submit" name="checkEmail"
                class="w-full px-4 py-2 text-white font-medium bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-600 rounded-lg duration-150 my-3">
                Continue
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="w-full space-y-6 text-gray-600 sm:max-w-md sm:max-h-md hidden" id="accInfo">
      <div class="flex items-center justify-center text-center mb-14">
        <h2 class="text-2xl font-bold text-slate-600">Account Details</h2>
      </div>

      <div class="w-full space-y-6 text-gray-600 sm:max-w-md sm:max-h-md">
        <div class="bg-white shadow p-4 py-6 sm:p-6 sm:rounded-lg">
          <form class="space-y-5" id="checkFrom">
            <div>
              <div class="">
                <label for="email" class="font-medium">Email</label>
                <input type="email" id="user-email" name="email" readonly
                  class="w-full mt-2 px-3 py-2 my-3 text-gray-700 bg-transparent outline-none border-gray-200 shadow-sm rounded-lg cursor-not-allowed" />
                <label for="fName" class="font-medium">First Name</label>
                <input type="text" id="fName" name="fName" required
                  class="w-full mt-2 px-3 py-2 my-3 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
                <label for="lName" class="font-medium">Last Name</label>
                <input type="text" id="lName" name="lName" required
                  class="w-full mt-2 px-3 py-2 my-3 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
                <label for="mNumber" class="font-medium">Mobile Number</label>
                <input type="number" id="mNumber" name="mNumber" required
                  class="w-full mt-2 px-3 py-2 my-3 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
                <label for="password" class="font-medium">Password</label>

                <input type="password" id="password" name="password" required
                  class="w-full mt-2 px-3 py-2 my-3 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
                <label for="cPassword" class="font-medium">Confirm Password</label>
                <input type="password" id="cPassword" name="cPassword" required
                  class="w-full mt-2 px-3 py-2 my-3 text-gray-700 bg-transparent outline-none border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg" />
                <input type="checkbox" name="offers" id="offers"
                  class="text-indigo-500 bg-transparent outline-none border-gray-400 focus:border-indigo-200 shadow-sm rounded">
                <label for="offers" class="px-3 mr-7 my-3 text-sm text-gray-600 hover:text-gray-800">
                  Receive relevant offers and promotional communication from us.
                </label>
              </div>
              <button onclick="submitAccInfo(event)"
                class="w-full px-4 py-2 text-white font-medium bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-600 rounded-lg duration-150 my-3">
                Submit and Continue
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <div class="w-full space-y-6 text-gray-600 max-w-md hidden" id="optVerify">
      <div class="text-center">
        <h2 class="text-2xl font-bold text-slate-600">Verify</h2>
      </div>

      <div class="bg-white shadow-md p-6 rounded-lg">
        <div class="text-center">
          <p class="text-sm">
            OTP has been sent to <span class="font-medium text-base text-indigo-500">example@gmail.com</span>
            <br>
            If this is not your email address,
            <a href="#" class="hover:underline text-blue-500">click here</a>
          </p>
        </div>

        <form class="flex justify-center gap-x-2 mt-6" id="otp-form">
          <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            type="text" maxlength="1" required>
          <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            type="text" maxlength="1" required>
          <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            type="text" maxlength="1" required>
          <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            type="text" maxlength="1" required>
          <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            type="text" maxlength="1" required>
          <input class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            type="text" maxlength="1" required>
        </form>

        <div class="flex items-center justify-center mt-6 space-x-4">
          <button onclick="verify(event)"
            class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Verify
          </button>
          <a class="font-bold text-sm text-indigo-500 hover:text-indigo-600" href="#">
            Resend OTP
          </a>
        </div>
      </div>
    </div>
  </main>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.js"></script>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const continueButton = document.getElementById("continue");
      const emailInput = document.getElementById("email");
      const policyCheckbox = document.getElementById("policy");

      function validateForm() {
        const email = emailInput.value.trim();
        const isEmailValid = email !== ""; // Check if email is not empty
        const isPolicyChecked = policyCheckbox.checked;
        continueButton.disabled = !(isEmailValid && isPolicyChecked);
      }

      emailInput.addEventListener("input", validateForm);
      policyCheckbox.addEventListener("change", validateForm);
    });

    document.addEventListener("DOMContentLoaded", function () {
      const otpInputs = document.querySelectorAll("#otp-form input");

      otpInputs.forEach((input, index) => {
        input.addEventListener("input", (e) => {
          const value = e.target.value;

          // Allow only numeric input
          e.target.value = value.replace(/[^0-9]/g, "");

          if (value && index < otpInputs.length - 1) {
            otpInputs[index + 1].focus();
          }
        });

        input.addEventListener("keydown", (e) => {
          if (e.key === "Backspace" && !e.target.value && index > 0) {
            otpInputs[index - 1].focus();
          }
        });

        input.addEventListener("paste", (e) => {
          e.preventDefault();
          const pasteData = (e.clipboardData || window.clipboardData).getData("text");
          const digits = pasteData.replace(/[^0-9]/g, "").split("");

          otpInputs.forEach((input, i) => {
            if (digits[i]) {
              input.value = digits[i];
            }
          });

          otpInputs[Math.min(digits.length, otpInputs.length) - 1].focus();
        });
      });
    });


    function emailVerify(event) {
      event.preventDefault()
      let firstDiv = document.querySelector('#eVerify');
      let secondDiv = document.querySelector('#accInfo');
      let color = document.querySelector('#firstOneColor');
      let button = event.target;

      button.innerText = "Please wait...";
      button.disabled = true;

      const email = $('#email');
      console.log('here', email.val())
      const data = {
        email: email.val()
      }
      $.ajax({
        url: './api/checkEmail',
        method: 'POST',
        data: data,
        success: (res) => {
          const status = res.status;
          if (status == 'error') {
            if (res.vid) {
              // Redirect to verify2.php with vid
              window.location.href = `verify2.php?vid=${encodeURIComponent(res.vid)}`;
            } else {
              Swal.fire({
                icon: "error",
                title: res.message + ' <br><a class="text-base underline text-blue-500" href="home.php?showLogin=true">Click Here to login</a>',
                showConfirmButton: true,
              });
            }
            button.innerText = "Continue";
            button.disabled = false;
          } else {
            sessionStorage.setItem('email', res.email);
            console.log("email stored:", res.email);
            firstDiv.classList.add("hidden");
            color.classList.add("text-blue-600");
            secondDiv.classList.remove("hidden");
          }
        }, error: (err) => {
          console.error(err)
        }
      })
    }
    document.addEventListener("DOMContentLoaded", function () {
      const email = sessionStorage.getItem('email');
      console.log("loaded", email);
      if (email) {
        document.getElementById('user-email').value = email;
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



    function submitAccInfo(event) {
      event.preventDefault()
      let firstDiv = document.querySelector('#accInfo');
      let secondDiv = document.querySelector('#optVerify');
      let color = document.querySelector('#secondOneColor');
      let button = event.target;

      button.innerText = "Please wait...";
      button.disabled = true;


      const fName = $('#fName');
      const lName = $('#lName');
      const mNumber = $('#mNumber');
      const password = $('#password');
      const cPassword = $('#cPassword');
      const offers = $('#offers');
      const email = sessionStorage.getItem('email');

      console.log(email);

      console.log('here', fName.val(), lName.val(), mNumber.val(), password.val(), cPassword.val(), offers.val())
      const signUpData = {
        fName: fName.val(),
        lName: lName.val(),
        mNumber: mNumber.val(),
        password: password.val(),
        cPassword: cPassword.val(),
        offers: offers.val(),
        email: email
      }
      $.ajax({
        url: './api/signup',
        method: 'POST',
        data: signUpData,
        success: (res) => {
          const status = res.status
          if (status == 'error') {
            Swal.fire({
              icon: "error",
              title: res.message,

              showConfirmButton: true,
            });
            button.innerText = "Submit and Continue";
            button.disabled = false;
          } else {
            Swal.fire({
              icon: "success",
              title: res.message,

              showConfirmButton: true,

            });
            sessionStorage.setItem('vid', res.vid);
            console.log("VID stored:", res.vid);

            firstDiv.classList.add("hidden");
            color.classList.add("text-blue-600");
            secondDiv.classList.remove("hidden");
          }
        }, error: (err) => {
          console.error(err)
        }
      })

      // firstDiv.classList.add("hidden");
      // color.classList.add("text-blue-600");
      // secondDiv.classList.remove("hidden");
    }

    function verify(event) {
      event.preventDefault();

      const inputs = document.querySelectorAll("#otp-form input[type=text]");
      let otp = "";
      inputs.forEach(input => otp += input.value.trim());

      if (otp.length !== inputs.length) {
        Swal.fire({
          icon: "warning",
          title: "Please enter the complete OTP.",
          showConfirmButton: true,
        });
        return;
      }

      // Retrieve vid from sessionStorage
      const vid = sessionStorage.getItem('vid');
      if (!vid) {
        Swal.fire({
          icon: "error",
          title: "Session expired. Please sign up again.",
          showConfirmButton: true,
        });
        return;
      }
      let button = event.target;
      button.innerText = "Please wait...";

      // Send OTP and vid to backend
      $.ajax({
        url: './api/verify',
        method: 'POST',
        data: { vid: vid, otp: otp }, // Send both OTP and vid
        success: (res) => {
          if (res.status === 'error') {
            Swal.fire({
              icon: "error",
              title: res.message,
              showConfirmButton: true,
            });
          } else {
            Swal.fire({
              icon: "success",
              title: "OTP verified successfully!",
              text: "Redirecting to main page...",
              showConfirmButton: false, // Hide the confirm button
              timer: 4000, // 2 seconds delay
              timerProgressBar: true // Show progress bar
            }).then(() => {
              window.location.href = "home.php"; // Redirect after alert
            });

          }
        },
        error: (err) => {
          console.error("AJAX Error:", err);
        }
      });
    }
  </script>