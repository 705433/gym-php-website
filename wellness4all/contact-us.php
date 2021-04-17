<?php
session_start();
include('includes/config.php');
$validation = "OK";
$name_error = $email_error = $message_error = "";
$username = $name = $email = $message = "";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
    $name_error = "Name is required";
        $validation="NOTOK";
  } else {
    $name = test_input($_POST["name"]);
// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed"; 
        $validation="NOTOK";
    }
  }
  if (empty($_POST["email"])) {
    $email_error = "Email is required";
      $validation="NOTOK";
  } else {
    $email = test_input($_POST["email"]);
// check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format"; 
        $validation="NOTOK";
    }
  }
// check if message is written
  if (empty($_POST["message"])) {
    $message_error = "Message field is empty.";
      $validation="NOTOK";
  } else {
    $message = test_input($_POST["message"]);
  }
    if($validation<>"OK"){
    echo "<script>alert('Please check your input and try again.');</script>"; 
    }else{
// input passed all the checks and is valid for upload to database
if(isset($_SESSION['currentuser'])){
$username = $_SESSION['currentuser'];
$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$message = test_input($_POST['message']); 
$send_message = "insert into messages(Username , Name , Email , Message) values (:puser , :pname , :pemail , :pmess )";
$query = $connection->prepare($send_message);
$query->bindParam(':puser',$username,PDO::PARAM_STR);
$query->bindParam(':pname',$name,PDO::PARAM_STR);
$query->bindParam(':pemail',$email,PDO::PARAM_STR);
$query->bindParam(':pmess',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $connection->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Sent.');</script>";
}else{
echo "<script>alert('Something went wrong, please try again.');</script>";
}
}else{
$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$message = test_input($_POST['message']); 

$send_message = "insert into messages(Name , Email , Message) values (:pname , :pemail , :pmess )";
$query = $connection->prepare($send_message);
$query->bindParam(':pname',$name,PDO::PARAM_STR);
$query->bindParam(':pemail',$email,PDO::PARAM_STR);
$query->bindParam(':pmess',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $connection->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Sent.');</script>";
}else{
echo "<script>alert('Something went wrong, please try again.');</script>";
} }   
}
}
?>
<html>
<head>
    <?php
include ('includes/head.php');
?>
</head>
<body class="body_background">
    <?php include('includes/header.php');?>
    <div class="content">

        <div class="form-border">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div>
                    <h4>Send Us A Message</h4>
                </div>
                <span class="required">* Denotes Required Field</span>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form" value="<?php echo $name;?>" /> 
                <span class="error"><?php echo $name_error;?></span></div>
                <div class="form-group"> <label for="email">E-mail:*</label>
                    <input type="text" name="email" placeholder="ip_man@example.com" class="form" value="<?php echo $email;?>" />
                <span class="error"><?php echo $email_error;?></span></div>
                <div class="form-group"> <label for="message">Message:*</label><br>
                    <textarea name="message" cols="40" rows="10"></textarea> 
                <span class="error"><?php echo $message_error;?></span></div>
                <div class="form-group"> <button class="button" type="submit" name="send">Submit Message</button></div>
            </form>
        </div>
        <div id="map-address"></div>
        <br>
        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCsF2BNRY7NwuSTMqdNeVVcVQX1Ilqtrhc   &q=SW4+9DE" allowfullscreen>
        </iframe>
          <h4>Contact Us By Post</h4>
        <div>"Wellness4All"</div>
        <div>88 Workout road</div>
        <div>SW11 1XG</div>
        <h4>Call Us</h4>
        <div><a href="tel:02052352627">Tel.: 0 205 235 26 27</a></div>
    </div>
</body>
<div>
    <?php include('includes/footer.php');?>
</div>
<!---Modals Section--->
<?php include('includes/modal.php');?>
</html>