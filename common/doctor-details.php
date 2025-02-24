<?php
include 'functions.php';

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $api_url = "http://localhost/PD-Project/Purulia-Doctor/api/getDoctorByID";

    // Use cURL for the request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["id" => $doctor_id]));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200 && $response) {
        $result = json_decode($response, true);

        if ($result['status'] === 'success') {
            $doctor = $result['data'];

            // echo "<h2>Doctor Details</h2>";
            // echo "<p>ID: " . htmlspecialchars($doctor['id']) . "</p>";
            // echo "<p>doctor name: " . htmlspecialchars($doctor['full_name']) . "</p>";
            // echo "<p>short email: " . htmlspecialchars($doctor['short_name']) . "</p>";
            // echo "<p>doctor phone: " . htmlspecialchars($doctor['phone']) . "</p>";
            // echo "<p>doctor email: " . htmlspecialchars($doctor['email']) . "</p>";
            // echo "<p>registration no: " . htmlspecialchars($doctor['reg_no']) . "</p>";
            // echo "<p>degrees: " . htmlspecialchars($doctor['degrees']) . "</p>";
            // echo "<p>category: " . htmlspecialchars($doctor['category']) . "</p>";
            // echo "<p>specialty: " . htmlspecialchars($doctor['specialty']) . "</p>";
            // echo "<p>exp in years: " . htmlspecialchars($doctor['exp']) . "</p>";
            // echo "<p>address: " . htmlspecialchars($doctor['address']) . "</p>";
            // echo "<p>verified: " . htmlspecialchars($doctor['verified']) . "</p>";
            // echo "<p>status: " . htmlspecialchars($doctor['status']) . "</p>";
            // echo "<p>document: " . htmlspecialchars($doctor['document']) . "</p>";
            // echo "<p>fees: " . htmlspecialchars($doctor['fees']) . "</p>";
            // echo '<img src="../' . htmlspecialchars($doctor['photo']) . '" alt="' . htmlspecialchars($doctor['photo']) . '">';
        } else {
            echo "<p>" . htmlspecialchars($result['message']) . "</p>";
        }
    } else {
        echo "<p>Failed to connect to API. HTTP Status: $http_code</p>";
    }
} else {
    echo "No doctor ID found in URL.";
}
?>
<br>
<div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6 allClinics">
    <div class="flex flex-col md:flex-row items-center gap-3">
        <div class="w-full md:w-1/5 flex justify-center">
            <img src="./uploads/dr.jaydeepmandal.jpg" alt="Doctor Image"
                class="max-h-80 w-40 sm:w-9 md:w-16 lg:w-52 xl:w-34 object-cover rounded-lg">
        </div>
        <div class="flex-1">
            <h3 class="lg:text-2xl md:text-xl font-bold text-gray-700 mb-2 text-left md:text-center lg:text-left">
            <?php echo htmlspecialchars($doctor['full_name']); ?>
            </h3>
            <p class="text-gray-600 text-medium ">
                <span class="text-sm"><?php echo htmlspecialchars($doctor['category']); ?></span>
            </p>
            <p class="text-gray-600 text-medium ">
                <span class="text-sm"><?php echo htmlspecialchars($doctor['exp']); ?> Years Experience
                    Overall</span>
            </p>
            <span
                class="bg-green-100 text-green-600 text-sm font-semibold max-w-36 text-center py-2 rounded-lg transition block">
                ⭐ 3.5 (35 rated)
            </span>
            <p class="text-gray-600 w-max text-sm mb-2">
                <span class="text-indigo-500 font-semibold"></span>
            </p>
            <p class="text-gray-600 text-medium ">
                <span class="text-sm"><?php echo htmlspecialchars($doctor['full_name']); ?> is a <?php echo htmlspecialchars($doctor['category']); ?>
                 <br> with <?php echo htmlspecialchars($doctor['exp']); ?> yrs experience in Clinical practice both in India and abroad</span>
            </p>
        </div>
        <div class="flex flex-col gap-6">
            <span class="font-semibold">₹<?php echo htmlspecialchars($doctor['fees']); ?></span>
            <span class="text-sm font-light">
                <i class="ri-bank-card-line text-green-600"></i>
                online payment available
            </span>
            <button
                class="bg-blue-500 text-white text-sm font-semibold w-48 py-2 rounded-lg hover:bg-blue-600 transition">
                Book clinic visit
            </button>
        </div>
    </div>
