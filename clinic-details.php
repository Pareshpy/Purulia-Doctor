<?php
include('./common/header.php');
?>

<br><br><br><br>   
<body class="bg-gray-50">
    <section class="p-6 gap-4">
        <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6">
            <!-- Title & Search Box Wrapper -->
            <div class="flex justify-between items-center">
                <!-- Title -->
                <h2 class="text-xl font-semibold text-gray-800">2,518 Clinics in Purulia</h2>

                <!-- Search Box -->
                <div class="relative">
                    <input
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                        type="search" name="search" placeholder="Search">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 56.966 56.966" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  
                        s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  
                        c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17
                        s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>


        <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6">
           <!-- Clinic Details -->
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <!-- Clinic Logo -->
                <img src="https://imgs.search.brave.com/G8wMAj1A_8r9Pfg6KtKTL1vU3SBN9EobaxKbgnF_rio/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvZW4vdGh1bWIv/Yy9jNS9BcG9sbG9f/SG9zcGl0YWxzX0xv/Z28uc3ZnLzUxMnB4/LUFwb2xsb19Ib3Nw/aXRhbHNfTG9nby5z/dmcucG5n"
                    alt="Apollo Clinic Logo" class="w-20 h-20 rounded-md">

                <!-- Clinic Info -->
                <div class="flex-1 m-6">
                    <h3 class="text-xl font-bold text-gray-600 mb-3">Apollo Clinic</h3>
                    <p class="text-gray-600 text-sm mb-2">Multi-speciality Clinic • <span
                            class="text-indigo-500 ml-4">Salt
                            Lake</span></p>
                    <p class="text-gray-600 text-sm mb-2"><span class="font-semibold">₹300 - ₹1000</span> Consultation
                        Fees
                    </p>
                    <p class="text-gray-700 font-semibold text-sm mb-2">11 Specialties • 12 doctors</p>
                    <p class="text-gray-600 text-sm mb-2"><span class="font-thin">🕒</span> MON - SUN 08:00AM - 10:30PM
                    </p>
                </div>

                <!-- Rating -->
                <div class="flex items-center space-x-2">
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-sm font-semibold">⭐ 3.5 (35
                        rated)</span>
                </div>
            </div>

            <!-- Doctors Section (Carousel) -->
            <div class="mt-6 relative">
                <div class="flex overflow-x-auto space-x-4 no-scrollbar p-2">
                    <!-- Doctor Card 1 -->
                    <div class="min-w-[220px] bg-white shadow rounded-lg p-4 border">
                        <div class="flex items-center space-x-2">
                            <img src="https://via.placeholder.com/50" alt="Dr. Gaurab Bhaduri"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800">Dr. Gaurab Bhaduri</h4>
                                <p class="text-xs text-gray-600">General Physician</p>
                                <p class="text-xs text-gray-600">14 years experience</p>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-green-600 font-semibold">👍 90% • 10 Patient Stories</p>
                    </div>

                    <!-- Doctor Card 2 -->
                    <div class="min-w-[220px] bg-white shadow rounded-lg p-4 border opacity-50">
                        <div class="flex items-center space-x-2">
                            <img src="https://via.placeholder.com/50" alt="Dr. Sanjay Ghosh"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800">Dr. Sanjay Ghosh</h4>
                                <p class="text-xs text-gray-600">General Physician</p>
                                <p class="text-xs text-gray-600">30 years experience</p>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-600 font-semibold">No reviews yet</p>
                    </div>

                    <!-- Doctor Card 3 -->
                    <div class="min-w-[220px] bg-white shadow rounded-lg p-4 border">
                        <div class="flex items-center space-x-2">
                            <img src="https://via.placeholder.com/50" alt="Dr. Subhasish Ghosh"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800">Dr. Subhasish Ghosh</h4>
                                <p class="text-xs text-gray-600">Pulmonologist</p>
                                <p class="text-xs text-gray-600">34 years experience</p>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-green-600 font-semibold">👍 92% • 39 Patient Stories</p>
                    </div>
                </div>
            </div>

            <!-- Call Button -->
            <div class="mt-6">
                <button
                    class="w-full bg-blue-500 text-white text-sm font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Call
                    Clinic</button>
            </div>
        </div>
    </section>
</body>

<?php
include('./common/about.php');
?>
