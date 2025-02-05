<?php
include('common/functions.php');
if (!isset($_GET['vid'])) {
    echo "<script>location.href='./'</script>";
}
$pd = new PD();
$vid = $_GET['vid'] ?? '';
$vidData = json_encode(['vid' => $vid]);
$checkVID = $pd->checkVerification($vidData);
print_r($checkVID);
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


    <title>Purulia Doctor - Verify</title>
</head>

<body class="bg-gray-1 ">
    <!-- navbar -->
    <header class=" inset-x-0 top-0  ">
        <nav class="flex items-center lg:justify-between md:justify-start p-6 lg:px-44 h-16 bg-white drop-shadow-lg"
            aria-label="Global">
            <div class="flex lg:hidden">
                <button id="menu-button"
                    class="-m-2.5 inline-flex items-center justify-start rounded-md pr-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
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

    <main class="w-full h-screen flex flex-col items-center justify-center bg-gray-50 px-4">
        <div class="w-full space-y-6 text-gray-600 max-w-md" id="otpVerify">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-600">Verify</h2>
            </div>

            <div class="bg-white shadow-md p-6 rounded-lg">
                <div class="text-center">
                    <p class="text-sm">
                        OTP has been sent to <span
                            class="font-medium text-base text-indigo-500">example@gmail.com</span>
                        <br>
                        If this is not your email address,
                        <a href="#" class="hover:underline text-blue-500">click here</a>
                    </p>
                </div>

                <form class="flex justify-center gap-x-2 mt-6" id="otp-form">
                    <input
                        class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" maxlength="1" required>
                    <input
                        class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" maxlength="1" required>
                    <input
                        class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" maxlength="1" required>
                    <input
                        class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" maxlength="1" required>
                    <input
                        class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" maxlength="1" required>
                    <input
                        class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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

        // Function to get 'vid' from the URL
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Get 'vid' from URL
        const vid = getQueryParam("vid");
        console.log("VID from URL:", vid); // Check if it's correctly retrieved


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
            // const vid = sessionStorage.getItem('vid');
            // if (!vid) {
            //     Swal.fire({
            //         icon: "error",
            //         title: "Session expired. Please sign up again.",
            //         showConfirmButton: true,
            //     });
            //     return;
            // }



            // Send OTP and vid to backend
            $.ajax({
                url: './api/verify',
                method: 'POST',
                data: { vid: vid, otp: otp },
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

</body>

</html>