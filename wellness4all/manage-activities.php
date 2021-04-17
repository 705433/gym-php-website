<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_GET['activityid']))
{
$admindel=$_GET['activityid'];
$delete_activity = "delete from activities where ActivityId = :aid";
$query = $connection->prepare($delete_activity);
$query->bindParam(':aid',$admindel,PDO::PARAM_STR);
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
            <h4>Manage Activities</h4>
            <thead>
                <tr>
                    <th>Activity Id</th>
                    <th>Activity Name</th>
                    <th>Activity Type</th>
                    <th>Activity Location</th>
                    <th>Activity Date</th>
                    <th>Activity Time</th>
                    <th>Activity Price</th>
                    <th>Activity Description</th>
                    <th>Activity Image</th>
                    <th>Last Updated</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
        $select_bookings = "select * from activities";
$query_bookings = $connection->prepare($select_bookings);
$query_bookings->execute(); 
while($row=$query_bookings->fetch())
							  {?>
                <tr>
                    <td><?php echo $row['ActivityId'];?></td>
                    <td><?php echo $row['ActivityName'];?></td>
                    <td><?php echo $row['ActivityType'];?></td>
                    <td><?php echo $row['ActivityLocation'];?></td>
                    <td><?php echo $row['DateOfTheActivity'];?></td>
                    <td><?php echo $row['TimeOfTheActivity'];?></td>
                    <td><?php echo $row['ActivityPrice'];?></td>
                    <td><?php echo $row['ActivityDescription'];?></td>
                    <td><img alt="image" class="list-pic" src="img/<?php echo $row['ActivityImage'];?>"></td>
                    <td><?php echo $row['LastUpdated'];?></td>
                    <td><?php echo $row['Status'];?></td>
                    <td>

                        <a class="button-table" href="update-activity.php?aid=<?php echo $row['ActivityId'];?>">
                            <button class="button">Update</button></a>
                        <a class="button-table" href="manage-activities.php?activityid=<?php echo $row['ActivityId'];?>">
                            <button class="red-button" onClick="return confirm('Do you really want to delete?');">Delete</button></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <a href="create-activity.php">
            <button class="button">Create New</button></a>
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
