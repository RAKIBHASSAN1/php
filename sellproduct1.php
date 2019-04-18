<?php	
	session_start();
    $mysqli = new mysqli('localhost', 'root', '', 'sbedata');
    
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
	
	$a = $b = $d = $e = "";
	$product_id_err = $product_type_err = $product_image_err = $product_model_err = $product_price_err= "";
	if(isset($_POST['save'])){
        $a=$_POST['product_id'];
        $b=$_POST['product_type'];
        $file = addslashes(file_get_contents($_FILES["product_image"]["tmp_name"]));  
        $d=$_POST['product_model'];
        $e=$_POST['product_price'];
        $mysqli->query("INSERT INTO sell1(product_id,product_type,product_image,product_model,product_price)VALUES('$a','$b','$file','$d','$e')");
        header('location:after_login.php');
    }
    $mysqli->close();
  
    ?>

<!DOCTYPE html> 
<html> 
    <head>
            <link href="styles/sellproduct1.css" rel="stylesheet" type="text/css">
    </head>
<body> 

    <form action="sellproduct1.php" method="post" enctype="multipart/form-data">
    <P>Product  Information</p>
    <div class="n1">
        <label for="product_id">Product Id:</label>
        <input type="text" id="productid" name="product_id"  placeholder="Enter Product Id" required="">          
    </div>
    <div class="n3">
        <label for="producttype">Product Type:</label>
        <select id="producttype" name="product_type">
            <option value="Mobile">Mobile</option>
            <option value="Computer">Computer</option>
            <option value="Laptop">Laptop</option>
            <option value="Book">Book</option>
            <option value="Cloth">Cloth</option>
            <option value="Household matarials">Household matarials</option>
            <option value="Food">Food</option>
            <option value="Teaching Video">Teaching Video</option>
            <option value="Design">Design</option>
            <option value="Idea">Idea</option>
        </select>     
    </div>
    <div class="n2">  
    <label for="product_image">Product Image:</label>
    <input type="file" id="productimage" name="product_image"  placeholder="Add a picture"  required="">   
               
    </div>
  
    <div class="n4">
        <label for="product_model">Product Model:</label>
        <input type="productmodel" id="productmodel" name="product_model"  placeholder="Enter Product Model" required="">          
    </div>
    
    <div class="n5">
        <label for="product_price">Product Price:</label>
        <input type="productprice" id="productprice" name="product_price"  placeholder="Enter Product Price" required="">          
    </div>
    <div class="button">
                
                <a href="after_login.php" id="j2">Back</a>
                <button type="save" name="save">Save</button>
    </div>
    </form>

</body> 
</html>
<script>  
 $(document).ready(function(){  
      $('#save').click(function(){  
           var image_name = $('#product_image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#product_image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#product_image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  