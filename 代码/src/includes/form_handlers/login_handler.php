<?php
if(isset($_POST['login_button'])){
    $username = $_POST['log_username'];

    $_SESSION['log_username'] = $username;
    $password = md5($_POST['log_password']);

    $check_database_query = mysqli_query($con, "SELECT * FROM customers WHERE username='$username' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if($check_login_query == 1){
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else{
        array_push($error_array, "Password was wrong, please type again.");
    }
}
?>