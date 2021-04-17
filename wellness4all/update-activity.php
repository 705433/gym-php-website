<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_POST['update']))
{
$aid=$_GET['aid'];
$activityname = $_POST['activityname'];
$activitytype = $_POST['activitytype'];
$activitylocation = $_POST['activitylocation'];
$dateoftheactivity = $_POST['dateoftheactivity'];
$timeoftheactivity = $_POST['timeoftheactivity'];
$activityprice = $_POST['activityprice'];
$activitydescription = $_POST['activitydescription'];
$activityimage = $_POST['activityimage'];
$t=time();
$lastupdated = (date("Y-m-d",$t));
$status = $_POST['status'];
$update_activity = "UPDATE activities SET ActivityName = :aname , ActivityType = :atype, ActivityLocation = :alocation, DateOfTheActivity = :adate, TimeOfTheActivity = :atime, ActivityPrice = :aprice, ActivityDescription = :adesc, ActivityImage = :aimage, LastUpdated = :alast , Status = :astatus where ActivityId = :aid ";
$query = $connection->prepare($update_activity);
    $query->bindParam(':aname',$activityname,PDO::PARAM_STR);
    $query->bindParam(':atype',$activitytype,PDO::PARAM_STR);
    $query->bindParam(':alocation',$activitylocation,PDO::PARAM_STR);
    $query->bindParam(':adate',$dateoftheactivity,PDO::PARAM_STR);
    $query->bindParam(':atime',$timeoftheactivity,PDO::PARAM_STR);
    $query->bindParam(':aprice',$activityprice,PDO::PARAM_STR);
    $query->bindParam(':adesc',$activitydescription,PDO::PARAM_STR);
    $query->bindParam(':aimage',$activityimage,PDO::PARAM_STR);
    $query->bindParam(':alast',$lastupdated,PDO::PARAM_STR);
    $query->bindParam(':astatus',$status,PDO::PARAM_STR);
    $query->bindParam(':aid',$aid,PDO::PARAM_STR);
    $query->execute(); 
echo "<script>alert('Activity updated successfully.');</script>";
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
    $activity_chosen = $_GET['aid'];
    $select = "select * from activities where ActivityId = :aid";
                $query = $connection->prepare($select);
                $query->bindParam(':aid',$activity_chosen,PDO::PARAM_STR);
                $query->execute(); 
                while($row=$query->fetch())
							  {?>
    <!--header end here-->
    <div class="content">

        <h2>Update Activity</h2>
        <form method="post">
            
            <div class="form-group">
                <label>Activity Name</label>
                <input type="text" name="activityname" value="<?php echo htmlentities($row['ActivityName']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Type</label>
                <input type="text" name="activitytype" value="<?php echo htmlentities($row['ActivityType']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Location</label>
                <input type="text" name="activitylocation" value="<?php echo htmlentities($row['ActivityLocation']);?>"  class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Date</label>
                <input type="date" name="dateoftheactivity" value="<?php echo htmlentities($row['DateOfTheActivity']);?>"  class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Time</label>
                <input type="time" name="timeoftheactivity" value="<?php echo htmlentities($row['TimeOfTheActivity']);?>"  class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Price</label>
                <input type="text" name="activityprice" value="<?php echo htmlentities($row['ActivityPrice']);?>"  class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Description</label>
                <input type="text" name="activitydescription" value="<?php echo htmlentities($row['ActivityDescription']);?>"  class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Image</label>
                <input type="text" name="activityimage" value="<?php echo htmlentities($row['ActivityImage']);?>"  class="form" required>
            </div>
            <div class="form-group">
                <label>Satus</label>
                 <select class="choose" name="status">
    <option value="active">Active</option>
    <option value="not active">Not Active</option>
  </select>
            
            </div>
            
             <button type="submit" name="update" class="submit">Update</button>
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
