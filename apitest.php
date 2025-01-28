<?
include 'check_email.php'
?>
<form id="signupForm">
    <input type="email" id="email" name="email" required>
    <span id="emailFeedback"></span>
    <!-- Other form fields -->
    <button type="submit" id="submitBtn" disabled>Sign Up</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#email').on('input', function() {
        var email = $(this).val();
        if (email) {
            $.post('check_email.php', { email: email }, function(data) {
                var response = JSON.parse(data);
                if (response.exists) {
                    $('#emailFeedback').text('Email is already taken').css('color', 'red');
                    $('#submitBtn').prop('disabled', true);
                } else {
                    $('#emailFeedback').text('Email is available').css('color', 'green');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        } else {
            $('#emailFeedback').text('');
            $('#submitBtn').prop('disabled', true);
        }
    });
});
</script>
