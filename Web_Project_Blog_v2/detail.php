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
        
        $postId = $_POST["postId"];

        $post = PostDb::getPostById($postId);

        $category = CategoryDb::getCategoryById($post->categoryID)->name;
        $title = $post->title;
        $autor = UserDb::getUserById($post->autorID)->name . " " . UserDb::getUserById($post->autorID)->lastName;
        $date = $post->date;
        $amountOfComments = PostDb::getAmountOfCommentsByID($postId); 
        $textFirstPart = $post->text;

        $comments = CommentDb::getCommentsByPostId($postId);
    ?>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ("navBarRead.php"); ?>
    
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
            </div>

            <div class="row center">
                
                <div class="card-group-detail">
                    <div class="foto">
                        <?php echo '<img src="data:image/png;base64,' .  base64_encode($post->photo)  . '", class="img-fluid" alt="image" />'; ?>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span class="badge badge-info">Niet werken cat</span>
                            <h4 class="card-title"><?php echo $title ?></h4>
                            <p class="card-text info">
                                By <em><?php echo $autor ?></em> | <em><?php echo $date ?></em> | <em><?php echo $amountOfComments ?></em> comments
                            </p>
                            <p>
                                <?php echo $textFirstPart ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Comments -->
                <div class="list-group comments">
                    
                    <?php
                        foreach($comments as $comment){
                            $commentAuthor = UserDb::getUserById($comment->userID)->name . " " . UserDb::getUserById($comment->userID)->lastName;
                            $commentTitle = $comment->title;
                            $commentDate = $comment->dateMade;
                            $commentText = $comment->text;
                    ?>

                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $commentAuthor ?> - <?php echo $commentTitle ?></h5>
                            <small><?php echo $commentDate ?></small>
                        </div>
                        <p class="mb-1"><?php echo $commentText ?></p>

                        <?php
                            if($comment->rating == 1){
                                echo '<img src="images/1StarRating.png" alt="Stars" width="200">';
                            }
                            else if($comment->rating == 2){
                                echo '<img src="images/2StarRating.png" alt="Stars" width="200">';
                            }
                            else if($comment->rating == 3){
                                echo '<img src="images/3StarRating.png" alt="Stars" width="200">';
                            }
                            else if($comment->rating == 4){
                                echo '<img src="images/4StarRating.png" alt="Stars" width="200">';
                            }
                            else if($comment->rating == 5){
                                echo '<img src="images/5StarRating.png" alt="Stars" width="200">';
                            }
                        ?>
                    </div>

                    <?php    
                        }
                    ?>

                </div>
                    
            </div>
                <form action="commentForm.php" method="POST">
                    <div class="input">
                        <input type="hidden" name="postId" class="form-control" value=<?php echo $postId ?>>
                        <input type="submit" class="btn btn-dark readAllBtn" value="Write a comment"/>
                    </div>
                </form>
        </div>
    </div>
        <!-- JQuery -->
        <script src="JS/JQuery.js"></script> 
        
        <!-- Menu Toggle Script -->
        <script src="js/navBar.js"></script> 

        <!-- Bootstrap Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>