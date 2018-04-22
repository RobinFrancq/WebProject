<!-- Dit is de side menu die wordt gebruikt op enkele pagina's -->

<?php
    // Afhankelijk of de session gestart is of niet wordt er een andere menu weergegeven
    // Daarom wordt dit eert nagegaan 
    
    include_once "sessionSecurity.php";
    include_once "./Database/CRUD/UserDb.php";
    // Indien de session niet gestart is wordt volgende side menu gebruikt
    if(!checkSession()){
?>        

<!-- Vorm en inhoud van de side menu -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="index.php">
                EHB Blog
            </a>
        </li>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="read.php">Read</a>
        </li>
        <li>
            <a href="write.php">Write</a>
        </li>
        <br />
        <li style="color:white;">
            <em>Account</em>
        </li>
        <li>
            <a href="login.php">Login</a>
        </li>
        <li>
            <a href="register.php">Register</a>
        </li>
    </ul>
</div>

<?php
    }
    // Indien de session wel gestart is wordt volgende side menu gebruikt
    else {
        if(UserDb::getUserById($_SESSION["user"])->isAdmin == 0) {
?>

<!-- Vorm en inhoud van de side menu -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="index.php">
                EHB Blog
            </a>
        </li>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="read.php">Read</a>
        </li>
        <li>
            <a href="write.php">Write</a>
        </li>
        <br />
        <li style="color:white;">
            <em>Account</em>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</div>

<?php    
    }
    else {
?>

<!-- Vorm en inhoud van de side menu -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="index.php">
                EHB Blog
            </a>
        </li>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="read.php">Read</a>
        </li>
        <li>
            <a href="write.php">Write</a>
        </li>
        <br />
        <li style="color:white;">
            <em>Account</em>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
        <li>
            <a href="adminPage.php">Admin Functions</a>
        </li>
    </ul>
</div>

<?php
        }
    }
?>