<?php
$mysqli = new mysqli('localhost', 'root', '', 'sbedata');
 
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$username =$email = $password = $confirm_password = $squestion = $questionans = "";
$username_err = $email_err = $password_err = $confirm_password_err = $squestion_err = $questionans_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT username FROM register WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();
	}
	
	if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        $sql = "SELECT email FROM register WHERE email = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            
            $param_email = trim($_POST["email"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();
    }

      if(empty(trim($_POST["squestion"]))){
        $squestion_err = "Please select a question";     
      }else{
            $squestion = trim($_POST["squestion"]);
          }

    if(empty(trim($_POST["questionans"]))){
      $questionans_err = "Please enter your answer.";     
    }else{
            $questionans = trim($_POST["questionans"]);
    }
    
    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
  } else{
      $password = trim($_POST["password"]);
  }
  
  if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = "Please enter a confirm password.";     
  } else{
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password)){
          $confirm_password_err = "Password did not match.";
      }
  }

    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($squestion_err) && empty($questionans_err)){
        
        $sql = "INSERT INTO register (username, email, passwordd, squestion, questionans) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssss", $param_username,$param_email, $param_password,$param_squestion, $param_questionans);
            
            $param_username = $username;
			      $param_email=$email;
            $param_password = md5($password,PASSWORD_DEFAULT);
            $param_squestion = $squestion;
			      $param_questionans = $questionans;
            
            if($stmt->execute()){
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();
    }
    
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="styles/signup.css" rel="stylesheet" type="text/css">
        <title>Sign up</title>
    </head>
    <body>
            <div class="container">
                    <img src="images/img_avatar.jpg" class="avatar">
                    <h1>Sign Up</h1>
                    <p id="n">*Please fill in this form to create an account.</p><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="input-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                 <label for="username"><b>User Name</b></label>
                                 <input type="text" placeholder="Enter User Name" name="username" required>
                                 <span class="help-block"><?php echo $username_err; ?></span>
                             </div>
                             <div class="input-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                <label for="email"><b>Email</b></label>
                                <input type="email" placeholder="Enter Email" name="email" required>
                                <span class="help-block"><?php echo $email_err; ?></span>
                             </div>
                             <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="password"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>
                                <span class="help-block"><?php echo $password_err; ?></span>
                             </div>
                             <div class="input-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label for="comfirm_password"><b>Comfirm Password</b></label>
                                <input type="password" placeholder="Confirm password" name="confirm_password" required>
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                             </div>
                              <div class="input-group <?php echo (!empty($squestion_err)) ? 'has-error' : ''; ?>">
                                    <label for="squestion"required=""><b>Security Question</b></label>
                                    <select name="squestion">
                                            <option value="">Select an Option</option>
                                            <option value="1">What is your childhood name?</option>
                                            <option value="2" >What is your nick name?</option>
                                            <option value="3">What is your Birth place?</option>
                                            <option value="4">What is your first laptop name?</option>
                                          </select>
                                          <span class="help-block"><?php echo $squestion_err; ?></span>
                              </div>
                              <div class="input-group <?php echo (!empty($questionans_err)) ? 'has-error' : ''; ?>">
                                    <label for="questionans"><b>Question Answer</b></label>
                                    <input type="text" name="questionans" placeholder="Enter Security Question Answer" required="">
                                    <span class="help-block"><?php echo $questionans_err; ?></span>
                              </div>
                           <div class="clearfix">
                                <button type="submit" class="signupbtn">Sign Up</button>
                              </div>
                              <a href="index.php">Cancel?</a>
                            </div>
                          </form>
            </div>
    </body>
</html>



