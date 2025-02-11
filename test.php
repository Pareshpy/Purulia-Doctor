<?php
include 'functions.php';

$pd = new PD;

// Get the search query from the URL
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch clinics from the database
$clinics = $pd->getClinic();
$clinics = json_decode($clinics, true);

// Filter clinics based on search query
if (!empty($searchQuery)) {
    $clinics = array_filter($clinics, function ($clinic) use ($searchQuery) {
        return stripos($clinic['clinic_name'], $searchQuery) !== false || 
               stripos($clinic['clinic_address'], $searchQuery) !== false || 
               stripos($clinic['owner_name'], $searchQuery) !== false;
    });
}
?>

<body class="bg-gray-50">
    <section class="p-6 gap-4">
        <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6">
            <!-- Title & Search Box Wrapper -->
            <div class="flex justify-between items-center">
                <!-- Title -->
                <h2 class="text-xl font-semibold text-gray-800 sm:hidden md:block">
                    <?= count($clinics) ?> Clinics in Purulia
                </h2>

                <!-- Search Box -->
                <form method="GET" action="" class="relative w-full md:w-64">
                    <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 w-full rounded-lg text-sm focus:outline-none" 
                           type="search" name="search" placeholder="Search" value="<?= htmlspecialchars($searchQuery) ?>">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 56.966 56.966" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  
                s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  
                c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17
                s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <?php if (empty($clinics)) { ?>
            <p class="text-center text-gray-500">No clinics found for "<?= htmlspecialchars($searchQuery) ?>"</p>
        <?php } ?>

        <?php foreach ($clinics as $clinic) { ?>
            <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <img src="https://via.placeholder.com/50" alt="Clinic Logo" class="w-20 h-20 rounded-md">
                    <div class="flex-1 m-6">
                        <h3 class="text-xl font-bold text-gray-600 mb-3">
                            <?= htmlspecialchars($clinic['clinic_name']); ?>
                        </h3>
                        <p class="text-gray-600 text-sm mb-2">Multi-speciality Clinic • <span
                                class="text-indigo-500 ml-4"><?= htmlspecialchars($clinic['clinic_address']); ?></span>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</body>
