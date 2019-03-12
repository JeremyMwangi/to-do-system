<?php
	include 'includes/include.php';
	session_start();
	if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<u><h2>Welcome <?php echo $_SESSION['username']; ?></h2></u>
	<h5>To log out <form method="post"><button class="btn btn-warning" name="logout">click here</button></form></h5><hr>
	<h5>To go to you To Do page <form method="post"><button class="btn btn-warning" name="to_do">click here</button></form></h5>
</body>
</html>
<?php
	if (isset($_POST['to_do'])) {
		header("location:toDoPage.php");
	}
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
		header("location:login.php");
	}
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<h2>Welcome User! You are not logged in.</h2>
	<p><a href="login.php">Login</a> or <a href="register.php">register</a> to access the dashboard</p>
</body>
</html>
<?php
}
?>