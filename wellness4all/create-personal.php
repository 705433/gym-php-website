<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_POST['create']))
{
$personal = $_POST['personalname'];
$description = $_POST['description'];
$days = $_POST['daysoftheweek'];
$time = $_POST['timeofsession'];
$length = $_POST['lengthofsession'];
$status = $_POST['status'];
$fee = $_POST['monthlyfee'];
$create_personal = "insert into personal(PersonalTrainingName , Description , 	DaysOfTheWeek , Time , LengthOfSession , Status , MonthlyFee) values (:pname , :pdesc , :pdays , :ptime , :plength , :pstatus , :pfee)";
$query = $connection->prepare($create_personal);
$query->bindParam(':pname',$personal,PDO::PARAM_STR);
$query->bindParam(':pdesc',$description,PDO::PARAM_STR);
$query->bindParam(':pdays',$days,PDO::PARAM_STR);
$query->bindParam(':ptime',$time,PDO::PARAM_STR);
$query->bindParam(':plength',$length,PDO::PARAM_STR);
$query->bindParam(':pstatus',$status,PDO::PARAM_STR);
$query->bindParam(':pfee',$fee,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $connection->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Personal training created.');</script>";
}else{
echo "<script>alert('Something went wrong, please try again.');</script>";
}
}
?>
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
        <h4>Create New Personal Training Membership</h4>
        <div class="form-border">
            <form method="post">
                <ul>
                    <div class="form-group">
                        <label>Personal Training Name</label>
                        <input type="text" name="personalname" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div><textarea name="description" cols="40" rows="10"></textarea></div>
                    </div>
                    <div class="form-group">
                        <label>Days Of The Week</label>
                        <input type="text" name="daysoftheweek" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="timeofsession" class="form" required>
                    </div>
                    <div class="form-group">
                        <label>Length Of Session</label>
                        <input type="text" name="lengthofsession" class="form" required>
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
                        <input type="text" name="monthlyfee" class="form" required>
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
