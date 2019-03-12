<?php
	require 'includes/include.php';
	session_start();
	extract($_SESSION);
	if (isset($username)) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>To Do Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
</head>
<body>
	<p>Go to <a href="dashboard.php">dashboard</a></p>
	<h2> Hello <?php echo $_SESSION['username']; ?></h2>
	<div id="add"></div>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="#add">Add Jobs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#edit">Edit Jobs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#delete">Delete Jobs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#search">Search for Jobs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#view">View all Jobs</a>
			</li>
		</ul>
	</nav>
	<hr>
	<div class="row" style="height:350px;"><br>
		<div class="col-4">
			<h3 class="text-primary">Add Jobs</h3>
		</div>
		<div class="col-8">
			<h3>Add Jobs</h3>
			<form method="post" action="#add">
				<input type="text" name="add" required><br><br>
				<button class="btn btn-primary">Add Jobs</button>
			</form>
			<?php
			if (isset($_POST['add'])) {
				extract($_POST);
				$addJob = "INSERT INTO 6470jobs (USERNAME, JOBS) VALUES ('$username', '$add')";
				$result = mysqli_query($conn, $addJob);
				if (!isset($result)){
					die("Query failed".mysqli_error($conn));
				}
				echo "Changes made";
			}
			?>
			<div id="edit"></div>
		</div>
	</div>
	<hr>
	<div class="row" style="height:350px;"><br>
		<div class="col-4">
			<h3 class="text-primary">Edit Jobs</h3>
		</div>
		<div class="col-8">
			<h3>Edit Jobs</h3>
			<form method="post" action="#edit">
				<label>Current Name:</label><br>
				<input type="text" name="current" required><br><br>
				<label>New Name:</label><br>
				<input type="text" name="new" required><br><br>
				<button class="btn btn-primary" name="edit">Edit Jobs</button>
			</form>
			<?php
			if (isset($_POST['edit'])) {
				extract($_POST);
				$editJob = "UPDATE 6470jobs SET JOBS = '$new' WHERE  JOBS = '$current' AND USERNAME = '$username'";
				$result = mysqli_query($conn, $editJob);
				if (!isset($result)){
					die("Query failed".mysqli_error($conn));
				}
				echo "Changes made";
			}
			?>
			<div id="delete"></div>
		</div>
	</div>
	<hr>
	<div class="row" style="height:350px;"><br>
		<div class="col-4">
			<h3 class="text-primary">Delete Jobs</h3>
		</div>
		<div class="col-8">
			<h3>Delete Jobs</h3>
			<form method="post" action="#delete">
				<input type="text" name="delete" required><br><br>
				<button class="btn btn-primary">Delete jobs</button>
			</form>
			<?php
			if (isset($_POST['delete'])) {
				extract($_POST);
				$deleteJob = "DELETE FROM 6470jobs WHERE JOBS = '$delete' AND USERNAME = '$username'";
				$result = mysqli_query($conn, $deleteJob);
				if (!isset($result)){
					die("Query failed".mysqli_error($conn));
				}
				echo "Changes made";
			}
			?>
			<div id="search"></div>
		</div>
	</div>
	<hr>
	<div class="row" style="height:350px;"><br>
		<div class="col-4">
			<h3 class="text-primary">Search for Jobs</h3>
		</div>
		<div class="col-8">
			<h3>Search for Jobs</h3>
			<form method="post" action="#search">
				<input type="text" name="search" required><br><br>
				<button class="btn btn-primary" name="searchButton">Search for Jobs</button>
			</form>
			<?php
			if (isset($_POST['searchButton'])) {
				extract($_POST);
				$search = "%".$search."%";
				$searchJob = "SELECT JOBS FROM 6470jobs WHERE USERNAME = '$username' AND JOBS LIKE '$search'";
				$result = mysqli_query($conn, $searchJob);
				if (!isset($result)){
					die("Query failed".mysqli_error($conn));
				} else {
					echo "<ol>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<li>$row[JOBS]</li>";
					}
					echo "</ol>";
				}
			}
			?>
			<div id="view"></div>
		</div>
	</div>
	<hr>
	<div class="row" style="height:350px;"><br>
		<div class="col-4">
			<h3 class="text-primary">View all Jobs</h3>
		</div>
		<div class="col-8">
			<h3>View all Jobs</h3><br>
			<form method="post" action="#view">
				<button class="btn btn-primary" name="view">View all Jobs</button>
			</form>
			<?php
			if (isset($_POST['view'])) {
				extract($_POST);
				$viewJob = "SELECT * FROM 6470jobs WHERE USERNAME = '$username'";
				$result = mysqli_query($conn, $viewJob);
				if (!isset($result)){
					die("Query failed".mysqli_error($conn));
				} else {
					echo "<ol>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<li>$row[JOBS]</li>";
					}
					echo "</ol>";
				}
			}
			?>
		</div>
	</div>
	<hr>
	<footer>
		
	</footer>
</body>
</html>
<?php
	} else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>To Do Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<h2>Welcome User! You are not logged in.</h2>
	<p><a href="login.php">Login</a> or <a href="register.php">register</a> to access the to do page</p>
</body>
</html>
<?php
}
?>