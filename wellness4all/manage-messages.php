<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Wellness4All | Admin</title>
    <?php include('includes/head.php');?>
</head>

<body class="body_background">
    <!--header start here-->
    <?php include('includes/header.php');?>
    <!--header ends here-->
    <div class="content">

        <table class="table-list">
            <h4> User Messages</h4>
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email Id</th>
                    <th>Message</th>
                    <th>Sent On</th>
                    <th>Replied</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
$select = "select * from messages";
$query= $connection->prepare($select);
$query->execute();
                              while($row=$query->fetch())
							  {?>
                <tr>
                    <td><?php echo $row['Serial'];?></td>
                    <td><?php if($row['Username']!=null){echo $row['Username'];}else{echo "User not logged in";}?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['Email'];?></td>
                    <td><?php echo $row['Message'];?></td>
                    <td><?php echo $row['SentOn'];?></td>
                    <td><?php if($row['Reply']!=null){echo "Yes";}else{echo "No";}?></td>
                    <td>
                        <?php if($row['Reply']==null && $row['Username']==null){ echo "You can reply to this message only via e-mail.";?>
                        <?php }elseif($row['Reply']==null && $row['Username']!=null){ ?>
                        <a class="button-table" href="reply-messages.php?reply=<?php echo $row['Serial'];?>">
                            <button class="button">Reply</button></a> <?php } elseif($row['Reply']!=null){echo "Done";} ?>
                    </td>
                </tr>
                <?php }?>

            </tbody>
        </table>

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
