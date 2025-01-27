<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <main class="w-full h-screen flex flex-col items-center justify-center bg-gray-50 sm:px-4">
    <div class="w-full max-w-md bg-white shadow p-6 rounded-lg space-y-6 text-gray-600">
      <h2 class="text-xl font-bold text-center text-gray-700">Verify Your Email</h2>
      <form onSubmit="event.preventDefault()" class="space-y-5">
        <!-- Email Field -->
        <div class="relative">
          <label class="font-medium">Email</label>
          <input type="email" id="email-input" required
            class="w-full mt-2 px-3 py-2 text-gray-700 bg-transparent outline-none border border-gray-200 focus:border-indigo-200 shadow-sm rounded-lg pr-10" />
          <i id="check-icon"
            class="hidden fa-solid fa-check-circle absolute top-1/2 right-3 transform -translate-y-1/2 text-green-500"></i>
          <i id="cross-icon"
            class="hidden fa-solid fa-circle-xmark absolute top-1/2 right-3 transform -translate-y-1/2 text-red-500"></i>
        </div>

        <!-- Buttons -->
        <button type="button" id="verify-button"
          class="w-full px-4 py-2 text-white font-medium bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-600 rounded-lg duration-150">
          Verify
        </button>
        <button onclick="window.location.href='home.php'" id="home-button"
          class="hidden w-full px-4 py-2 text-white font-medium bg-green-500 hover:bg-green-600 active:bg-green-700 rounded-lg duration-150">
          Go to Home
        </button>
      </form>
    </div>
  </main>

  <script>
    // Function to simulate email existence check
    function checkEmailExistence(email) {
      // Simulated database (replace with actual API call if needed)
      const existingEmails = ["test@example.com", "user@example.com", "admin@example.com"];
      return existingEmails.includes(email);
    }

    // Event listener for verify button
    document.getElementById("verify-button").addEventListener("click", () => {
      const emailInput = document.getElementById("email-input");
      const checkIcon = document.getElementById("check-icon");
      const crossIcon = document.getElementById("cross-icon");
      const verifyButton = document.getElementById("verify-button");
      const homeButton = document.getElementById("home-button");

      // Get the email value
      const email = emailInput.value.trim();

      if (email === "") {
        alert("Please enter an email address.");
        return;
      }

      // Check email existence
      if (checkEmailExistence(email)) {
        // Email exists
        checkIcon.classList.remove("hidden");
        crossIcon.classList.add("hidden");
        emailInput.classList.add("border-green-500");
        emailInput.classList.remove("border-gray-200", "border-red-500");

        verifyButton.classList.add("hidden");
        homeButton.classList.remove("hidden");
      } else {
        // Email does not exist
        checkIcon.classList.add("hidden");
        crossIcon.classList.remove("hidden");
        emailInput.classList.add("border-red-500");
        emailInput.classList.remove("border-gray-200", "border-green-500");

        verifyButton.classList.remove("hidden");
        homeButton.classList.add("hidden");
      }
    });
  </script>
</body>

</html>
