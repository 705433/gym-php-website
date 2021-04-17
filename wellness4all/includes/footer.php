<div class="footer">
    <?php if(!isset ($_SESSION['admin'])){?>    
    <table>
        <tr>
            <th class="footer-head">Site map:</th>
            <th class="footer-head">Social media:</th>
            <th class="footer-head">External links:</th>
            <th class="footer-head">Company details:</th>
        </tr>
        <tr>
            <td><a href="about.php">About Us</a></td>
            <td><a href="https://www.facebook.com/"><img src="img/facebook.png" align="top" width="20" alt="Facebook icon" class="social"> Facebook</a></td>
            <td><a href="http://froningfilm.com/" target="_blank">"Froning"</a></td>
            <td>"Wellness4All"</td>
        </tr>
        <tr>
            <td><a href="contact-us.php">Contact</a></td>
            <td><a href="https://twitter.com/"><img src="img/twitter.png" align="top" width="20" alt="Twitter icon" class="social"> Twitter</a></td>
            <td><a href="http://www.whatthehealthfilm.com/" target="_blank">"What the health"</a></td>
            <td>88 Workout road</td>
        </tr>
        <tr>
            <td> <?php if(isset ($_SESSION['currentuser'])){ ?> <a href="services.php" class="header-text">Sports Services</a> <?php }?> </td>
            <td><a href="https://www.instagram.com/"><img src="img/instagram.png" align="top" width="20" alt="Instagram icon" class="social"> Instagram</a></td>
            <td><a href="http://www.hungryforchange.tv/" target="_blank">"Hungry for change"</a></td>
            <td>SW11 1XG</td>
        </tr>
        <tr>
            <td> <?php if(isset ($_SESSION['currentuser'])){ ?> <a href="bookings.php" class="header-text">Bookings</a> <?php }?> </td>
            <td><a href="https://www.youtube.com/"><img src="img/youtube.png" align="top" width="20" alt="Youtube icon" class="social">YouTube</a></td>
            <td></td>
            <td><a href="tel:02052352627">Tel.: 0 205 235 26 27</a></td>
        </tr>
        <tr>
            <td> <?php if(isset ($_SESSION['currentuser'])){ ?> <a href="personal.php" class="header-text">Personal Training</a> <?php }?> </td>
        </tr>
    </table>
    
    <?php }
    ?>
    <div class="tfoot">© 2019 Wellness4All. All Rights Reserved | Website design: BizTech Ltd</div>
</div>

<script>
    window.onscroll = function() {
        scroll()
    };

</script>
<div class="progress-container">
    <div class="progress-bar" id="scroll"></div>
</div>


