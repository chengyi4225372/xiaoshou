<?php
// Declaring variable to prevent error
$username = ""; // username
$fname = ""; // fname
$lname = ""; // lname
$passport = ""; // passport
$telnum = ""; // telphone number
$em = ""; // em
$em2 = ""; // em2
$password = ""; // password
$password2 = ""; // confirm password
$error_array = array(); //Holds error message

if(isset($_POST['register_button'])){

    //registeration form value
    $username = strip_tags($_POST['reg_username']); //remove html tags
    $username = str_replace(' ', '', $username); // remove space
    $username = ucfirst(strtolower($username)); // Uppercase first letter
    $_SESSION['reg_username'] = $username; // store username into session variable

    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ', '', $fname);
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname; 

    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname; 

    $passport = strip_tags($_POST['reg_passport']);
    $_SESSION['reg_passport'] = $passport; 
    

    $telnum = strip_tags($_POST['reg_telnum']);
    $_SESSION['reg_telnum'] = $telnum; 

    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(' ', '', $em);
    $em = ucfirst(strtolower($em));
    $_SESSION['reg_email'] = $em;

    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(' ', '', $em2);
    $em2 = ucfirst(strtolower($em2));
    $_SESSION['reg_email2'] = $em2;

    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);

    $password = md5($password);

    $query = mysqli_query($con, "INSERT INTO customers VALUES ('$username', '$fname', '$lname', '$passport', '$telnum', '$em', '$password') ");

    array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

    //Clear session variables
    $_SESSION['reg_username'] = "";
    $_SESSION['reg_fname'] = "";
    $_SESSION['reg_lname'] = "";
    $_SESSION['reg_passport'] = "";
    $_SESSION['reg_telnum'] = "";
    $_SESSION['reg_email2'] = "";

}

?>