<div class="header">
    <?php
if(isset ($_SESSION['currentuser'])){
    ?> <div class="user"><?php
    echo ('Logged in as: ');    
    echo $_SESSION['currentuser'];
?>
        <a href="logout.php" class="logout-button">Logout</a>
    </div><a href="index.php">
        <img class="logo" alt="logo" src="img/logo1.png"></a>
    <div class="menu">
        <a href="index.php" class="header-text"><b>Home</b></a>
        <a href="services.php" class="header-text"><b>Sports Services</b></a>
        <a href="bookings.php" class="header-text"><b>Bookings</b></a>
        <a href="personal.php" class="header-text"><b>Personal Training</b></a>
        <div class="dropdown-menu">
            <a href="#" class="header-text"><b>Pages</b></a>
            <div class="sub-menu">
                <li><a href="index.php" class="header-text"><b>Home</b></a></li>
                <li><a href="services.php" class="header-text"><b>Sports Services</b></a></li>
                <li><a href="bookings.php" class="header-text"><b>Bookings</b></a></li>
                <li><a href="personal.php" class="header-text"><b>Personal Training</b></a></li>
            </div>
        </div>
        <a href="about.php" class="header-text"><b>About Us</b></a>
        <a href="contact-us.php" class="header-text"><b>Contact Us</b></a>
    </div><?php
}elseif(isset ($_SESSION['admin'])){
    ?> <div class="user"><?php
         echo ('Logged in as admin: ');    
    echo $_SESSION['admin'];?>
        <a href="logout.php" class="logout-button">Logout</a></div><a href="dashboard.php">
        <img class="logo" alt="logo" src="img/logo1.png"></a>
    <div class="menu">
        <a href="dashboard.php" class="header-text"><b>Dashboard</b></a>
        <a href="manage-users.php" class="header-text"><b>Manage Users</b></a>
        <a href="manage-activities.php" class="header-text"><b>Manage Activities</b></a>
        <a href="manage-bookings.php" class="header-text"><b>Manage Bookings</b></a>
        <a href="manage-messages.php" class="header-text"><b>Manage Messages</b></a>
        <a href="manage-personal.php" class="header-text"><b>Manage Personal Training</b></a>
    </div>
    <?php }else{?><div class="user-buttons">
        <button onclick="showLgModal()" class="button">Login</button>
        <button onclick="showRgModal()" class="button">Register</button>
        <a href="admin.php" class="admin-button">Admin login</a></div><a href="index.php">
        <img class="logo" alt="logo" src="img/logo1.png"></a>
    <div class="menu">
        <a href="index.php" class="header-text"><b>Home</b></a> 
        <a href="about.php" class="header-text"><b>About Us</b></a> 
        <a href="contact-us.php" class="header-text"><b>Contact Us</b></a>
    </div>
    <?php }?>
</div>