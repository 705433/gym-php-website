<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_POST['update']))
{
$pid=$_GET['pid'];
$personal_name = $_POST['personaltrainingname'];
$descritpion = $_POST['description'];
$days = $_POST['daysoftheweek'];
$time = $_POST['time'];
$length = $_POST['lengthofsession'];
$status = $_POST['status'];
$fee = $_POST['monthlyfee'];
$update_personal = "UPDATE personal SET PersonalTrainingName = :pname , Description = :pdesc, DaysOfTheWeek = :pdays, Time = :ptime, LengthOfSession = :plength, Status = :pstatus, MonthlyFee = :pfee where PersonalTrainingId = :pid ";
$query = $connection->prepare($update_personal);
$query->bindParam(':pname',$personal_name,PDO::PARAM_STR);
$query->bindParam(':pdesc',$descritpion,PDO::PARAM_STR);
$query->bindParam(':pdays',$days,PDO::PARAM_STR);
$query->bindParam(':ptime',$time,PDO::PARAM_STR);
$query->bindParam(':plength',$length,PDO::PARAM_STR);
$query->bindParam(':pstatus',$status,PDO::PARAM_STR);
$query->bindParam(':pfee',$fee,PDO::PARAM_STR);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->execute();
header("location: manage-personal.php");
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
    $personal_chosen = $_GET['pid'];
   $show_personal = "select * from personal where PersonalTrainingId = :personal";    
$query = $connection->prepare($show_personal);
$query->bindParam(':personal',$personal_chosen,PDO::PARAM_STR);
$query->execute(); 
while($row=$query->fetch())
   
							  {
    ?>
    <!--header end here-->
    <div class="content">

        <h4>Update Personal Training Membership</h4>
        <form method="post">

            <div class="form-group">
                <label>Personal Training Name</label>
                <input type="text" name="personaltrainingname" value="<?php echo htmlentities($row['PersonalTrainingName']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Descritpion</label>
                <input type="text" name="description" value="<?php echo htmlentities($row['Description']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Days Of The Week</label>
                <input type="text" name="daysoftheweek" value="<?php echo htmlentities($row['DaysOfTheWeek']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Time</label>
                <input type="time" name="time" value="<?php echo htmlentities($row['Time']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Length Of The Session</label>
                <input type="text" name="lengthofsession" value="<?php echo htmlentities($row['LengthOfSession']);?>" class="form" required>
            </div>
            <div class="form-group">
                <label>Satus</label>
                <select class="choose" name="status">
                    <option value="active">Active</option>
                    <option value="not active">Not Active</option>
                </select>

            </div>
            <div class="form-group">
                <label>Monthly Fee</label>
                <input type="text" name="monthlyfee" value="<?php echo htmlentities($row['MonthlyFee']);?>" class="form" required>
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
