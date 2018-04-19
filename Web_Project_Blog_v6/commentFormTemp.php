<?php
    // Hier wordt de checkSession functie gebruikt om na te gaan of de gebruiker is ingelogd
    include_once "sessionSecurity.php";

    if(!checkSession()){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Nodig meta tags voor de website voor onder andere responsive CSS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS van Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- Toegevoegde CSS -->
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/simple-sidebar.css">

        <title>EHB BLOG</title>
    </head>

    <body>
        <div id="wrapper">
            <!-- Side Menu toevoegen -->
            <?php include ("navBar.php"); ?>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                
                <!-- Side Menu knop -->
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
                </div>

                <div class="container loginForm" >

                    <!-- Comment Form met een POST methode naar commentCheck.php -->
                    <form class="form-signin loginBody" action="commentCheck.php" method="POST" enctype="multipart/form-data">
                    <h2 class="form-signin-heading">Make Comment</h2>
                        
                        <div class="input">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $values["title"]; ?>">
                            <div>
                                <?php echo $errors["title"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <label for="text">Text</label>
                            <input type="text" name="text" class="form-control" value="<?php echo $values["text"]; ?>">
                            <div>
                                <?php echo $errors["text"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <label for="rating">Rating</label>
                            <input type="text" name="rating" class="form-control" value="<?php echo $values["rating"]; ?>">
                            <div>
                                <?php echo $errors["rating"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <input type="hidden" name="userId" class="form-control" value="<?php echo  $_SESSION["user"] ?>">
                        </div>
                        <div class="input">
                            <input type="hidden" name="postId" class="form-control" value="<?php echo $_POST["postId"] ?>">
                        </div>
                        <div class="input">
                            <input type="hidden" name="date" class="form-control" value="<?php echo "test" ?>">
                        </div>
                        <div class="input">
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Comment"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- JQuery -->
        <script src="JS/JQuery.js"></script> 

        <!-- Script voor de werking van de side menu -->
        <script src="js/navBar.js"></script>
        
        <!-- Scripts van Bootstrap (omvat jQuery)-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>