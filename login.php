<?php
	require 'includes/include.php';
	session_start();
	if (!isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container-fluid">
		<br>
		<div class="jumbotron text-center">
			<h2>Login Page</h2>
		</div>
		<form method="post">
			<legend class="text-center"><u><b>Login</u></b></legend>
			<div class="row text-center" id="register">
				<div class="col-3 bg-primary"></div>
				<div class="col-6">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" name="name" required>
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" name="pass" required>
					</div>
				</div>
				<div class="col-3 bg-primary"></div>
			</div>
			<br>
			<button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
			<br><br>
		</form>
		<h6>Forgot your Password. <a href="reset.php">Reset</a> it.</h6>
		<h6>Don't have an account. <a href="register.php">Register.</a></h6>
	</div>
</body>
</html>
<?php
	if (isset($_POST['login'])) {
		extract($_POST);
		$passwordfromuser = $pass;
		$convertedpass = sha1($passwordfromuser);
		$selQuery = "SELECT * FROM 6470users WHERE USERNAME = '$name' AND PASSWORD_HASH = '$convertedpass'";
		$result = mysqli_query($conn, $selQuery);
		if(!isset($result)) {
			die("Query Failed : ".mysqli_error($conn));
		}else{
		$count = mysqli_num_rows($result);
		if($count == 1){
			$_SESSION['username'] = $name;
			//successful login
			echo "Login Success";
			//redirect to admin
			header("location:dashboard.php");
		} else {
			echo "<h4 class='text-warning'>Username or password you entered is incorrect</h4>";
		}
		}
	}
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<h2>Dear <?php echo $_SESSION['username']; ?> you are already logged in</h2>
	<h6>To go to dashboard <br><a class="btn btn-primary" href="dashboard.php">click here</a></h6>
	<span><h6>To log out <form method="post"><button class="btn btn-warning" name="logout">click here</button></form></h6></span>
</body>
</html>
<?php
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
		header("location:login.php");
	}
}
?>