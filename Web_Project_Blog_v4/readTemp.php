<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- zelfgeschreven css -->
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link href="css/simple-sidebar.css" rel="stylesheet">

        <title>EHB BLOG</title>
    </head>

    <body>

        <?php
            include_once './Database/CRUD/UserDb.php';
            include_once './Database/CRUD/PostDb.php';
            include_once './Database/CRUD/CommentDb.php'; 
            include_once './Database/CRUD/CategoryDb.php'; 
        ?>

        <div id="wrapper">

            <!-- Sidebar -->
            <?php include_once "navBarRead.php" ?>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
                </div>  

                <div id="cards">
                    
                </div>

                <button id="button">Get Article</button>

            </div>
        </div>

        <script src="js/JQuery.js"></script>
        <script src="js/Script.js"></script>
        
        <!-- Menu Toggle Script -->
        <script src="js/navBar.js"></script> 

        <!-- Bootstrap Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>