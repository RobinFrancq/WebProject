<?php
    include_once "sessionSecurity.php";
    if(!checkSession()){
?> 

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
            <a href="read.php">Popular Posts</a>
        </li>

        <?php
            include_once "./Database/CRUD/CategoryDb.php";
            $categories = CategoryDb::getAll();

            foreach($categories as $category){
                echo '<li><a href="#">' . $category->name . '</a></li>';
            }
        ?>

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
    else{
?>

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
            <a href="read.php">Popular Posts</a>
        </li>

        <?php
            include_once "./Database/CRUD/CategoryDb.php";
            $categories = CategoryDb::getAll();

            foreach($categories as $category){
                echo '<li><a href="#">' . $category->name . '</a></li>';
            }
        ?>

        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</div>

<?php    
    }
?>