<hr>
<?php  
$select_activity = "select BookingId from bookings where ActivityId = :aid and Username = :user";
$query_booking = $connection->prepare($select_activity);
$activity_id = $row['ActivityId'];
$username = $_SESSION['currentuser'];
$query_booking->bindParam(':aid',$activity_id,PDO::PARAM_STR);
$query_booking->bindParam(':user',$username,PDO::PARAM_STR);
$query_booking->execute();
$activity_row=$query_booking->fetch(PDO::FETCH_ASSOC); ?>
<div class="container">
    <div class="col-2">
        <div><img alt="image" class="list-pic" src="img/<?php echo $row['ActivityImage'];?>"></div>
        <div class="list-desc">
            <div>Name: <?php echo $row['ActivityName'];?> </div>
            <div>Type: <?php echo $row['ActivityType'];?></div>
            <div>Location: <?php echo $row['ActivityLocation'];?></div>
            <div>Date Of The Activity: <?php echo $row['DateOfTheActivity'];?></div>
            <div>Time: <?php echo $row['TimeOfTheActivity'];?></div>
            <div>Price: <?php echo $row['ActivityPrice'];?></div>
            <div>Description: <?php echo $row['ActivityDescription'];?></div>
            <?php if(empty($activity_row)){ ?><a href="services.php?book=<?php echo $row['ActivityId'];?>">
                <button class="button">Book</button></a>
            <?php }else {echo 'Already booked';} ?>
        </div>
    </div>
</div>
