<?php
session_start();
?>
<html>
<head>
    <?php
include ('includes/head.php');
?>
</head>
<!---Body Section--->
<body class="body_background">
    <?php include('includes/header.php');?>
    <div class="content">
        <h2 class="click">We are Wellness4All</h2>
        <div class="col-2">
            <div><img alt="gym-man" class="medium-pic" src="img/fitness_man.jpg"></div>
            <div><img alt="dumbells" class="medium-pic" src="img/dumbells.jpg"></div>
        </div>
        <div class="about-text">Wellness4All is UK based gym providing various services to its customers such as sports services and personal training. The activities include swimming pool, indoor running tracks, tennis, football and boxing. The aim of this new website is to offer our customers convenience, more control and speedy signup for their services.</div>
        <div class="col-2">
            <div><img alt="fitness-woman" class="medium-pic" src="img/woman.jpg"></div>
            <div><img alt="fitness-woman" class="medium-pic" src="img/woman2.jpg"></div>
        </div>

        <h4>Meet our team!</h4>
         <div>
             <img alt="team-member" class="team-pic" src="img/team1.png">
             <div>Tania</div>
             <div>Trainers Supervisor</div>
        </div>
        <br>
<div class="col-3">
      
        <div><img alt="team-member" class="team-pic" src="img/team2.png"><div>Jake</div>
             <div>Trainer</div></div>
      <div><img alt="team-member" class="team-pic" src="img/team3.png"><div>Ben</div>
             <div>Trainer</div></div>
        <div><img alt="team-member" class="team-pic" src="img/team4.png"><div>Sylvie</div>
             <div>Trainer</div></div>
        </div>
         <br>
        <h4>Our address:</h4>
        <div class="address">
            <a href="contact-us.php#map-address">
        <div>"Wellness4All"</div>
        <div>88 Workout road</div>
            <div>SW11 1XG</div></a>
             <br>
            <h4>Our phone number:</h4>
            <div><a href="tel:02052352627">Tel.: 0 205 235 26 27</a></div>
            </div>
        <p>We are open:
        </p>
        <p>Monday to Friday:
        </p>
        <p>08:00 - 20:00
        </p>
        <p>Saturday:
        </p>
        <p>08:00 - 16:00
        </p>
        <p>Sunday: 12:00 - 18:00.
        </p>
    </div>
</body>
<div>
    <!---Footer Section--->
    <?php include('includes/footer.php');?>
</div>
<!---Modals Section--->
<?php include('includes/modal.php');?>

</html>