</div>
<div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6 allClinics">
    <div class="flex flex-row justify-evenly items-center ">
        <button class="text-lg font-semibold text-gray-600 py-4 hover:text-blue-500 " id="first" onclick="visit(event)">Visiting Hours</button>
        <button class="text-lg font-semibold text-gray-600 py-4 hover:text-blue-500" id="second" onclick="story(event)">Stories</button>
        <button class="text-lg font-semibold text-gray-600 py-4 hover:text-blue-500" id="third" onclick="overview(event)">Overview</button>
    </div>
    <div class="mt-4">
        <hr class="w-full text-gray-600 py-3 font-light">
    </div>
    <div class="flex flex-col md:flex-row justify-between md:mx-5 my-5 animate" id="visitingHours">
        <div class="flex flex-col">
            <div class="text-gray-600 text-sm mb-4">
                <span class="font-semibold"><?php echo htmlspecialchars($doctor['address']); ?></span>
            </div>
            <div class="flex flex-col gap-1">
                <a href="#" class="text-indigo-500 font-bold">Deep Medical</a>
                <p class="text-sm font-light">Lorem, ipsum dolor sit amet consectetur <br> adipisicing elit. Modi
                    dicta ullam </p>
                <span class="text-indigo-500 font-semibold">Get Direction</span>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <p class="mb-4 font-semibold">Mon - Sat</p>
            <p>10:00 AM - 01:00 PM</p>
            <p>02:00 PM - 05:00 PM</p>
        </div>
        
        <!-- Date Picker Start -->
        <section class="bg-white py-6 ">
            <div class="container">
                <div class="mx-auto w-full max-w-[510px]">
                    <div class="relative mb-3">
                        <input id="datepicker" type="text" placeholder="Pick a date"
                            class="h-12 w-full appearance-none rounded-lg border border-stroke bg-white pl-12 pr-4 text-dark outline-none focus:border-primary "
                            readonly />
                        <span id="toggleDatepicker"
                            class="absolute inset-y-0 flex h-12 w-12 items-center justify-center text-dark-5">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 3.3125H16.3125V2.625C16.3125 2.25 16 1.90625 15.5937 1.90625C15.1875 1.90625 14.875 2.21875 14.875 2.625V3.28125H6.09375V2.625C6.09375 2.25 5.78125 1.90625 5.375 1.90625C4.96875 1.90625 4.65625 2.21875 4.65625 2.625V3.28125H3C1.9375 3.28125 1.03125 4.15625 1.03125 5.25V16.125C1.03125 17.1875 1.90625 18.0938 3 18.0938H18C19.0625 18.0938 19.9687 17.2187 19.9687 16.125V5.25C19.9687 4.1875 19.0625 3.3125 18 3.3125ZM3 4.71875H4.6875V5.34375C4.6875 5.71875 5 6.0625 5.40625 6.0625C5.8125 6.0625 6.125 5.75 6.125 5.34375V4.71875H14.9687V5.34375C14.9687 5.71875 15.2812 6.0625 15.6875 6.0625C16.0937 6.0625 16.4062 5.75 16.4062 5.34375V4.71875H18C18.3125 4.71875 18.5625 4.96875 18.5625 5.28125V7.34375H2.46875V5.28125C2.46875 4.9375 2.6875 4.71875 3 4.71875ZM18 16.6562H3C2.6875 16.6562 2.4375 16.4062 2.4375 16.0937V8.71875H18.5312V16.125C18.5625 16.4375 18.3125 16.6562 18 16.6562Z"
                                    fill="currentColor" />
                                <path
                                    d="M9.5 9.59375H8.8125C8.625 9.59375 8.5 9.71875 8.5 9.90625V10.5938C8.5 10.7812 8.625 10.9062 8.8125 10.9062H9.5C9.6875 10.9062 9.8125 10.7812 9.8125 10.5938V9.90625C9.8125 9.71875 9.65625 9.59375 9.5 9.59375Z"
                                    fill="currentColor" />
                                <path
                                    d="M12.3438 9.59375H11.6562C11.4687 9.59375 11.3438 9.71875 11.3438 9.90625V10.5938C11.3438 10.7812 11.4687 10.9062 11.6562 10.9062H12.3438C12.5312 10.9062 12.6562 10.7812 12.6562 10.5938V9.90625C12.6562 9.71875 12.5312 9.59375 12.3438 9.59375Z"
                                    fill="currentColor" />
                                <path
                                    d="M15.1875 9.59375H14.5C14.3125 9.59375 14.1875 9.71875 14.1875 9.90625V10.5938C14.1875 10.7812 14.3125 10.9062 14.5 10.9062H15.1875C15.375 10.9062 15.5 10.7812 15.5 10.5938V9.90625C15.5 9.71875 15.375 9.59375 15.1875 9.59375Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.5 12H5.8125C5.625 12 5.5 12.125 5.5 12.3125V13C5.5 13.1875 5.625 13.3125 5.8125 13.3125H6.5C6.6875 13.3125 6.8125 13.1875 6.8125 13V12.3125C6.8125 12.125 6.65625 12 6.5 12Z"
                                    fill="currentColor" />
                                <path
                                    d="M9.5 12H8.8125C8.625 12 8.5 12.125 8.5 12.3125V13C8.5 13.1875 8.625 13.3125 8.8125 13.3125H9.5C9.6875 13.3125 9.8125 13.1875 9.8125 13V12.3125C9.8125 12.125 9.65625 12 9.5 12Z"
                                    fill="currentColor" />
                                <path
                                    d="M12.3438 12H11.6562C11.4687 12 11.3438 12.125 11.3438 12.3125V13C11.3438 13.1875 11.4687 13.3125 11.6562 13.3125H12.3438C12.5312 13.3125 12.6562 13.1875 12.6562 13V12.3125C12.6562 12.125 12.5312 12 12.3438 12Z"
                                    fill="currentColor" />
                                <path
                                    d="M15.1875 12H14.5C14.3125 12 14.1875 12.125 14.1875 12.3125V13C14.1875 13.1875 14.3125 13.3125 14.5 13.3125H15.1875C15.375 13.3125 15.5 13.1875 15.5 13V12.3125C15.5 12.125 15.375 12 15.1875 12Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.5 14.4062H5.8125C5.625 14.4062 5.5 14.5312 5.5 14.7187V15.4062C5.5 15.5938 5.625 15.7188 5.8125 15.7188H6.5C6.6875 15.7188 6.8125 15.5938 6.8125 15.4062V14.7187C6.8125 14.5312 6.65625 14.4062 6.5 14.4062Z"
                                    fill="currentColor" />
                                <path
                                    d="M9.5 14.4062H8.8125C8.625 14.4062 8.5 14.5312 8.5 14.7187V15.4062C8.5 15.5938 8.625 15.7188 8.8125 15.7188H9.5C9.6875 15.7188 9.8125 15.5938 9.8125 15.4062V14.7187C9.8125 14.5312 9.65625 14.4062 9.5 14.4062Z"
                                    fill="currentColor" />
                                <path
                                    d="M12.3438 14.4062H11.6562C11.4687 14.4062 11.3438 14.5312 11.3438 14.7187V15.4062C11.3438 15.5938 11.4687 15.7188 11.6562 15.7188H12.3438C12.5312 15.7188 12.6562 15.5938 12.6562 15.4062V14.7187C12.6562 14.5312 12.5312 14.4062 12.3438 14.4062Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                    <div id="datepicker-container"
                        class="w-full flex-col rounded-xl bg-white p-4 shadow-four sm:p-[30px] hidden">
                        <div class="flex items-center justify-between pb-4">
                            <div id="prevMonth"
                                class="flex h-[38px] w-[38px] cursor-pointer items-center justify-center rounded-[7px] border-[.5px] border-stroke bg-gray-2 text-dark hover:border-primary hover:bg-primary hover:text-white sm:h-[46px] sm:w-[46px] ">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                    <path
                                        d="M16.2375 21.4875C16.0125 21.4875 15.7875 21.4125 15.6375 21.225L7.16249 12.6C6.82499 12.2625 6.82499 11.7375 7.16249 11.4L15.6375 2.77498C15.975 2.43748 16.5 2.43748 16.8375 2.77498C17.175 3.11248 17.175 3.63748 16.8375 3.97498L8.96249 12L16.875 20.025C17.2125 20.3625 17.2125 20.8875 16.875 21.225C16.65 21.375 16.4625 21.4875 16.2375 21.4875Z" />
                                </svg>
                            </div>
                            <span id="currentMonth" class="text-xl font-medium capitalize text-dark ">

                            </span>
                            <div id="nextMonth"
                                class="flex h-[38px] w-[38px] cursor-pointer items-center justify-center rounded-[7px] border-[.5px] border-stroke bg-gray-2 text-dark hover:border-primary hover:bg-primary hover:text-white sm:h-[46px] sm:w-[46px] ">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="fill-current">
                                    <path
                                        d="M7.7625 21.4875C7.5375 21.4875 7.35 21.4125 7.1625 21.2625C6.825 20.925 6.825 20.4 7.1625 20.0625L15.0375 12L7.1625 3.97498C6.825 3.63748 6.825 3.11248 7.1625 2.77498C7.5 2.43748 8.025 2.43748 8.3625 2.77498L16.8375 11.4C17.175 11.7375 17.175 12.2625 16.8375 12.6L8.3625 21.225C8.2125 21.375 7.9875 21.4875 7.7625 21.4875Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-7 justify-between pb-2 pt-4 text-sm font-medium capitalize text-body-color sm:text-lg ">
                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                Mo
                            </span>

                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                Tu
                            </span>

                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                We
                            </span>

                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                Th
                            </span>

                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                Fr
                            </span>

                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                Sa
                            </span>

                            <span class="flex h-[38px] w-[38px] items-center justify-center sm:h-[46px] sm:w-[47px]">
                                Su
                            </span>
                        </div>

                        <div id="days-container"
                            class="grid grid-cols-7 justify-between text-sm font-medium sm:text-lg"></div>

                        <div class="flex items-center space-x-3 pt-4 sm:space-x-5">
                            <button id="cancelButton"
                                class="flex h-[50px] w-full items-center justify-center rounded-md bg-dark text-base font-medium text-white hover:bg-opacity-90">
                                Remove
                            </button>
                            <button id="applyButton"
                                class="flex h-[50px] w-full items-center justify-center rounded-md bg-primary text-base font-medium text-white hover:bg-blue-dark">
                                Done
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Date Picker End -->


    </div>
    <div class=" flex-col md:flex-row justify-center md:mx-5 my-5 hidden animate-fadeInLeft" id="stories">
        <p class="text-center">Stories Unavailable</p>
    </div>

    <div class=" flex-col md:flex-row justify-center md:mx-5 my-5 hidden animate-fade-left animate-once animate-ease-in-out" id="overview">
        <p class="text-center">Doctor overview Unavailable</p>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>
