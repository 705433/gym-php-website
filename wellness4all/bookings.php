<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['currentuser'])){
$bookingid = $user = $status = '';
if(isset($_GET['cancel-activity-booking']))
{
$bookingid = $_GET['cancel-activity-booking'];
$user = 'user';
$status = 'cancelled';
$cancel_booking = "update bookings set CancelledBy = :user , Status = :status where BookingId = :bid ";
$query = $connection->prepare($cancel_booking);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':user',$user,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking cancelled successfully.');</script>";
}
if(isset($_GET['activate-activity-booking']))
{
$bookingid = $_GET['activate-activity-booking'];
$user = 'NULL';
$status = 'pending';
$activate_booking = "update bookings set CancelledBy = :user , Status = :status where BookingId = :bid ";
$query = $connection->prepare($activate_booking);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':user',$user,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking successfully re-activated.');</script>";
}
if(isset($_GET['cancel-personal-booking']))
{
$bookingid = $_GET['cancel-personal-booking'];
$user = 'user';
$status = 'cancelled';
$cancel_personal = "update personal_bookings set CancelledBy = :user , Status = :status where BookingId = :bid ";
$query = $connection->prepare($cancel_personal);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':user',$user,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking cancelled successfully.');</script>";

}
if(isset($_GET['activate-personal-booking']))
{
$bookingid = $_GET['activate-personal-booking'];
$user = 'NULL';
$status = 'pending';
$activate_personal = "update personal_bookings set CancelledBy = :user , Status = :status where BookingId = :bid ";
$query = $connection->prepare($activate_personal);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':user',$user,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking successfully re-activated.');</script>";

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
    <div id="activities" class="content">


        <h3>Bookings For Activities</h3>

        <button class="button"><a href="#personal">Go To Bookings For Personal Training</a></button>

        <?php
        $user = $_SESSION['currentuser'];
$select_bookings = "SELECT * FROM bookings where username = :username";
$query_bookings = $connection->prepare($select_bookings);
$query_bookings->bindParam(':username',$user,PDO::PARAM_STR);
$query_bookings->execute(); 
							  while($bookings_row=$query_bookings->fetch())
							  {?>
        <hr>
        <div class="container">
            <div class="col-2">
                <?php  
$select_activity = "select * from activities where ActivityId = :actid ";
$query_activities = $connection->prepare($select_activity);
$activity_id = $bookings_row['ActivityId'];
$query_activities->bindParam(':actid',$activity_id,PDO::PARAM_STR);
$query_activities->execute(); 
$activity_row=$query_activities->fetch(PDO::FETCH_ASSOC);
        ?>
                <div> <img alt="image" class="list-pic" src="img/<?php echo $activity_row['ActivityImage']; ?>"></div>
                <div class="list-desc">
                    <div>BookingId: <?php echo $bookings_row['BookingId'];?> </div>
                    <div>Activity ID: <?php echo $bookings_row['ActivityId'];?></div>
                    <div>Name: <?php echo $activity_row['ActivityName'];?> </div>
                    <div>Type: <?php echo $activity_row['ActivityType'];?></div>
                    <div>Location: <?php echo $activity_row['ActivityLocation'];?></div>
                    <div>Date: <?php echo $activity_row['DateOfTheActivity'];?></div>
                    <div>Time: <?php echo $activity_row['TimeOfTheActivity'];?></div>
                    <div>Price: <?php echo $activity_row['ActivityPrice'];?></div>
                    <div>Description: <?php echo $activity_row['ActivityDescription'];?></div>
                    <div>BookedOn: <?php echo $bookings_row['BookedOn'];?></div>
                    <div>Status: <?php echo $bookings_row['Status'];?></div>
                    <?php if($bookings_row['Status']=='cancelled'){?>
                    <a href="bookings.php?activate-activity-booking=<?php echo $bookings_row['BookingId'];?>">
                        <button class="button">Re-activate</button></a>
                    <?php  }else{
               ?>
                    <a href="bookings.php?cancel-activity-booking=<?php echo $bookings_row['BookingId'];?>">
                        <button class="button">Cancel</button></a> <?php } ?>
                </div>
            </div>
        </div>
        <?php }?>
        <div id="personal" class="content">
            <h3>Bookings For Personal Training</h3>
            <button class="button"><a href="#activities">Go To Bookings For Activities</a></button>
            <?php
    
$select_bookings = "select * from personal_bookings where username = :username";
$query_bookings = $connection->prepare($select_bookings);
$query_bookings->bindParam(':username',$user,PDO::PARAM_STR);
$query_bookings->execute(); 
while($bookings_row=$query_bookings->fetch())
							  {?>
            <hr>
            <div class="container">
                <div class="col-2">
                    <?php 
$select_personal = "select * from personal where PersonalTrainingId = :pid ";
$query_personal = $connection->prepare($select_personal);
$personal_id = $bookings_row['PersonalTrainingId'];
$query_personal->bindParam(':pid',$personal_id,PDO::PARAM_STR);
$query_personal->execute(); 
$personal_row=$query_personal->fetch(PDO::FETCH_ASSOC);
        ?>
                    <div> <img alt="image" class="list-pic" src="img/dumbells.jpg"></div>
                    <div class="list-desc">
                        <div>BookingId: <?php echo $bookings_row['BookingId'];?> </div>
                        <div>Personal Training ID: <?php echo $bookings_row['PersonalTrainingId'];?></div>
                        <div>Name: <?php echo $personal_row['PersonalTrainingName'];?> </div>
                        <div>Description: <?php echo $personal_row['Description'];?></div>
                        <div>Days Of The Week: <?php echo $personal_row['DaysOfTheWeek'];?></div>
                        <div>Time: <?php echo $personal_row['Time'];?></div>
                        <div>Length Of Session: <?php echo $personal_row['LengthOfSession'];?></div>
                        <div>Monthly Fee: <?php echo $personal_row['MonthlyFee'];?></div>
                        <div>BookedOn: <?php echo $bookings_row['BookedOn'];?></div>
                        <div>Status: <?php echo $bookings_row['Status'];?></div>
                        <div>Payment: <?php echo $bookings_row['Payment'];?></div>
                        <?php if($bookings_row['Status']=='cancelled'){?>
                        <a href="bookings.php?activate-personal-booking=<?php echo $bookings_row['BookingId'];?>">
                            <button class="button">Re-activate</button></a>
                        <?php  }else{
               ?>
                        <a href="bookings.php?cancel-personal-booking=<?php echo $bookings_row['BookingId'];?>">
                            <button class="button">Cancel</button></a> <?php } ?>
                   </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</body>
<!---Footer Section--->
<div>
    <?php include('includes/footer.php');?>
</div>
</html>
<?php }else{
         $_SESSION['msg']="Please login.";
header("Location: msg.php");
} ?>