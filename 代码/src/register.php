<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Woolin Auto</title>
    <script type="text/javascript" src="assets/javascript/util.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <?php  

    if(isset($_POST['register_button'])) {
        echo '
        <script>

        $(document).ready(function() {
            $("#first").show();
            $("#second").hide();
        });

        </script>

        ';
    }


    ?>
    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h1>Welcome to Woolin Auto!</h1>
                Login in or sign up below!
            </div>

            <div id="first">
                <form name="log_form" action="register.php" method="POST" onsubmit="return log_chkonsubmit()">
                    <input type="text" id="log_username" name="log_username" placeholder="Username" value="<?php 
                    if(isset($_SESSION['log_username'])){
                        echo $_SESSION['log_username'];
                    } ?>" required>
                    <span id="log_username_msg"></span>
                    <br>

                    <input type="password" name="log_password" placeholder="Password" autocomplete="on">
                    <?php if(in_array("Password was wrong, please type again.", $error_array)) {
                        echo "Password was wrong, please type again.";
                    }
                    ?>
                    <br>

                    <input type="submit" name="login_button" value="Login">
                    <br>
                    <a href="#" id="signup" class="signup">Need an account? Register now!</a>
                </form>
            </div>

            <br>

            
            <div id="second">
                <form name="register_form" action="register.php" method="POST" onsubmit="return chkonsubmit();">
                    <input type="text" id="reg_username" name="reg_username" placeholder="Username" value="<?php 
                    if(isset($_SESSION['reg_username'])){
                        echo $_SESSION['reg_username'];
                    } ?>" required>
                    <div id="reg_username_msg"></div>
                    <div id="reg_username_msg2"></div>
                    <br>
                    <input type="text" id="reg_fname" name="reg_fname" placeholder="First Name" value="<?php 
                    if(isset($_SESSION['reg_fname'])){
                        echo $_SESSION['reg_fname'];
                    } ?>" required>
                    <div id="reg_fname_msg"></div>
                    <br>
                    <input type="text" id="reg_lname" name="reg_lname" placeholder="Last Name" value="<?php 
                    if(isset($_SESSION['reg_lname'])){
                        echo $_SESSION['reg_lname'];
                    } ?>" required>
                    <div id="reg_lname_msg"></div>
                    <br>
                    <input type="text" id="reg_passport" name="reg_passport" placeholder="Passport Id" value="<?php 
                    if(isset($_SESSION['reg_passport'])){
                        echo $_SESSION['reg_passport'];
                    } ?>" required>
                    <div id="reg_passport_msg"></div>
                    <br>
                    <input type="text" id="reg_telnum" name="reg_telnum" placeholder="Telephone number" value="<?php 
                    if(isset($_SESSION['reg_telnum'])){
                        echo $_SESSION['reg_telnum'];
                    } ?>" required>
                    <div id="reg_telnum_msg"></div>
                    <br>


                    <input type="email" id="reg_email" name="reg_email" placeholder="Email" value="<?php 
                    if(isset($_SESSION['reg_email'])){
                        echo $_SESSION['reg_email'];
                    } ?>" required>
                    <div id="reg_em2_msg"></div>
                    <br>
                    <input type="email" id="reg_email2" name="reg_email2" placeholder="Confirm Email" value="<?php 
                    if(isset($_SESSION['reg_email2'])){
                        echo $_SESSION['reg_email2'];
                    } ?>" required>
                    <div id="reg_em1_msg"></div>
                    <br>
                    <input type="password" id="reg_password" name="reg_password" placeholder="Password" autocomplete="on" required>
                    <div id="reg_passwd_msg"></div>
                    <br>
                    <input type="password" id="reg_password2" name="reg_password2" placeholder="Confirm Password" autocomplete="on" required>
                    <div id="reg_passwd2_msg"></div>
                    <br>
                    <input type="submit" name="register_button" value="Register">

                    <br>

                    <?php 
                    // if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; 
                    $_SESSION['$error_array'] = "";
                    ?>

                    <br>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
                    <script type="text/javascript" src="assets/javascript/register.js"></script>
                </form>

            </div>

        </div>
    </div>


</body>
</html>