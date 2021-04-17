<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
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
        <h4>Admin Dashboard</h4>
        <div class="form-border"> <?php 
$select = "SELECT * FROM usertable";
$query = $connection->prepare($select);
$query->execute(); 
$users_number=$query->rowCount();
echo htmlentities ("Total number of users: ". $users_number);
                         ?>
            <div> <a href="manage-users.php"><button class="button">Manage users</button></a></div>
            <hr>
            <div>
                <?php 
$select_active = "SELECT * FROM activities WHERE status = 'active' ";
$select_not_active = "SELECT * FROM activities WHERE status = 'not active' ";
$query_active = $connection->prepare($select_active);
$query_not_active = $connection->prepare($select_not_active);
$query_active->execute(); 
$query_not_active->execute(); 
$active_number=$query_active->rowCount();
$not_active_number=$query_not_active->rowCount();
echo htmlentities ("Total number of active activities: ". $active_number);
echo "<br>";    
echo htmlentities ("Total number of not active activities: ". $not_active_number);
                              ?>
                <div> <a href="manage-activities.php"><button class="button">Manage activities</button></a></div>
            </div>
            <div>
                <hr>
                <?php 
$select_bookings = "SELECT * FROM bookings";
$query_bookings = $connection->prepare($select_bookings);
$query_bookings->execute(); 
$bookings_number=$query_bookings->rowCount();
echo htmlentities ("Total number of bookings: ". $bookings_number);
                              ?>
                <div><a href="manage-activities.php"><button class="button">Manage bookings</button></a></div>
            </div>

            <div>
                <hr>
                <?php 
$select_messages = "SELECT * FROM messages";
$query_messages = $connection->prepare($select_messages);
$query_messages->execute(); 
$messages_number=$query_messages->rowCount();
echo htmlentities ("Total number of messages: ". $messages_number);
                              ?>
                <div><a href="manage-messages.php"><button class="button">Manage messages</button></a></div>
            </div>
            <div>
                <hr>
                <?php 
$select_personal = "SELECT * FROM personal";
$query_personal = $connection->prepare($select_personal);
$query_personal->execute(); 
$personal_number=$query_personal->rowCount();
echo htmlentities ("Total number of personal training memberships: ". $personal_number);                                           
                ?>
                <div><a href="manage-personal.php"><button class="button">Manage personal training memberships</button></a></div>
            </div>
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
