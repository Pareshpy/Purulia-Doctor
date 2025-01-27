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

    <div class="w-full space-y-6 text-gray-600 sm:max-w-md sm:max-h-md" id="first">
        <p>1st</p>
        <button onclick="emailVerify()">
            Continue
        </button>
    </div>

    <div class="w-full space-y-6 text-gray-600 sm:max-w-md sm:max-h-md hidden" id="second">
        <p>2nd</p>
        <button onclick="goBack()">
            Previous
        </button>
    </div>

    <script>
        function emailVerify() {
            // Get both elements
            let firstDiv = document.querySelector('#first');
            let secondDiv = document.querySelector('#second');

            // Hide the first div and show the second div
            firstDiv.classList.add("hidden");
            secondDiv.classList.remove("hidden");
        }

        function goBack() {
            // Get both elements
            let firstDiv = document.querySelector('#first');
            let secondDiv = document.querySelector('#second');

            // Show the first div and hide the second div
            secondDiv.classList.add("hidden");
            firstDiv.classList.remove("hidden");
        }
    </script>




    <!-- ====== OTP Start -->
    <section class="bg-white py-20 ">
        <div class="container flex items-center justify-center">
            <div>
                <p class="mb-1.5 text-sm font-medium text-dark ">
                    Secure code
                </p>
                <form id="otp-form" class="flex gap-2">
                    <input type="text" maxlength="1"
                        class="shadow-xs flex w-[64px] items-center justify-center rounded-lg border border-stroke bg-white p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl " />
                    <input type="text" maxlength="1"
                        class="shadow-xs flex w-[64px] items-center justify-center rounded-lg border border-stroke bg-white p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl " />
                    <input type="text" maxlength="1"
                        class="shadow-xs flex w-[64px] items-center justify-center rounded-lg border border-stroke bg-white p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl " />
                    <input type="text" maxlength="1"
                        class="shadow-xs flex w-[64px] items-center justify-center rounded-lg border border-stroke bg-white p-2 text-center text-2xl font-medium text-gray-5 outline-none sm:text-4xl " />
                </form>
            </div>
        </div>
    </section>





     <!-- SVG Sprite Definition -->
     <svg style="display: none;">
        <symbol id="check-icon" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </symbol>
    </svg>

    <!-- List Item -->
    <li id="secondOneColor" class="flex items-center">
        <span id="secondOnePNG" class="me-2">3</span>Verify
    </li>

    <!-- Button to Trigger Replacement -->
    <button id="replaceButton">Replace Text with SVG</button>






    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("otp-form");
            const inputs = [...form.querySelectorAll("input[type=text]")];

            const handleKeyDown = (e) => {
                if (
                    !/^[0-9]{1}$/.test(e.key) &&
                    e.key !== "Backspace" &&
                    e.key !== "Delete" &&
                    e.key !== "Tab" &&
                    !e.metaKey
                ) {
                    e.preventDefault();
                }

                if (e.key === "Delete" || e.key === "Backspace") {
                    const index = inputs.indexOf(e.target);
                    if (index > 0) {
                        inputs[index - 1].value = "";
                        inputs[index - 1].focus();
                    }
                }
            };

            const handleInput = (e) => {
                const { target } = e;
                const index = inputs.indexOf(target);
                if (target.value) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                }
            };

            const handleFocus = (e) => {
                e.target.select();
            };

            const handlePaste = (e) => {
                e.preventDefault();
                const text = e.clipboardData.getData("text");
                if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                    return;
                }
                const digits = text.split("");
                inputs.forEach((input, index) => (input.value = digits[index]));
            };

            inputs.forEach((input) => {
                input.addEventListener("input", handleInput);
                input.addEventListener("keydown", handleKeyDown);
                input.addEventListener("focus", handleFocus);
                input.addEventListener("paste", handlePaste);
            });
        });



        document.getElementById('replaceButton').addEventListener('click', function() {
            const spanElement = document.getElementById('secondOnePNG');
            // Clear the existing content
            spanElement.innerHTML = '';
            // Create a new SVG element
            const svgElement = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svgElement.setAttribute('class', 'icon');
            svgElement.setAttribute('aria-hidden', 'true');
            // Create a use element to reference the symbol
            const useElement = document.createElementNS('http://www.w3.org/2000/svg', 'use');
            useElement.setAttributeNS('http://www.w3.org/1999/xlink', 'href', '#check-icon');
            // Append the use element to the svg
            svgElement.appendChild(useElement);
            // Append the svg to the span
            spanElement.appendChild(svgElement);
        });
    </script>
    <!-- ====== OTP End -->





    <div class="max-w-md mx-auto border max-w-sm mt-20 rounded">
        <form class="shadow-md px-4 py-6">
            <div class="flex justify-center gap-2 mb-6">
                <input
                    class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" autocomplete="one-time-code" required>
                <input
                    class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" autocomplete="one-time-code" required>
                <input
                    class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" autocomplete="one-time-code" required>
                <input
                    class="w-12 h-12 text-center border rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" autocomplete="one-time-code" required>
            </div>
            <div class="flex items-center justify-center">
                <button
                    class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    Verify
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-teal-500 hover:text-teal-800 ml-4"
                    href="#">
                    Resend OTP
                </a>
            </div>
        </form>
    </div>