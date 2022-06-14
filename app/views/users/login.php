<?php
   require APPROOT . '/views/includes/head.php';
?>
<div id="section-landing">

    <!-- <?php
       require APPROOT . '/views/includes/navigation.php';
    ?> -->
    <!--
        <script src="https://www.google.com/recaptcha/api.js?render=6Lfd3UEaAAAAAPea7o_3MQf9NtUy3EJBhRTex33R"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lfd3UEaAAAAAPea7o_3MQf9NtUy3EJBhRTex33R', {
                action: 'contact'
            }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
    -->
    <div class="container-login">
        <div class="wrapper-login">
            <h2>Sign in</h2>

            <form action="<?php echo URLROOT; ?>/users/login" method="POST">
                <input type="text" placeholder="Username *" name="username">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                </span>

                <input type="password" placeholder="Password *" name="password">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>
                <button id="submit" type="submit" value="submit">Submit</button>

                
                <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/users/register">Create an
                        account!</a><p class="options"><a href="<?php echo URLROOT; ?>/users/passwordReset">forgot your password?</a></p></p>
            </form>
        </div>
    </div>
</div>