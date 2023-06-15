<!DOCTYPE html>
<?php

		require_once('conn.php');
		$msg="";
		
		if(isset($_POST['submit']))
		{
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
		  
			if (empty($username)) {
				array_push($errors, "Username is required");
			}
			if (empty($password)) {
				array_push($errors, "Password is required");
			}
		  
			if (count($errors) == 0) {
				$password = md5($password);
				$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1) {
				  $_SESSION['username'] = $username;
				  $_SESSION['success'] = "You are now logged in";
				  header('location: adminHome.php');
				}else {
					array_push($errors, "Wrong username/password combination");
					header('location: adminHome.php');
				}
			}
		  }
		  
		  ?>
	
			
		}

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Login</title>
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
				<li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Registration</a><li>
				<li><a href="#" style="color:#fff"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
		<div class="container">
			<div class="panel panel-primary admin-login">
				<div class="panel-heading">
					<h3>Login</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post">
					  <div class="bg-danger error_msg"><?php echo $msg; ?></div>
					  <div class="form-group input-group">
							<span class="input-group-addon glyphicon glyphicon-envelope" style="top:0"></span><input type="email" name="uname" class="form-control"placeholder="Enter email">
					  </div>
					  <div class="form-group input-group">
							<span class="input-group-addon glyphicon glyphicon-lock" style="top:0"></span><input type="password" name="password" class="form-control" placeholder="Enter password">
					  </div>
					  
					  <div class="form-group"> 
						  <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
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




