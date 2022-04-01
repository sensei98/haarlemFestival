<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="section-landing">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>
<!--
<script src="https://www.google.com/recaptcha/api.js?render=6Lfd3UEaAAAAAPea7o_3MQf9NtUy3EJBhRTex33R"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lfd3UEaAAAAAPea7o_3MQf9NtUy3EJBhRTex33R', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
</script>
    -->
<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

            <form
                id="register-form"
                method="POST"
                action="<?php echo URLROOT; ?>/users/register"
                >
            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="email" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>

            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>

            <button class="darkBtn" id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Already registered? <a href="<?php echo URLROOT; ?>/users/login">Log In!</a></p>
        </form>
    </div>
</div>
