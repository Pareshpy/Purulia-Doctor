<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

  <title>Purulia Doctors</title>
</head>

<body>
  <div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
          <a href="#" class="-m-1.5 p-2">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white ml-10 ">Purulia Doctors</span>
          </a>
        </div>
        <div class="flex lg:hidden">
          <button id="menu-button"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
          <a href="#" class="text-base font-semibold leading-6 text-white">Categories</a>
          <a href="#" class="text-base font-semibold leading-6 text-white">Doctors</a>
          <a href="#" class="text-base font-semibold leading-6 text-white">Clinics</a>
          <a href="#" class="text-base font-semibold leading-6 text-white">About</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end mr-10">
          <a href="#" class="text-base font-semibold leading-6 text-white">Log in <span
              aria-hidden="true">&rarr;</span></a>
        </div>
      </nav>
      <!-- Mobile menu -->
      <div id="mobile-menu" class="lg:hidden hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-50 bg-black/50"></div>
        <div
          class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
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

  <section id="stats" class="flex flex-row w-full h-80 justify-center gap-28 bg-slate-50 ">
    <div class="w-64 h-40 rounded text-center self-center bg-white shadow-2xl">
      <i class="ri-user-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
        style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
      <div>
        <span class="text-3xl font-bold block my-2.5 mx-0">0</span>
        <p class="text-xl font-medium">Doctors</p>
      </div>
    </div>
    <div class=" w-64 h-40 rounded text-center self-center bg-white shadow-2xl">
      <i class="ri-hospital-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
        style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
      <div>
        <span class="text-3xl font-bold block my-2.5 mx-0">0</span>
        <p class="text-xl font-medium">Clinics</p>
      </div>
    </div>
    <div class="w-64 h-40 rounded text-center self-center bg-white shadow-2xl">
      <i class="ri-contrast-drop-2-line w-12 h-12 text-2xl rounded-full border-2 border-black inline-flex item-center justify-center relative z-10 p-1	"
        style="box-shadow: 0px 2px 25px rgba(0, 0, 0, 0.1); filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%); top:-22px"></i>
      <div>
        <span class="text-3xl font-bold block my-2.5 mx-0">0</span>
        <p class="text-xl font-medium">Blood Banks</p>
      </div>
    </div>
  </section>


  <section class="h-auto flex flex-col justify-center items-center">
    <div>
      <p class="flex items-center justify-center text-3xl font-bold text-slate-600 item-center mt-6">Categories</p>
      <hr class="w-24 h-px mx-auto my-4 bg-gray-100 border-0 rounded dark:bg-gray-500">
      <p class="flex items-center justify-center mb-3 text-lg text-gray-500 md:text-xl">Different types of Department we
        have for your Healthcare</p>
    </div>

    <!-- Container with flexbox for categories -->
    <div class="w-[70vw] flex flex-wrap justify-center gap-4 m-9">

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/heart.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Cardiologist</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/teeth.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Dentist</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/urology.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Urologist</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/doc-sign.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Specialist</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/orthopedic.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Orthopaedist</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/cold-fever.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">General Physician</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/skin-care.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Dermatologist</p>
      </div>

      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/stomach.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Gastroenterologist</p>
      </div>
      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/Neurologist.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Neurologist</p>
      </div>
      <div
        class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
        <img src="assets/img/pngs/Radiologist.png"
          class="w-16 h-16 inline-flex item-center justify-center relative z-10 p-1 my-5"
          style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
          alt="">
        <p class="text-lg font-medium">Radiologist</p>
      </div>

    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <script>
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
</body>

</html>