<?php
session_start();
include('includes/config.php');
$username = $password = "";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_POST['submit']))
{  
$username=test_input($_POST['username']);
$password=test_input($_POST['password']);
$select = " select * from admin where admin_name = :auser && admin_password = :apass && role = 'admin' ";
$query = $connection->prepare($select);
$query->bindParam(':auser',$username,PDO::PARAM_STR);
$query->bindParam(':apass',$password,PDO::PARAM_STR);
$query->execute();    
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['admin']=$_POST['username'];
header("location: dashboard.php");
} else{
	echo "<script>alert('Invalid Details');</script>";
}
}
?>
<html>

<head>
    <?php
include ('includes/head.php');
?>
</head>
<!---Body Section--->
<body class="body_background">
    <!---Header Section Starts--->
    <?php include('includes/header.php');?>
     <!---Header Section Ends--->
    <div class="content">
        <h2>Admin login</h2>
        <img alt="admin-icon" class="small-pic" src="img/admin.jpg">
        <form method="post">

            <label>Username</label>
            <input type="text" name="username" class="form" placeholder="Type your username here..." required>
            <label>Password</label>
            <input type="password" name="password" class="form" placeholder="Type your password here..." required>
            <button type="submit" name="submit" class="submit">Login</button>
        </form>
    </div>
</body>
<!---Footer Section--->
<div>
    <?php include('includes/footer.php');?>
</div>
<!---Modals Section--->
<?php include('includes/modal.php');?>

</html>
