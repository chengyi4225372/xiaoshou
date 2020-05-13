<?php
    require '../../config/config.php';
    $uname_check = mysqli_query($con, "SELECT * FROM customers WHERE username='$_GET[id]'");

    if(is_array(mysqli_fetch_array($uname_check))){
        echo "";
    }
    else{
        echo "<br><font color=red>Username does not exist, please type again.</font>";
    }
?>