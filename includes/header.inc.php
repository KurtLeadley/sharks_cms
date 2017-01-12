<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($pageTitle)) ? $pageTitle : 'SJ Shark Tank'; ?></title>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/custom-jquery.js"></script>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <link rel="stylesheet" href="css/main.css">
		<link rel="icon" href="../images/favicon.ico">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 8]>
    <link rel="stylesheet" href="css/ie6-7.css">
    <![endif]-->
</head>
<!-- # header.inc.php - Script 9.1 -->
<div class='wrapper'>
<?php if ($user) { $sessionUsername = $user->getUserName(); $sessionUserID = $user->getId(); } else { $sessionUsername = "Please Register or Login";} ?>
<body>
    <header>
		        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
								<li><a href="archive.php">Archives</a></li>
								<li><a href="#">Contact</a></li>
								<li><?php if ($user) { echo '<a href="logout.php">Logout</a>'; } else { echo '<a href="login.php">Login</a>'; } ?></li>
								<li><?php if (!$user) { echo '<a href="register.php">Register</a>' ; } ?></li>
								<li><?php if ($user) { ?> <span style="font-size: 15px !important;">Welcome <?php echo $sessionUsername ;} ?> </span></li>
            </ul>
        </nav>
        <h1 id="main_header">SJ Shark Tank</h1>
    </header>