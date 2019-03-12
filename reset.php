<?php
	require 'includes/include.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<div>
		<h2>Fill the following account details to reset that accounts password</h2>
		<div class="text-center">
			<form method="post">
				<legend><u><b>Reset</u></b></legend>
				<div class="row" id="register">
					<div class="col-3 bg-warning"></div>
					<div class="col-6">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" name="name" required>
						</div>
						<div class="form-group">
							<label for="number">Phone Number:</label>
							<input type="number" class="form-control" name="number" required>
						</div>
						<div class="form-group">
							<label for="password">New Password:</label>
							<input type="password" class="form-control" name="pass" required>
						</div>
					</div>
					<div class="col-3 bg-warning"></div>
				</div>
				<br>
				<button type="submit" class="btn btn-warning btn-block" name="reset">Reset</button>
				<a href="login.php">LOGIN</a>
				<br>
				<a href="register.php">REGISTER</a>
				<br><br>
			</form>
		</div>
	</div>
</body>
</html>
<?php
	if (isset($_POST['reset'])) {
		extract($_POST);
		$selQuery = "SELECT * FROM 6470users WHERE USERNAME = '$name' AND PHONE = '$number'";
		$result = mysqli_query($conn, $selQuery);
		if(!isset($result)) {
			die("Query Failed : ".mysqli_error($conn));
		}else{
		$count = mysqli_num_rows($result);
		if($count == 1){
		$passwordfromuser = $pass;
		$convertedpass = sha1($passwordfromuser);
		$update = "UPDATE 6470users SET PASSWORD_HASH='$convertedpass' WHERE USERNAME = '$name' AND PHONE = '$number'";
		mysqli_query($conn, $update);
		header("location:login.php");
		} else {
			echo "<h4 class='text-warning'>Username or number you entered is incorrect</h4>";
		}
	}
}
?>