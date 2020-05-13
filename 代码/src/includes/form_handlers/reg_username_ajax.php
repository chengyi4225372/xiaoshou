<?php
    require '../../config/config.php';
    $uname_check = mysqli_query($con, "SELECT * FROM customers WHERE username='$_GET[id]'");

    if(is_array(mysqli_fetch_array($uname_check))){
        // echo "用户已存在";
        echo "<br><font color=red>Username has existed, please try another username.</font>";
    }
    else{
        // echo "用户可以使用";
        echo "<br><font color=green>Username could be used!</font>";
    }
?>