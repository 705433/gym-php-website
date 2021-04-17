<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_GET['username']))
{
$admindel=$_GET['username'];
$delete_user = "delete from usertable where username = :user";
$query = $connection->prepare($delete_user);
$query->bindParam(':user',$admindel,PDO::PARAM_STR);
$query->execute();
if($query)
{
echo "<script>alert('Data deleted');</script>";
}
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Wellness4All | Admin</title>
    <?php include('includes/head.php');?>
</head>

<body class="body_background">
    <!--header start here-->
    <?php include('includes/header.php');?>
    <!--header end here-->
    <div class="content">
        <table class="table-list">
            <h4>All User Details </h4>
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Phone number</th>
                    <th> Email Id</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Post code</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php 
    $select = "select * from usertable";
                $query = $connection->prepare($select);
                $query->execute(); 
    $cnt=1;
                while($row=$query->fetch())
   				  {?>
                <tr>
                    <td><?php echo $cnt;?></td>
                    <td><?php echo $row['customername'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['street'];?></td>
                    <td><?php echo $row['city'];?></td>
                    <td><?php echo $row['postcode'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['password'];?></td>
                    <td>
                     <a class="button-table" href="update-user.php?uname=<?php echo $row['username'];?>">
                            <button class="button">Update</button></a>
                        <a class="button-table" href="manage-users.php?username=<?php echo $row['username'];?>">
                            <button class="red-button" onClick="return confirm('Do you really want to delete');">Delete</button></a>
                    </td>
                </tr>
                <?php $cnt=$cnt+1; }?>

            </tbody>
        </table>
    </div>
</body>
<div>
    <?php include('includes/footer.php');?>
</div>

</html>
<?php }else{
         $_SESSION['msg']="Something went wrong.";
header("Location: msg.php");
} ?>
