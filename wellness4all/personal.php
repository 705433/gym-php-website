    <?php
session_start();
include('includes/config.php');
if(isset($_SESSION['currentuser'])){
if(isset($_GET['bookpersonal']))
{
$personal_id = $_GET['bookpersonal'];
$username = $_SESSION['currentuser'];
$t=time();
$bookedon = (date("Y-m-d",$t));
$status = 'pending';
$show_fee = "select MonthlyFee from personal where PersonalTrainingId = :pid ";
$fee_query = $connection->prepare($show_fee);
$fee_query->bindParam(':pid',$personal_id,PDO::PARAM_STR);
$fee_query->execute(); 
$fee_row=$fee_query->fetch(PDO::FETCH_ASSOC);
$fee = $fee_row['MonthlyFee'];
$payment = 'due';
$create_booking = "insert into personal_bookings( PersonalTrainingId , Username , BookedOn , Status , MonthlyFee , Payment ) values (:pid , :user , :booked , :status , :fee , :pay )";
$query = $connection->prepare($create_booking);
$query->bindParam(':pid',$personal_id,PDO::PARAM_STR);
$query->bindParam(':user',$username,PDO::PARAM_STR);
$query->bindParam(':booked',$bookedon,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':fee',$fee,PDO::PARAM_STR);
$query->bindParam(':pay',$payment,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $connection->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Personal training booked successfully.');</script>";
}else{
echo "<script>alert('Something went wrong, please try again.');</script>";
}
}
?>
<html>
<head>
    <title>Wellness4All</title>
    <?php include('includes/head.php');?>
</head>
<body class="body_background">
    <!--header start here-->
    <?php include('includes/header.php');?>
    <!--header end here-->
    <div class="content">


            <h3>Personal Trainings List</h3>
        <div><img alt="dumbells" class="medium-pic" src="img/dumbells.jpg"></div>
 <div>    <hr>        
            <?php 
$show_personal = "select * from personal where Status = :active";    
$query = $connection->prepare($show_personal);
$status = 'active';
$query->bindParam(':active',$status,PDO::PARAM_STR);
$query->execute(); 
while($row=$query->fetch()){?>
                 
    <?php  
$select_personal = "select BookingId from personal_bookings where PersonalTrainingId = :pid and Username = :user";
$query_personal = $connection->prepare($select_personal);
$personal_id = $row['PersonalTrainingId'];
$username = $_SESSION['currentuser'];
$query_personal->bindParam(':pid',$personal_id,PDO::PARAM_STR);
$query_personal->bindParam(':user',$username,PDO::PARAM_STR);
$query_personal->execute();
$personal_row=$query_personal->fetch(PDO::FETCH_ASSOC); ?>
      <div class="form-border">
<div class="container">
                <div>Name: <?php echo $row['PersonalTrainingName'];?> </div>
                <div>Description: <?php echo $row['Description'];?></div>
                <div>Days Of The Week: <?php echo $row['DaysOfTheWeek'];?></div>
                <div>Time: <?php echo $row['Time'];?></div>
                <div>Length Of The Session: <?php echo $row['LengthOfSession'];?></div>
                <div>Monthly Fee: <?php echo $row['MonthlyFee'];?></div>
                <?php if(empty($personal_row)){ ?><a href="personal.php?bookpersonal=<?php echo $row['PersonalTrainingId'];?>">
                <button class="button">Book</button></a> <?php }else {echo 'Already booked';} ?></div></div>
     
         <?php    }
 ?>
      </div>      
   </div>
</body>
    <div>
    <?php include('includes/footer.php');?>
</div>
</html>
<?php }else{
         $_SESSION['msg']="Please login.";
header("Location: msg.php");
} ?>