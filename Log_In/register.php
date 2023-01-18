<?php
	//Include connection
	include 'config.php';

    session_start();

	//Check if user clicked submit
	if (isset($_POST['submit'])) {
		//Get the credentials to register
		$Username = $_POST['username'];
		$Password = md5($_POST['password']);
		$Cpassword = md5($_POST['cpassword']);
		//Check if the passwords are te same
		if ($Password == $Cpassword) {
			//Check if the user doesn't already exists
			$Sql = "SELECT * FROM users WHERE username= '$Username'";
			$Result = mysqli_query($Conn, $Sql);
			if (!$Result->num_rows > 0) {
				//Save the user credentials
				$Sql = "INSERT INTO users (username, password)
						VALUES ('$Username', '$Password')";
				$Result = mysqli_query($Conn, $Sql);
				//If the registration is correct
				if ($Result) {
					echo "<script>alert('Wow! User Registration Completed.')</script>";
					$_SESSION['username'] = $Username;
                    header("Location: ../logged_in/Index.php?tablename=". $_SESSION['username'] . "main");
					$Username = "";
					$_POST['password'] = "";
					$_POST['cpassword'] = "";
				//Send the user messages 
				} else {
					echo "<script>alert('Woops! Something Wrong Went.')</script>";
				}
			} else {
				echo "<script>alert('Woops! Username Already Exists.')</script>";
			}
			
		} else {
			echo "<script>alert('Password Not Matched.')</script>";
		}
	}
?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">

			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

			<link rel="stylesheet" type="text/css" href="style.css">

			<title>Register Form - Pure Coding</title>
		</head>
		<body>
			<div class="container">
				<form action="" method="POST" class="login-email">
					<p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
					<div class="input-group">
						<input type="text" placeholder="Username" name="username" required>
					</div>
					<div class="input-group">
						<input type="password" placeholder="Password" name="password" required>
					</div>
					<div class="input-group">
						<input type="password" placeholder="Confirm Password" name="cpassword"  required>
					</div>
					<div class="input-group">
						<button name="submit" class="btn">Register</button>
					</div>
					<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
				</form>
			</div>
		</body>
	</html>