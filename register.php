<?php
	require 'includes/include.php';
	session_start();
	if(!isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container-fluid">
		<br>
		<div class="jumbotron text-center">
			<h2>Register Page</h2>
		</div>
		<div class="text-center">
			<form method="post">
				<legend><u><b>Register</u></b></legend>
				<div class="row" id="register">
					<div class="col-3 bg-success"></div>
					<div class="col-6">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" name="name" required>
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" name="pass" required>
						</div>
						<div class="form-group">
							<label for="mail">Phone Number:</label>
							<input type="number" class="form-control" name="number" required>
						</div>
					</div>
					<div class="col-3 bg-success"></div>
				</div>
				<br>
				<button type="submit" class="btn btn-success btn-block" name="register">Register</button>
				<br><br>
			</form>
			<h6>Already have an account. <a href="login.php">Login.</a></h6>
			<h6>Forgot your password. <a href="reset.php">Reset it.</a></h6>
		</div>
	</div>
</body>
</html>
<?php
		if (isset($_POST['register'])) {
			extract($_POST);
			$passwordfromuser = $pass;
			$convertedpass = sha1($passwordfromuser);
			//SAVE / PERSIST USER INPUT TO DB
			$insQuery = "INSERT INTO 6470users(USERNAME, PASSWORD_HASH, PHONE) VALUES ('$name', '$convertedpass', '$number') ";
			//run query
			if (mysqli_query($conn, $insQuery)) {
				//insert success
				$_SESSION['username'] = $name;
				echo "<h4>Register success</h4>";
				//reload page
				header("location: login.php");
			} else {
				die("Insert error : ".mysqli_error($conn));
			}
		}
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<form method="post">
		<h4>Dear <?php echo $_SESSION['username']; ?> you are logged in. Please logout to register or go to the <a href="dashboard.php">dashboard</a></h4>
		<button class="btn btn-warning" name="logout">LogOut</button>
	</form>
</body>
</html>
<?php
		if (isset($_POST['logout'])) {
			session_unset();
			session_destroy();
			header("location:register.php");
		}
	}
?>