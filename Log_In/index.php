<?php
    if (!(session_status() == PHP_SESSION_ACTIVE)) {
        session_start();
    }

	//Import the connection
	include 'config.php';

	//Check if user clicked submit
	if (isset($_POST['submit'])) {
		$Username = $_POST['username'];
		$Password = md5($_POST['password']);
		//Check if user exists
		$Sql = "SELECT * FROM users WHERE username='$Username' AND password='$Password'";
		$Result = mysqli_query($Conn, $Sql);
		if ($Result->num_rows > 0) {
			//Log the user in
			$Row = mysqli_fetch_assoc($Result);
			$_SESSION['username'] = $Username;
			header("Location: ../logged_in/Index.php?tablename=". $_SESSION['username'] . "main");
		//Send the user messages
		} else {
			echo "<script>alert('Woops! Username or Password is Wrong.')</script>";
		}
	}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Log in</title>
	</head>
	<body>
		<div class="container">
			<form action="" method="POST" class="login-email">
				<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
				<div class="input-group">
					<input type="text" placeholder="Username" name="username" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Password" name="password"  required>
				</div>
				<div class="input-group">
					<button name="submit" class="btn">Login</button>
				</div>
				<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
			</form>
		</div>
	</body>
</html>