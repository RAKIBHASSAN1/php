<?php	
	session_start();
	$mysqli = new mysqli('localhost', 'root', '', 'sbedata');
	
	if($mysqli === false){
		die("ERROR: Could not connect. " . $mysqli->connect_error);
	}
	
	$username = $password = "";
	$username_err = $password_err = "";
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} else{
      $password = trim($_POST["password"]);
      $password = md5($password,PASSWORD_DEFAULT);
		}
		if(empty($username_err) && empty($password_err)){
		$sql="SELECT * FROM register WHERE username='$username' AND passwordd='$password' LIMIT 1";
			if($result = $mysqli->query($sql))
			{
				if($result->num_rows > 0)
				{
					echo "you have successfully login";
					$_SESSION[user]=$username;
					header("location: after_login.php");
				}
				else
				{
					echo "Username or Password is wrong!";
					header("location: login.php");
				}
			}
		}
	}
?>

<!Doctype html>
<html>
    <head>
        <link href="styles/login.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="loginbux">
                <img src="images/img_avatar.jpg" class="avatar">
                <h1>Login Here</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label for="name">User Name</label>
                  <input type="text" id="username" name="username"  placeholder="Enter Username" required="">
                  <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" placeholder="Enter password" required="">
                  <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="button">
                    <button type="login">Login</button>
                </div>
                <div class="button1">
                        <a href="forgetpassword.php">Lost Your Password?</a><br>
                        <a href="signup.php">Don't have an account?</a><br>
                        <a href="index.php">Cancel?</a>
                </div>
              </form>
        </div>
           
    </body>
</html>
