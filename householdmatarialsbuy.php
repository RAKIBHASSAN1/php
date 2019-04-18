<?php
 $mysqli = new mysqli("localhost", "root", "", "sbedata");
 
 if($mysqli === false){
     die("ERROR: Could not connect. " . $mysqli->connect_error);
 }
  
$a=$b="";
 $product_quantity_err = "";
	if(isset($_POST['save'])){
        $a=$_POST['product_id'];
        $b=$_POST['product_quantity'];
        $mysqli->query("INSERT INTO buy(product_id,product_quantity)  VALUES('$a','$b')");
        header('location:householdmatarialsbuy.php');
    }
     
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body style=' margin-top: 152px;
   padding: 0px;
    background-image: url(images/background/2.jpg);
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
  background-repeat: no-repeat;
  height: 100%;
    '>
<div class="p">
    <?php 
   
    $mysqli = new mysqli("localhost", "root", "", "sbedata");
 
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
     
   
    
    echo "<p style=' margin-top: 70px;font-size:30px;margin-left:400px;color:white;background-color:black;width:400px;height:50px;text-align:center;'>Buy Household matarials </p>" ;
    $sql = "SELECT * FROM sell1 where product_type='householdmatarials'";
    if($result = $mysqli->query($sql)){
        
        if($result->num_rows > 0){
            
           
               
           while($row = $result->fetch_array()){
               echo "<form style='margin-left:400px;background-color:green;color:white;width:400px;height:410px;'action='householdmatarialsbuy.php'method='post'>";
               echo "<p style='margin-left:100px;'>";
                echo "<br>".'<img src="data:image/jpeg;base64,'.base64_encode($row['product_image'] ).'" height="200" width="200" class="img-thumnail" />'."<br>";
                    echo "<br>"."Product Id: ". $row['product_id']."<br>";
                    echo "Product Type: ". $row['product_type']."<br>"; 
                    echo "Product Model: ". $row['product_model']."<br>";
                    echo "Product Price: $". $row['product_price']."<br>"; 
                    echo "Product Id:"." "." "." "."<input name='product_id'>"."</input>"."<br>";
                    echo "Quantity:"." "."<input name='product_quantity'style='margin-left:10px;margin-top:5px'>"."</input>";
                echo "</p>";
                echo "<button name='save'style='margin-left:200px'>"."Add to Cart"."</button>";
                echo "</form>";
            }
          
            $result->free();
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }

	
    // Close connection
    $mysqli->close();
    ?>
    
    
</div>
</body>

</html>


