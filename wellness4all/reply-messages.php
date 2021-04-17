<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
if(isset($_POST['send'])){
if(isset($_GET['reply']))
{
$message_serial=$_GET['reply'];
$admin_reply=$_POST['reply-message'];
$reply = "UPDATE messages SET Reply = :reply where Serial = :serial";
$query = $connection->prepare($reply);
$query->bindParam(':reply',$admin_reply,PDO::PARAM_STR);
$query->bindParam(':serial',$message_serial,PDO::PARAM_STR);
$query->execute();
if($query)
{
echo "<script>alert('Message sent.');</script>";
}
}
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Wellness4All | Admin</title>
    <?php include('includes/head.php');?>
</head>

<body class="body-background">
    <!--header start here-->
    <?php include('includes/header.php');?>
    <!--header ends here-->
    <div class="content">
                         <?php
    $message_chosen = $_GET['reply'];
$select = "select * from messages where Serial= :serial";
$query= $connection->prepare($select);
$query->bindParam(':serial',$message_chosen,PDO::PARAM_STR);
$query->execute();
                              while($row=$query->fetch())
							  {?>
        <div class="form-border">
            <form method="post">
                <div>
                    <h3>Reply To User Message</h3>
                </div>
                <div class="form-group">
                    <label>Serial:</label>
                    <div name="serial" value="<?php echo $row['Serial'];?>"><?php echo $row['Serial'];?></div>
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <?php if($row['Username']!=null){echo $row['Username'];}else{echo "User not logged in";}?>
                </div>
                <div class="form-group">
                    <label>Name: </label>
                    <?php echo $row['Name'];?>
                </div>
                <div class="form-group"> <label>E-Mail: </label>
                    <?php echo $row['Email'];?></div>
                <div class="form-group"> <label>Message: </label>
                    <?php echo $row['Message'];?></div>
                <div class="form-group"> <label>Reply:</label>
                    <div></div>
                    <textarea name="reply-message" cols="40" rows="10"></textarea> </div>
                <div class="form-group"> <button class="button" type="submit" name="send">Send Message</button></div>
            </form>
        </div>
          <?php  }?>
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
