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
            <?php 
                $popPosts = PostDb::get3PopularPostIDs();
                $categories = CategoryDb::getAll();
                $dates = PostDb::getAllDates();
                $months = array();
                
                include_once "navBarRead.php"; 
            ?>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Filter</a>
                </div>

                <div id="filterResult">
                    
                    <blockquote class="blockquote onderwerp">
                        <p>All Posts</p>
                    </blockquote> 
                    
                    <?php
                        $posts = PostDb::getAllOrderOnDate();
                    
                        foreach($posts as $post){

                            $photo = $post->photo;
                            $category = CategoryDb::getCategoryById($post->categoryID)->name;
                            $title = $post->title;
                            $autor = UserDb::getUserById($post->autorID)->name . " " . UserDb::getUserById($post->autorID)->lastName;
                            $date = $post->date;
                            $amountOfComments = PostDb::getAmountOfCommentsByID($post->postID); 
                            $text = $post->text;
                            $textFirstPart = substr($text, 0, 300) . "...";
                    ?>   

                    <div class="card-group" data-toggle="tooltip" title="<?php echo $amountOfComments ?> comment(s)">
                        <div class="foto">
                            <?php echo '<img src="data:image/png;base64,' .  base64_encode($photo)  . '", class="img-fluid" alt="image" />'; ?>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                
                            <span class="badge badge-info"><?php echo $category ?></span>
                                <h4 class="card-title"><?php echo $title ?></h4>
                                
                                <p class="card-text info">
                                    By <em><?php echo $autor ?></em> | <em><?php echo $date ?></em> | <em><?php echo $amountOfComments ?></em> comments
                                </p>

                                <p><?php echo $textFirstPart ?></p>
                            </div>
                            <form action="detail.php" method="POST">
                                <div class="input">
                                    <input type="hidden" name="postId" class="form-control" value=<?php echo $post->postID ?>>
                                    <input type="submit" class="btn btn-dark readAllBtn" value="Read Full Post"/>
                                </div>
                            </form>
                        </div>
                    </div> 

                    <?php
                        }        
                    ?>
                </div>
            </div>
        </div>

        <!-- Bootstrap Scripts -->
        <script src="js/JQuery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <!-- JQuery -->
        <!-- <script src="js/JQuery.js"></script> -->

        <!-- toolTipScript -->
        <script src="js/tooltipScript.js"></script> 
        
        <!-- Menu Toggle Script -->
        <script src="js/navBar.js"></script> 

        <script src="js/popPostResult.js"></script> 
        <script src="js/catResult.js"></script>
        <script src="js/argResult.js"></script> 
    </body>
</html>