<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_POST['update']))
{
$customername = $_POST['customername'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$street = $_POST['street'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$user_chosen=$_GET['uname'];
$username=$_POST['username'];
$update_activity = "UPDATE usertable SET customername = :cname , phone = :phone, email = :email, street = :street, city = :city, postcode = :postcode, username = :username where username = :user ";
$query = $connection->prepare($update_activity);
    $query->bindParam(':cname',$customername,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':street',$street,PDO::PARAM_STR);
    $query->bindParam(':city',$city,PDO::PARAM_STR);
    $query->bindParam(':postcode',$postcode,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':user',$user_chosen,PDO::PARAM_STR);
    $query->execute(); 
echo "<script>alert('User details updated successfully.');</script>";
}
?>
<html>

<head>
    <title>Wellness4All | Admin</title>
    <?php include('includes/head.php');?>
</head>

<body class="body_background">
    <!--header start here-->
    <?php include('includes/header.php');
    $user_chosen = $_GET['uname'];
    $select = "select * from usertable where username = :uname";
                $query = $connection->prepare($select);
                $query->bindParam(':uname',$user_chosen,PDO::PARAM_STR);
                $query->execute(); 
                while($row=$query->fetch())
							  {?>
    <!--header end here-->
    <div class="content">

        <h2>Update User Details</h2>
      
 <form method="post">
                    <div class="form-group">
                        <label>Customer name</label>
                        <input type="text" name="customername" value="<?php echo htmlentities($row['customername']);?>" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="number" name="phone" value="<?php echo htmlentities($row['phone']);?>" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail address</label>
                        <input type="text" name="email" value="<?php echo htmlentities($row['email']);?>"class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Street</label>
                        <input type="text" name="street" value="<?php echo htmlentities($row['street']);?>" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" value="<?php echo htmlentities($row['city']);?>" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Post code</label>
                        <input type="text" name="postcode" value="<?php echo htmlentities($row['postcode']);?>" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo htmlentities($row['username']);?>" class="form" required>
                    </div>
                    <button type="submit"  name="update" class="submit">Update</button>

                </form>
    </div>
<?php } ?>
</body>
<div>
    <?php include('includes/footer.php');?>
</div>
</html>
<?php }else{
         $_SESSION['msg']="Something went wrong.";
header("Location: msg.php");
} ?>
