<?php
require 'config/config.php';

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM customers WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
// else {
// 	header("Location: register.php");
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Woolin Auto</title>
    <!-- Js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../published/js/bootstrap.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../published/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/index_style.css">

</head>
<body>
    <!-- TODO: Nav bar -->
        <!-- Nar bar 
            When not loggin,
            give option to login page(costumer), 
            Emtreperner login. 
            hide buying chart, hide profile -->
        <!-- Nar bar
        
                    <?php if($user['username']){
                        echo 'Hi,' . $user['username'];   
                    }else{
                        echo "<a href=\"#\">Login</a>";
                    }
                    ?> 

            When loggin,
            Show profile(give name),
            Show buyindg chart(customer),
            Show admin page(manager),
            Show manager page(manager)-->
            <div class="top_bar">
                <div class="logo">
                    <a href="index.php">Woolin Auto</a>
                </div>
                <nav>
                    <a href="register.php">Login</a>
            
                </nav>
            </div>

    <div class=wrapper>
