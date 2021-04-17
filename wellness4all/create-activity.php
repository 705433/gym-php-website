<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_POST['create']))
{
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

$create_activity = "insert into activities(ActivityName , ActivityType , ActivityLocation , DateOfTheActivity , TimeOfTheActivity , ActivityPrice , ActivityDescription , ActivityImage , LastUpdated, Status) values (:aname , :atype , :alocation , :adate , :atime , :aprice , :adesc , :aimage , :alast , :astatus )";
$query = $connection->prepare($create_activity);
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
    $query->execute(); 
header("location: manage-activities.php");
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Wellness4All | Admin</title>
    <?php include('includes/head.php');?>
</head>

<body>
    <!--header start here-->
    <?php include('includes/header.php');?>
    <!--header end here-->
    <div class="content">
        <h2>Create New Activity</h2>
        <div class="form-border">
        <form method="post">
            <ul>
            <div class="form-group">
                <label>Activity Name</label>
                <input type="text" name="activityname" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Type</label>
                <input type="text" name="activitytype" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Location</label>
                <input type="text" name="activitylocation" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Date</label>
                <input type="date" name="dateoftheactivity" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Time</label>
                <input type="time" name="timeoftheactivity" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Price</label>
                <input type="text" name="activityprice" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Description</label>
                <input type="text" name="activitydescription" class="form" required>
            </div>
            <div class="form-group">
                <label>Activity Image</label>
                <input type="text" name="activityimage" class="form" required>
            </div>
            <div class="form-group">
                <label>Satus</label>
                 <select class="choose" name="status"  >
    <option value="active">Active</option>
    <option value="not active">Not Active</option>
  </select>
            </div>
            <button type="submit" name="create" class="submit">Create</button>
            </ul>
        </form>
 </div>
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