<script>
    function visit(event) {
        event.preventDefault()
        let firstDiv = document.querySelector('#visitingHours');
        let secondDiv = document.querySelector('#stories');         //select divs
        let thirdDiv = document.querySelector('#overview');

        let firstBtnColor = document.querySelector('#first');
        let secondBtnColor = document.querySelector('#second');         // select btns
        let thirdBtnColor = document.querySelector('#third');

        firstDiv.classList.remove("hidden");
        secondDiv.classList.add("hidden");          //hidden divs
        thirdDiv.classList.add("hidden");
        
        firstBtnColor.classList.add("text-blue-500")
        secondBtnColor.classList.remove("text-blue-500")        //color btns
        thirdBtnColor.classList.remove("text-blue-500")
    }

    function story(event) {
        event.preventDefault()
        let firstDiv = document.querySelector('#visitingHours');
        let secondDiv = document.querySelector('#stories');         //select divs
        let thirdDiv = document.querySelector('#overview');

        let firstBtnColor = document.querySelector('#first');
        let secondBtnColor = document.querySelector('#second');         // select btns
        let thirdBtnColor = document.querySelector('#third');

        firstDiv.classList.add("hidden");
        secondDiv.classList.remove("hidden");       //hidden divs
        thirdDiv.classList.add("hidden");

        firstBtnColor.classList.remove("text-blue-500")
        secondBtnColor.classList.add("text-blue-500")       //color btns
        thirdBtnColor.classList.remove("text-blue-500")
    }

    function overview(event) {
        event.preventDefault()
        let firstDiv = document.querySelector('#visitingHours');
        let secondDiv = document.querySelector('#stories');         //select divs
        let thirdDiv = document.querySelector('#overview');

        let firstBtnColor = document.querySelector('#first');
        let secondBtnColor = document.querySelector('#second');         // select btns
        let thirdBtnColor = document.querySelector('#third');

        firstDiv.classList.add("hidden");
        secondDiv.classList.add("hidden");          //hidden divs
        thirdDiv.classList.remove("hidden");

        firstBtnColor.classList.remove("text-blue-500")
        secondBtnColor.classList.remove("text-blue-500")            //color btns
        thirdBtnColor.classList.add("text-blue-500")
    }
