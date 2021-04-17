<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['currentuser'])){
$activityid = $username = $bookedon = $status = '';
if(isset($_GET['book']))
{
$activityid = $_GET['book'];
$username = $_SESSION['currentuser'];
$t=time();
$bookedon = (date("Y-m-d",$t));
$status = 'pending';
$create_booking = "insert into bookings( ActivityId , Username , BookedOn , Status ) values (:aid , :user , :booked , :status )";
$query_booking = $connection->prepare($create_booking);
$query_booking->bindParam(':aid',$activityid,PDO::PARAM_STR);
$query_booking->bindParam(':user',$username,PDO::PARAM_STR);
$query_booking->bindParam(':booked',$bookedon,PDO::PARAM_STR);
$query_booking->bindParam(':status',$status,PDO::PARAM_STR);
$query_booking->execute();
$lastInsertId = $connection->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Activity booked successfully.');</script>";

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
<body>
    <!--header start here-->
    <?php include('includes/header.php');?>
    <!--header end here-->
    <div class="content">
            <h3>Activities List</h3>
            <div>
                <div><label class="col-md-3">Show All</label>
                    <form action="services.php" method="post">
                        <button type="submit" name="searchall" class="button">Show All</button></form>
                </div>
                <label class="col-md-3">Search by date:</label>
                <form action="services.php" method="post">
                    <input type="date" name="startdate">
                    <input type="date" name="enddate">
                    <button type="submit" name="searchdate" class="button">Search</button>
                </form>
                <div> <label>Search by place:</label></div>
                <form action="services.php" method="post">
                <select class="choose" name="place"><?php $retrieve=mysqli_query($connection,"select * from activities GROUP BY ActivityLocation");
							  $cnt=1;
                    $select = "select * from activities GROUP BY ActivityLocation";
$query = $connection->prepare($select);
$query->execute(); 
while($row=$query->fetch())
							  {
							   ?>
                    <option><?php echo $row['ActivityLocation']; ?></option> <?php }?>
                </select>
                    <button type="submit" name="searchplace" class="button">Search</button>
                </form>
            </div>
            <?php if(isset($_POST['searchall']))
{
$select = "select * from activities";
$query_all = $connection->prepare($select);
$query_all->execute(); 
while($row=$query_all->fetch())
							  {

                 include ('activities-list.php');
            }
} ?>
            <?php if(isset($_POST['searchdate']))
{
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$search_by_date = "select * from activities where DateOfTheActivity between :start and :end order by DateOfTheActivity";
$query_by_date = $connection->prepare($search_by_date);
$query_by_date->bindParam(':start',$startdate,PDO::PARAM_STR);
$query_by_date->bindParam(':end',$enddate,PDO::PARAM_STR);
$query_by_date->execute(); 
while($row=$query_by_date->fetch())
							  {
                 include ('activities-list.php');
            }
} ?>
            <?php if(isset($_POST['searchplace']))
          {
$place = $_POST['place'];
$search_by_place = "select * from activities where ActivityLocation = :place "; 
$query_by_place = $connection->prepare($search_by_place);
$query_by_place->bindParam(':place',$place,PDO::PARAM_STR);
$query_by_place->execute(); 
while($row=$query_by_place->fetch())
							  {
            include ('activities-list.php');
            }}?>
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