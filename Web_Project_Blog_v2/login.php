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
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ("navBar.php"); ?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
            </div>

            <div class="container loginForm" >
                    <form class="form-signin loginBody" action="loginCheck.php" method="POST">
                    <h2 class="form-signin-heading">Login</h2>
                        <div class="input">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $values["username"]; ?>">
                        </div>
                        <br />
                        <div class="input">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $values["password"]; ?>">
                        </div>
                        <br />
                        <div class="input">
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login"/>
                        </div>
                    </form>
            </div>
        </div>
    </div>

     <!-- JQuery -->
     <script src="JS/JQuery.js"></script> 
        
    <!-- Menu Toggle Script -->
    <script src="js/navBar.js"></script> 

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>