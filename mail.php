<!Doctype html>
<html>
<head></head>
<body id="j">

<?php 

if (!isset($_POST["submit"])) { ?>
 
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
  <p id="m">To:</p> <input type="email" name="to_email" required=""><br>
  <p id="n">From:</p> <input type="email" name="from_email"  required=""><br>
   <p id="k">Subject:</p> <input type="text" name="subject" required=""><br>
  <p id="l"> Message:</p> <textarea rows="10" cols="20" name="message" required=""></textarea><br>
   <input type="submit" name="submit" value="Send Email">
  </form>
<?php
} else {
  
  if (isset($_POST["to_email"])) {
    $to_email = $_POST["to_email"];
    $from_email = $_POST["from_email"];
    $subject = $_POST["subject"];
    $body = $_POST["message"];
 
    if ( mail($to_email, $subject, $body, $from_email)) {
      echo("Email successfully sent to $to_email...");
     // header("location: after_login.php");
    } else {
      echo("Email sending failed...");
    }
  }
}
?>

</body>
</html>

<style>
#m{
    float:left;
    font-size:25px;
    margin-left:30px;
}
#n{
    float:left;
    margin-left:-30px;
    font-size:25px;
}
#k{
    float:left;
    font-size:25px;
    margin-left:-65px;
}
#l{
    float:left;
    font-size:25px;
    margin-left:-90px;
}
body{
    
    margin: 0px;
    padding: 0px;
    background-image: url(images/background/2.jpg);
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
  background-repeat: no-repeat;
  height: 100%;
}
form{
    
    margin-left:450px;
    margin-top:100px;
    background-color:black;
    height:400px;
    width:400px;
    color:white;
}
input[name="to_email"]
{
    margin-left:75px;
    margin-top:30px;
}
input[name="from_email"]
{
    margin-left:40px;
    margin-top:30px;
}
input[name="subject"]
{
    margin-left:15px;
    margin-top:30px;
}
textarea[name="message"]
{
    margin-left:5px;
    margin-top:20px;
}
input[name="submit"]
{
    margin-left:150px;
    margin-top:10px;
}
</style>
