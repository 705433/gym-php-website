<?php
session_start();
include('includes/config.php');
$username = $password = '';
$validation = "OK";
// function trim, strip slashes and special characters to validate input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
        $_SESSION['msg']="Only letters, numbers and white space allowed as password.";
 header("Location: msg.php");
        $validation = "NOTOK";
    }
  }
    if($validation<>"OK"){
 header("Location: msg.php");
    }else{
// input passed all the checks and is valid for check in database
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);
$password_decrypted = md5($password);
$select = " select * from usertable where username = :user && password = :upass ";
$query = $connection->prepare($select);
$query->bindParam(':user',$username,PDO::PARAM_STR);
$query->bindParam(':upass',$password_decrypted,PDO::PARAM_STR);
$query->execute();    
if($query->rowCount() > 0)
{
    $_SESSION['currentuser'] = $username;
    header("Location: index.php");
} else{
 $_SESSION['msg']="Something went wrong. Please try again.";
header("Location: msg.php");
}
    }}
?>
