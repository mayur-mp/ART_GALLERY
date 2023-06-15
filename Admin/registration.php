<!DOCTYPE html>
<?php
$username ="";
$email="";

	require_once('conn.php');
	$msg="";

	if(isset($_POST['submit']))
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  
	// form validation: ensure that the form is correctly filled ...
	// by adding (array_push()) corresponding error unto $errors array
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if ($password_1 != $password_2) {
	  array_push($errors, "The two passwords do not match");
	}
  
	// first check the database to make sure 
	// a user does not already exist with the same username and/or email
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	
	if ($user) { // if user exists
	  if ($user['username'] === $username) {
		array_push($errors, "Username already exists");
	  }
  
	  if ($user['email'] === $email) {
		array_push($errors, "email already exists");
	  }
	}
  
	// Finally, register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
  
		$query = "INSERT INTO users (username, email, password) 
				  VALUES('$username', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}
  	
			
		
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Registration</title>
		<link href="../images/icon.png" rel="icon"> 
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
	</head>

	<body>
	
		
		<nav class="navbar navbar-inverse top-menu">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">Art Gallery</a>
			</div>
			<div>
			  <ul class="nav navbar-nav">
				<li><a href="#">About</a></li>
			  </ul>
				<ul class="nav navbar-nav navbar-right">
				<li><a href="#" style="color:#fff"><span class="glyphicon glyphicon-user"></span> Registration</a><li>
				<li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
		<div class="container">
			<div class="panel panel-primary admin-login">
				<div class="panel-heading">
					<h3>Registration</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post">
					  <div class="bg-danger error_msg"><?php echo $msg; ?></div>
					  <div class="form-group input-group">
							<span class="input-group-addon glyphicon glyphicon-user" style="top:0"></span><input type="text" name="fname" class="form-control"placeholder="Enter Full Name">
					  </div>
					  <div class="form-group input-group">
							<span class="input-group-addon glyphicon glyphicon-envelope" style="top:0"></span><input type="email" name="uname" class="form-control"placeholder="Enter Email">
					  </div>
					  <div class="form-group input-group">
							<span class="input-group-addon glyphicon glyphicon-lock" style="top:0"></span><input type="password" name="password" class="form-control" placeholder="Set password">
					  </div>
					  
					  <div class="form-group"> 
						  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
					  </div>
					</form>
				</div>
			</div>
		</div>
		<?php
			require_once('dbconclose.php');
		?>
		
	</body>
</html>