<?php
session_start();
include('includes/config.php');
$customername = $phone = $email = $street = $city = $postcode = $username = $password = '';
$validation = "OK";
// function trim, strip slashes and special characters to validate input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["customername"])) {
        $_SESSION['msg']="Name is required.";
 header("Location: msg.php");
        $validation = "NOTOK";
  } else {
    $name = test_input($_POST["customername"]);
// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $_SESSION['msg']="Only letters and white space allowed as username.";
 header("Location: msg.php");
        $validation = "NOTOK";
    }
  }
   if (empty($_POST["phone"])) {
        $_SESSION['msg']="Phone number is required.";
 header("Location: msg.php");
       $validation = "NOTOK";
  } else {
    $phone = test_input($_POST["phone"]);
// check if name only contains numbers and whitespace
    if (!preg_match("/^[0-9 ]*$/",$phone)) {
        $_SESSION['msg']="Only numbers and white space allowed as phone number.";
 header("Location: msg.php");
        $validation = "NOTOK";
    }
  }
  if (empty($_POST["email"])) {
   $_SESSION['msg']="Email is required.";
 header("Location: msg.php");
      $validation = "NOTOK";
  } else {
    $email = test_input($_POST["email"]);
// check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg']="Invalid email format.";
 header("Location: msg.php");
        $validation = "NOTOK";
    }
  }
    if (empty($_POST["username"])) {
        $_SESSION['msg']="Username is required.";
 header("Location: msg.php");
        $validation = "NOTOK";
  } else {
    $name = test_input($_POST["username"]);
// check if username only contains letters, numbers and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
        $_SESSION['msg']="Only letters, numbers and white space allowed as username.";
 header("Location: msg.php");
        $validation = "NOTOK";
    }
  }
    if (empty($_POST["password"])) {
        $_SESSION['msg']="Password is required.";
 header("Location: msg.php");
        $validation = "NOTOK";
  } else {
    $password = test_input($_POST["password"]);
// check if password only contains letters, numbers and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$password)) {
        $_SESSION['msg']="Only letters, numbers and white space allowed as password.";
 header("Location: msg.php");
        $validation = "NOTOK";
    }
  }
    if (($_POST["password"])!=($_POST["password2"])) {
        $_SESSION['msg']="Passwords are not matching.";
 header("Location: msg.php");
        $validation = "NOTOK";
  }
    if($validation<>"OK"){
 header("Location: msg.php");
    }else{
// input passed all the checks and is valid for upload to database
$customername = test_input($_POST['customername']);
$phone = test_input($_POST['phone']);
$email = test_input($_POST['email']);
$street = test_input($_POST['street']);
$city = test_input($_POST['city']);
$postcode = test_input($_POST['postcode']);
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);
$password_enc = md5($password);
$select = " select * from usertable where username = :user ";
$query = $connection->prepare($select);
$query->bindParam(':user',$username,PDO::PARAM_STR);
$query->execute();    
if($query->rowCount() > 0){
    $_SESSION['msg']="Username in use, please choose different one.";
header("Location: msg.php");
}else{
    $registration = "insert into usertable(customername , phone , email , street , city , postcode , username , password) values (:name , :phone , :email , :street , :city , :postcode , :username , :pass )";
    $query = $connection->prepare($registration);
    $query->bindParam(':name',$customername,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':street',$street,PDO::PARAM_STR);
    $query->bindParam(':city',$city,PDO::PARAM_STR);
    $query->bindParam(':postcode',$postcode,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':pass',$password_enc,PDO::PARAM_STR);
    $query->execute(); 
    $_SESSION['msg']="Registration successful, please login.";
header("Location: msg.php");
}
  }}
?>
