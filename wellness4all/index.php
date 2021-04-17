<?php
if (!isset($_SESSION)) {session_start();}
include('includes/config.php');
?>
<html>

<head>
    <?php
include ('includes/head.php');
?>
</head>

<body class="body_background">
    <?php include('includes/header.php');?>
    <div class="content">
        <?php
if(isset ($_SESSION['currentuser'])){
    ?>
        <h4>Welcome </h4>
        <h4> <?php echo $_SESSION['currentuser'];?> </h4>

        <div class="col-3">
            <div><img alt="female-training" class="medium-pic" src="img/training_index.jpg"></div>
            <div class="menu" style="border:none;">
                <h4>Where to next?:</h4>
                <ul>
                    <li><a href="services.php"><b>Sports Services</b></a></li>
                    <li><a href="bookings.php"><b>Bookings</b></a></li>
                    <li><a href="personal.php"><b>Personal Training</b></a></li>
                    <li><a href="contact-us.php"><b>Contact Us</b></a></li>
                </ul>
            </div>
            <div><img alt="man-training" class="medium-pic" src="img/fitness_man_index.jpg"></div>
        </div>
        <table class="table-list">
            <h4>Messages</h4>
            <thead>
                <tr>
                    <th>Message</th>
                    <th>Sent On</th>
                    <th>Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php
    $user = $_SESSION['currentuser'];
$select = "select * from messages where Username = :username";
$query= $connection->prepare($select);
$query->bindParam(':username',$user,PDO::PARAM_STR);
$query->execute();
                              while($row=$query->fetch())
							  {?>
                <tr>
                    <td><?php echo $row['Message'];?></td>
                    <td><?php echo $row['SentOn'];?></td>
                    <td><?php if ($row['Reply']==null){echo "Pending";}else{echo $row['Reply'];}?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <a href="contact-us.php"><button class="button">Send new message</button></a>
        <?php
}else{
        ?><h4>Welcome to Wellness4All</h4>
        <div class="container">
            <p class="landing-message">Wellness4All is UK based gym providing various services to its customers such as sports services and personal training. The activities include swimming pool, indoor running tracks, tennis, football and boxing. </p>
        </div>
        <div><img alt="woman-training" class="offer" src="img/weights2.jpg"></div>
        <br>
        <div class="col-2">
            <div><img alt="stretch" class="medium-pic" src="img/stretch_index.jpg"></div>
            <div><img alt="join" class="medium-pic" src="img/joinus.jpg"></div>
        </div>
        <h4>Sign up or login to access our services.</h4>
        <h4>Signing up is free and quick!</h4>
        <div class="col-2">
            <div><img alt="female-training" class="medium-pic" src="img/training_index.jpg"></div>
            <div><img alt="man-training" class="medium-pic" src="img/fitness_man_index.jpg"></div>
        </div>
        <?php }?>
    </div>
</body>
<hr>
<div class="footer-position">
    <?php include('includes/footer.php');?>
</div>
<!---Modals Section--->
<?php include('includes/modal.php');?>

</html>
