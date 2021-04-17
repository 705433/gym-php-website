<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_GET['personalid']))
{
$admindel=$_GET['personalid'];
$delete_personal = "delete from personal where PersonalTrainingId = :pid";
$query = $connection->prepare($delete_personal);
$query->bindParam(':pid',$admindel,PDO::PARAM_STR);
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
            <h4>Manage Personal Training Memberships</h4>
            <thead>
                <tr>
                    <th>Personal Training Id</th>
                    <th>Description</th>
                    <th>Days Of The Week</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Monthly Fee</th>
                    <th>LastUdpate</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $select = "select * from personal";
                $query = $connection->prepare($select);
                $query->execute(); 
                while($row=$query->fetch())
    			  {?>
                <tr>
                    <td><?php echo $row['PersonalTrainingId'];?></td>
                    <td><?php echo $row['Description'];?></td>
                    <td><?php echo $row['DaysOfTheWeek'];?></td>
                    <td><?php echo $row['Time'];?></td>
                    <td><?php echo $row['Status'];?></td>
                    <td><?php echo $row['MonthlyFee'];?></td>
                    <td><?php echo $row['LastUdpate'];?></td>
                    <td>
                        <a class="button-table" href="update-personal.php?pid=<?php echo $row['PersonalTrainingId'];?>">
                            <button class="button">Update</button></a>
                        <a class="button-table" href="manage-personal.php?personalid=<?php echo $row['PersonalTrainingId'];?>">
                            <button class="red-button" onClick="return confirm('Do you really want to delete?');">Delete</button></a>

                    </td>
                </tr>
                <?php }?>

            </tbody>
        </table>
        <a href="create-personal.php">
            <button class="button">Create New Personal Training</button></a>
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
