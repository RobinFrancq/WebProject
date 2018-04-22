<?php
    include_once "sessionSecurity.php";
    if(!checkSession()){
        header("location:login.php");
    }
?>
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
        <link rel="stylesheet" type="text/css" href="css/simple-sidebar.css">

        <title>EHB BLOG</title>
    </head>
  
<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ("./navBars/navBar.php"); ?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
            </div>

            <div class="container loginForm" >
                    <?php 
                        //$date = new DateTime();

                        //include_once "./Database/CRUD/UserDb.php";
                        //$userId = UserDb::getUserByUsername($_SESSION["user"])->userID;

                        include_once "./Database/CRUD/CategoryDb.php";
                        $categories = CategoryDb::getAll();
                    ?>
                    <form class="form-signin loginBody" action="writeCheck.php" method="POST" enctype="multipart/form-data">
                    <h2 class="form-signin-heading">Make Your own Post!</h2>
                        <div class="input">
                            <label for="postTitle">Post Title</label>
                            <input type="text" name="postTitle" class="form-control" value="<?php echo $values["postTitle"]; ?>">
                            <div style="color:red;" class="serverSideValidation">
                                <?php echo $errors["postTitle"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <label for="category">Category</label>
                            <select multiple class="form-control" name="category">
                                <?php
                                    foreach($categories as $categorie){
                                        echo '<option value="'. $categorie->categoryID .'">' . $categorie->name . '</option>';
                                    }
                                ?>
                            </select>
                            <div style="color:red;" class="serverSideValidation">
                                <?php echo $errors["category"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <label for="text">Write your post here</label>
                            <textarea class="form-control" name="text" rows="3"><?php echo $values["text"]; ?></textarea>
                            <div style="color:red;" class="serverSideValidation">
                                <?php echo $errors["text"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <label for="photo">Put image that you want to post with this post</label>
                            <input type="file" class="form-control-file" name="photo" id="photo">
                            <div style="color:red;" class="serverSideValidation">
                                <?php echo $errors["photo"]; ?>
                            </div>
                        </div>
                        <br />    
                        <div class="input">
                            <input type="hidden" name="autorId" class="form-control" value="<?php echo $_SESSION["user"] ?>">
                            <div id="fault"></div>
                        </div>
                        <div class="input">
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Post"/>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="JS/JQuery.js"></script> 
        
    <!-- Menu Toggle Script -->
    <script src="js/navBar.js"></script> 

    <script src="js/writeValidation.js"></script> 

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>