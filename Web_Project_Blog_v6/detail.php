<?php
    //Nodige includes voor deze pagina + initialisatie van de nodige variabelen

    include_once './Database/CRUD/UserDb.php';
    include_once './Database/CRUD/PostDb.php';
    include_once './Database/CRUD/CommentDb.php'; 
    include_once './Database/CRUD/CategoryDb.php';

    $postId = $_GET["postId"];
            
    $post = PostDb::getPostById($postId);
    $postPhoto = $post->photo;
    $postCategory = CategoryDb::getCategoryById($post->categoryID)->name;
    $postTitle = $post->title;
    $postAutor = UserDb::getUserById($post->autorID)->name . " " . UserDb::getUserById($post->autorID)->lastName;
    $postDate = $post->date;
    $postAmountOfComments = PostDb::getAmountOfCommentsByID($postId); 
    $postText = $post->text;

    $postComments = CommentDb::getCommentsByPostId($postId);
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Nodig meta tags voor de website voor onder andere responsive CSS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <?php 
                // categoryId en sameCatPosts zijn twee variabelen die zullen gebruikt worden in
                // navBarDetail.php en worden in dit ducument geinitialiseerd
                $categoryId = $post->categoryID;
                $sameCatPosts = PostDb::get3PostsWithSameCategory($categoryId, $postId);
                $categories = CategoryDb::getAll();
                $dates = PostDb::getAllDates();
                $months = array();

                include ("navBarDetail.php"); 
            ?>
        
            <!-- Page Content -->
            <div id="page-content-wrapper">

                <!-- Side Menu knop -->
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
                </div>

                <div class="row center" id="thePost">
                    
                    <!-- Vorm van de post -->
                        <div class="card-group-detail">
                            <div class="foto">
                                <?php echo '<img src="'. $postPhoto .'", class="img-fluid" alt="image" />'; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <span class="badge badge-info"><?php echo "test" ?></span>
                                    <h4 class="card-title"><?php echo $postTitle ?></h4>
                                    <p class="card-text info">
                                        By <em><?php echo $postAutor ?></em> | <em><?php echo $postDate ?></em> | <em><?php echo $postAmountOfComments ?></em> comments
                                    </p>
                                    <p>
                                        <?php echo $postText ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    
                    <!-- Comments van deze post -->
                    <div class="list-group comments">
                        <?php
                            // Voor elke comment in postComments zal een comment worden gemaakt
                            foreach($postComments as $comment){
                                $commentAuthor = UserDb::getUserById($comment->userID)->name . " " . UserDb::getUserById($comment->userID)->lastName;
                                $commentTitle = $comment->title;
                                $commentDate = $comment->dateMade;
                                $commentText = $comment->text;
                        ?>
                        
                        <!-- Vorm van de comment -->
                        <div class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo $commentAuthor ?> - <?php echo $commentTitle ?></h5>
                                <small><?php echo $commentDate ?></small>
                            </div>
                            <p class="mb-1"><?php echo $commentText ?></p>

                            <?php

                                // Afhankelijk van de waarde van rating zal een andere image worden getoond
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
                        
                        <!-- 
                            Knop die je brengt naar de commentForm pagina en je de juiste post ID meegeeft zodat de juiste 
                            informatie wordt meegegeven aan de commentForm pagina
                        -->
                        <!--
                        <form action="commentForm.php" method="POST">
                            <div class="input">
                                <input type="hidden" name="postId" class="form-control" value=<?php echo $postId ?>>
                                <input type="submit" class="btn btn-dark readAllBtn" value="Write a comment"/>
                            </div>
                        </form>
                        -->
                        <a href="commentForm.php?postId=<?php echo $postId ?>" class="btn btn-info readFullPostBtn">Write a comment</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scripts van Bootstrap (omvat jQuery)-->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="js/JQuery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        

        <!-- Script voor de werking van de side menu -->
        <script src="js/navBar.js"></script> 
        
        <!-- Script voor de werking van de side menu -->
        <script src="js/sideMenuScript.js"></script> 
    </body>
</html>