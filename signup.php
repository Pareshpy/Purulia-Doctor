<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== REMIX-ICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>PD | Purulia Doctor</title>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="index.php" class="nav__logo">PURULIA DOCTOR</a></div>
            <ul class="links">
                <li><a href="#" class="nav__link">Home</a></li>
                <li><a href="#" class="nav__link">Services</a></li>
                <li><a href="#" class="nav__link">Doctors</a></li>
                <li><a href="#" class="nav__link">Clinics</a></li>
                <li><a href="#" class="nav__link">About</a></li>
            </ul>
            <div class="a-group">
                <a href="signup.php" class="a-login">Sign Up</a>
                <a href="login.php" class="a-login">Log In</a>
            </div>
        </div>
    </header>
    <main>
        <br>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam laboriosam, harum temporibus praesentium
            quasi aliquid aliquam maxime ex aspernatur nobis odit porro exercitationem totam magnam soluta rem dolorum
            blanditiis ipsa?</p>
        <div class="hero"
            style="background-image: url('assets/img/hero-bg.jpg'); background-size: cover; background-position: center;">
            <!--==================== LOGIN ====================-->
            <div class="login glass" id="login">
                <form action="" class="login__form">
                    <h2 class="login__title">Sign up</h2>

                    <div class="login__group">
                        <div>
                            <label for="name" class="login__label">Name</label>
                            <input type="text" placeholder="Write your Name" id="Name" class="login__input">
                        </div>

                        <div>
                            <label for="email" class="login__label">Email</label>
                            <input type="email" placeholder="Write your email" id="email" class="login__input">
                        </div>

                        <div>
                            <label for="phone" class="login__label">Phone No</label>
                            <input type="number" placeholder="Write your Phone No" id="phone" class="login__input">
                        </div>

                        <div>
                            <label for="password" class="login__label">Password</label>
                            <input type="password" placeholder="Enter your password" id="password" class="login__input">
                        </div>
                        <div>
                            <label for="c-password" class="login__label">Password</label>
                            <input type="password" placeholder="Confirm password" id="c-password" class="login__input">
                        </div>
                        <div id="error-message" class="error-message">Passwords do not match.</div>
                    </div>

                    <div>
                        <p class="login__signup">
                            Don't have an account? <a href="login.php">Log In</a>
                        </p>

                        <button type="submit" class="login__button">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </main>





    <!--=============== MAIN JS ===============-->
    <!-- M-413-205-520 -->
    <!-- 123456 -->
    <!-- <script src="assets/js/main.js"></script> -->
    <script>
        document.getElementById('phone').addEventListener('input', function (e) {
            var phoneInput = e.target;
            var phoneValue = phoneInput.value;
            if (phoneValue.length > 10) {
                phoneInput.value = phoneValue.slice(0, 10);
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
    </script>
</body>

</html>