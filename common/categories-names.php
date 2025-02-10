<?php
include 'functions.php';

$pd = new PD;
$categories = $pd->getCategory();
$categories = json_decode($categories, true);

// if ($categories === null) {
//     echo "Failed to decode JSON.";
// } else {
//     echo "<div>";
//     foreach ($categories as $category) {
//         echo "<p>ID: " . htmlspecialchars($category['id']) . "</p>";
//         echo "<p>Name: " . htmlspecialchars($category['name']) . "</p>";
//         echo "<p>Status: " . htmlspecialchars($category['status']) . "</p>";
//         echo "<p>img location: " . htmlspecialchars($category['images']) . "</p>";
//         echo '<img src="../' . htmlspecialchars($category['images']) . '" alt="' . htmlspecialchars($category['images']) . '">';
//         echo "<hr>";
//     }
//     echo "</div>";
// }
?>

<section class="h-auto flex flex-col justify-center items-center">
    <div>
        <p class="flex items-center justify-center text-3xl font-bold text-slate-600 mt-6">Categories</p>
        <hr class="w-24 h-px mx-auto my-4 bg-gray-100 border-0 rounded dark:bg-gray-500">
        <p class="flex items-center justify-center mb-3 text-lg text-gray-500 md:text-xl">
            Different types of departments we have for your healthcare
        </p>
    </div>

    <div class="w-[70vw] flex flex-wrap justify-center gap-4 m-9">
        <?php foreach ($categories as $category) { ?>
            <a href="categories.php?<?php echo htmlspecialchars($category['name']);?>">
                <div
                    class="w-52 h-40 rounded-lg text-center drop-shadow-xl shadow-lg transition ease-in-out hover:scale-110 duration-300 mx-3 my-2">
                    <img src="<?php echo htmlspecialchars($category['images']); ?>"
                        class="w-16 h-16 inline-flex items-center justify-center relative z-10 p-1 my-5"
                        style="filter: invert(20%) sepia(98%) saturate(1951%) hue-rotate(198deg) brightness(96%) contrast(103%);"
                        alt="Category Image">
                    <p class="text-lg font-medium"><?php echo htmlspecialchars($category['name']); ?></p>
                </div>
            </a>
        <?php } ?>
    </div>
</section>