<?php	
	session_start();
    $mysqli = new mysqli('localhost', 'root', '', 'sbedata');
    
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
	
	$a = $b= $c = $d = "";
	$name_err = $address_err = $phone_number_err = $email_err = "";
	if(isset($_POST['save'])){
        $a=$_POST['name'];
        $b=$_POST['address'];
        $c=$_POST['phone_number'];
        $d=$_POST['email'];
        $mysqli->query("INSERT INTO sell(name,address,phone_number,email)VALUES('$a','$b','$c','$d')");
        header('location:sellproduct1.php');
    }
    $mysqli->close();
    ?>

<!DOCTYPE html> 
<html> 
    <head>
            <link href="styles/sellproduct.css" rel="stylesheet" type="text/css">
    </head>
<body> 

    <form action="sellproduct.php" method="post">
    <P>Product Seller Information</p>
    <div class="n1">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"  placeholder="Enter name" required="" value="">  
        <span class="help-block"><?php echo $name_err; ?></span>        
    </div>
    <div class="n2">
        <label for="address">Address:</label>
        <input type="Address" id="address" name="address"  placeholder="Enter address" required="" value="">  
        <span class="help-block"><?php echo $address_err; ?></span>        
    </div>
    <div class="n3">
        <label for="phone_number">Phone No:</label>
        <input type="phone_number" id="phone_number" name="phone_number"  placeholder="Enter Phone Number" required="" value="">        
        <span class="help-block"><?php echo $phone_number_err; ?></span>  
    </div>
    <div class="n4">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"  placeholder="Enter Email" required="" value="<?php echo $d; ?>">   
        <span class="help-block"><?php echo $email_err; ?></span>       
    </div>
    <div class="button">
                <a href="after_login.php" id="j2">Back</a>
                <button type="submit" name="save">Next</button>
    </div>
    </form>

</body> 
</html>
