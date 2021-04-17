<?php
if (!isset($_SESSION)) {session_start();}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
include ('includes/head.php');
?>

</head>

<body class="landing_background">
    <?php include('includes/header.php');?>
    <div class="content">
        <div class="workout">
            <figure>
                <img alt="workout" class="medium-pic" src="img/workout.jpg">
            </figure>
        </div>
        <h3> <?php echo htmlentities($_SESSION['msg']);?></h3>
    </div>

</body>
<div>
    <?php include('includes/footer.php');?>
</div>
<!---Modals Section--->

<div class="lg-modal">
    <div class="lg-modal-content">
        <div class="close"><button onclick="hideLgModal()" class="button">Close</button></div>
        <?php include('includes/login.php');?>
    </div>
</div>
<div class="rg-modal">
    <div class="rg-modal-content">
        <div class="close"><button onclick="hideRgModal()" class="button">Close</button></div>
        <?php include('includes/registration.php');?>
    </div>
</div>

</html>