</script>
<script>
    const datepicker = document.getElementById('datepicker');
    const datepickerContainer = document.getElementById('datepicker-container');
    const daysContainer = document.getElementById('days-container');
    const currentMonthElement = document.getElementById('currentMonth');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');
    const cancelButton = document.getElementById('cancelButton');
    const applyButton = document.getElementById('applyButton');
    const toggleDatepicker = document.getElementById('toggleDatepicker');

    let currentDate = new Date();
    let selectedDate = null;

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        currentMonthElement.textContent = currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

        daysContainer.innerHTML = '';
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDayOfMonth; i++) {
            daysContainer.innerHTML += `<div></div>`;
        }

        for (let i = 1; i <= daysInMonth; i++) {
            daysContainer.innerHTML += `<div class="flex h-[38px] w-[38px] items-center justify-center rounded-[7px] border-[.5px] border-transparent text-dark hover:border-stroke hover:bg-gray-2 sm:h-[46px] sm:w-[47px] mb-2">${i}</div>`;
        }

        document.querySelectorAll('#days-container div').forEach(day => {
            day.addEventListener('click', function () {
                selectedDate = `${month + 1}/${this.textContent}/${year}`;
                document.querySelectorAll('#days-container div').forEach(d => d.classList.remove('bg-primary', 'text-white', 'dark:text-white'));
                this.classList.add('bg-primary', 'text-white', 'dark:text-white');
            });
        });
    }

    datepicker.addEventListener('click', function () {
        datepickerContainer.classList.toggle('hidden');
        renderCalendar();
    });

    toggleDatepicker.addEventListener('click', function () {
        datepickerContainer.classList.toggle('hidden');
        renderCalendar();
    });

    prevMonthButton.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthButton.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    cancelButton.addEventListener('click', function () {
        selectedDate = null;
        datepickerContainer.classList.add('hidden');
    });

    applyButton.addEventListener('click', function () {
        if (selectedDate) {
            datepicker.value = selectedDate;
        }
        datepickerContainer.classList.add('hidden');
    });

    // Close datepicker when clicking outside
    document.addEventListener('click', function (event) {
        if (!datepicker.contains(event.target) && !datepickerContainer.contains(event.target)) {
            datepickerContainer.classList.add('hidden');
        }
    });
</script>