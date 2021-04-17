<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_GET['confirm-activity-booking']))
{
$bookingid = $_GET['confirm-activity-booking'];
$status = 'confirmed';
$cancelled = 'Not cancelled';
$activate_booking = "update bookings set CancelledBy = :cxl , Status = :status where BookingId = :bid ";
$query = $connection->prepare($activate_booking);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':cxl',$cancelled,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking confirmed.');</script>";
}
if(isset($_GET['cancel-activity-booking']))
{
$bookingid = $_GET['cancel-activity-booking'];
$admin = 'admin';
$status = 'cancelled';
$cancel_booking = "update bookings set CancelledBy = :admin , Status = :status where BookingId = :bid ";
$query = $connection->prepare($cancel_booking);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':admin',$admin,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking cancelled.');</script>";
}
if(isset($_GET['confirm-personal-booking']))
{
$bookingid = $_GET['confirm-personal-booking'];
$status = 'confirmed';
$payment = 'paid';
$cancelled = 'Not cancelled';
$confirm_personal = "update personal_bookings set CancelledBy = :cxl , Status = :status where BookingId = :bid ";
$query = $connection->prepare($confirm_personal);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':cxl',$cancelled,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking confirmed.');</script>";
}
if(isset($_GET['cancel-personal-booking']))
{
$bookingid = $_GET['cancel-personal-booking'];
$admin = 'admin';
$status = 'cancelled';
$cancel_personal = "update personal_bookings set CancelledBy = :admin , Status = :status where BookingId = :bid ";
$query = $connection->prepare($cancel_personal);
$query->bindParam(':bid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':admin',$admin,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute(); 
echo "<script>alert('Booking cancelled.');</script>";
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
    <div id="activities" class="content">
        <h4>User Bookings For Activities</h4>
        <button class="button"><a href="#personal">Go To Bookings For Personal Training</a></button>
        <br><br>
        <table class="table-list">
            <thead>
                <tr>
                    <th>Booking Id</th>
                    <th>Activity Id</th>
                    <th>Username</th>
                    <th>Booked On</th>
                    <th>Booking Status</th>
                    <th>Cancelled</th>
                    <th>Last Update</th>
                    <th>Activity Name</th>
                    <th>Activity Date</th>
                    <th>Time Of The Activity</th>
                    <th>Activity Price</th>
                    <th>Activity Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $select_bookings = "SELECT * FROM bookings";
$query_bookings = $connection->prepare($select_bookings);
$query_bookings->execute(); 
							  while($bookings_row=$query_bookings->fetch())
							  {
$select_activity = "select * from activities where ActivityId = :actid ";
$query_activities = $connection->prepare($select_activity);
$activity_id = $bookings_row['ActivityId'];
$query_activities->bindParam(':actid',$activity_id,PDO::PARAM_STR);
$query_activities->execute(); 
$activity_row=$query_activities->fetch(PDO::FETCH_ASSOC);
        ?>
                <tr>
                    <td><?php echo $bookings_row['BookingId'];?></td>
                    <td><?php echo $bookings_row['ActivityId'];?></td>
                    <td><?php echo $bookings_row['Username'];?></td>
                    <td><?php echo $bookings_row['BookedOn'];?></td>
                    <td><?php echo $bookings_row['Status'];?></td>
                    <td><?php if($bookings_row['CancelledBy']=='null'){echo "Not cancelled";}else{echo $bookings_row['CancelledBy'];} ?></td>
                    <td><?php echo $bookings_row['LastUdpate'];?></td>
                    <td><?php echo $activity_row['ActivityName'];?></td>
                    <td><?php echo $activity_row['DateOfTheActivity'];?></td>
                    <td><?php echo $activity_row['TimeOfTheActivity'];?></td>
                    <td><?php echo $activity_row['ActivityPrice'];?></td>
                    <td><?php echo $activity_row['Status'];?></td>
                    <td>
                        <a class="button-table" href="manage-bookings.php?confirm-activity-booking=<?php echo $bookings_row['BookingId'];?>">
                            <button class="button">Confirm</button></a>
                        <a class="button-table" href="manage-bookings.php?cancel-activity-booking=<?php echo $bookings_row['BookingId'];?>">
                            <button class="red-button">Cancel</button></a>
                    </td>
                    <?php }?>
                </tr>
            </tbody>
        </table>
        <div id="personal" class="content">
            <h4>User Bookings For Personal Training</h4>
            <button class="button"><a href="#activities">Go To Bookings For Activities</a></button>
            <br><br>
            <table class="table-list">
                <thead>
                    <tr>
                        <th>Booking Id</th>
                        <th>Personal Training Id</th>
                        <th>Username</th>
                        <th>Booked On</th>
                        <th>Booking Status</th>
                        <th>Cancelled</th>
                        <th>Last Update</th>
                        <th>Personal Training Name</th>
                        <th>Days Of The Week</th>
                        <th>Time</th>
                        <th>Session Length</th>
                        <th>Monthly Fee</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
    $select_bookings = "select * from personal_bookings";
$query_bookings = $connection->prepare($select_bookings);
$query_bookings->execute(); 
while($bookings_row=$query_bookings->fetch())
{ 
 $select_pesronal = "select * from personal where PersonalTrainingId = :pid ";
$query_personal = $connection->prepare($select_pesronal);
$personal_id = $bookings_row['PersonalTrainingId'];
$query_personal->bindParam(':pid',$personal_id,PDO::PARAM_STR);
$query_personal->execute(); 
$personal_row=$query_personal->fetch(PDO::FETCH_ASSOC);
        ?>
                    <tr>
                        <td><?php echo $bookings_row['BookingId'];?></td>
                        <td><?php echo $bookings_row['PersonalTrainingId'];?></td>
                        <td><?php echo $bookings_row['Username'];?></td>
                        <td><?php echo $bookings_row['BookedOn'];?></td>
                        <td><?php echo $bookings_row['Status'];?></td>
                        <td><?php if($bookings_row['CancelledBy']==null){echo "Not cancelled";}else{echo $bookings_row['CancelledBy'];} ?></td>
                        <td><?php echo $bookings_row['LastUdpate'];?></td>
                        <td><?php echo $personal_row['PersonalTrainingName'];?></td>
                        <td><?php echo $personal_row['DaysOfTheWeek'];?></td>
                        <td><?php echo $personal_row['Time'];?></td>
                        <td><?php echo $personal_row['LengthOfSession'];?></td>
                        <td><?php echo $personal_row['MonthlyFee'];?></td>
                        <td><?php echo $bookings_row['Payment'];?></td>
                        <td>
                            <a class="button-table" href="manage-bookings.php?confirm-personal-booking=<?php echo $bookings_row['BookingId'];?>">
                                <button class="button">Confirmed/Paid</button></a>
                            <a class="button-table" href="manage-bookings.php?cancel-personal-booking=<?php echo $bookings_row['BookingId'];?>">
                                <button class="red-button">Cancel</button></a>
                        </td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>

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
