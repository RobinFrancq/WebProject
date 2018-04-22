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

            $catId = $_GET["catId"];
            $argDate = $_GET["argDate"];
        ?>

        <div id="wrapper">

            <!-- Sidebar -->
            <?php 
                $popPosts = PostDb::get3PopularPostIDs();
                $categories = CategoryDb::getAll();
                $dates = PostDb::getAllDates();
                $months = array();
                
                include_once "./navBars/navBarRead.php"; 
            ?>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Filter</a>
                </div>

                <div id="filterResult">

                    <?php if(isset($catId) == false && isset($argDate) == false) { ?>

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
                                <?php echo '<img src="'. $photo .'", class="img-fluid" alt="image" />'; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    
                                <span class="badge badge-info"><?php echo $category ?></span>
                                    <h4 class="card-title"><?php echo $title ?></h4>
                                    
                                    <p class="card-text info">
                                        By <em><?php echo $autor ?></em> | <em><?php echo $date ?></em> | <em><?php echo $amountOfComments ?></em> comment(s)
                                    </p>

                                    <p><?php echo $textFirstPart ?></p>
                                </div>
                                <!--
                                <form action="detail.php" method="POST">
                                    <div class="input">
                                        <input type="hidden" name="postId" class="form-control" value=<?php echo $post->postID ?>>
                                        <input type="submit" class="btn btn-dark readAllBtn" value="Read Full Post"/>
                                    </div>
                                </form>
                                -->
                                <a href="detail.php?postId=<?php echo $post->postID ?>" class="btn btn-info readFullPostBtn">Read Full Post</a>
                            </div>
                        </div> 
                        
                    <?php
                            }
                        }
                        else if (isset($catId) == true) {

                            $resultPosts = PostDb::getPostByCategory($catId);

                            foreach($resultPosts as $resultPost) {
                                $resultPhoto = $resultPost->photo;
                                $reslutCategory = CategoryDb::getCategoryById($resultPost->categoryID)->name;
                                $resultTitle = $resultPost->title;
                                $resultAutor = UserDb::getUserById($resultPost->autorID)->name . " " . UserDb::getUserById($resultPost->autorID)->lastName;
                                $resultDate = $resultPost->date;
                                $resultAmountOfComments = PostDb::getAmountOfCommentsByID($catId); 
                                $resultText = $resultPost->text;
                                $resultTextFirstPart = substr($resultText, 0, 300) . "...";
                    ?>

                                <div class="card-group" data-toggle="tooltip" title="<?php echo $resultAmountOfComments . ' comment(s)' ?>">
                                    <div class="foto">
                                        <img src="<?php echo $resultPhoto ?>", class="img-fluid" alt="image" />
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            
                                        <span class="badge badge-info"><?php echo $reslutCategory ?></span>
                                            <h4 class="card-title"><?php echo $resultTitle ?></h4>
                                            
                                            <p class="card-text info">
                                                By <em><?php echo $resultAutor ?></em> | <em><?php echo $resultDate ?></em> | <em><?php echo $resultAmountOfComments ?></em> comment(s)
                                            </p>

                                            <p><?php echo $resultTextFirstPart ?></p>
                                        </div>
                                        <a href="detail.php?postId=<?php echo $resultPost->postID ?>" class="btn btn-info readFullPostBtn">Read Full Post</a>
                                    </div>
                                </div>

                    <?php
                        }
                    }
                    else if (isset($argDate) == true) {

                        $resultPosts = PostDb::getPostsByMonth($argDate);

                        foreach($resultPosts as $resultPost) {
                            $resultPhoto = $resultPost->photo;
                            $reslutCategory = CategoryDb::getCategoryById($resultPost->categoryID)->name;
                            $resultTitle = $resultPost->title;
                            $resultAutor = UserDb::getUserById($resultPost->autorID)->name . " " . UserDb::getUserById($resultPost->autorID)->lastName;
                            $resultDate = $resultPost->date;
                            $resultAmountOfComments = PostDb::getAmountOfCommentsByID($catId); 
                            $resultText = $resultPost->text;
                            $resultTextFirstPart = substr($resultText, 0, 300) . "...";
                    ?>
                            <div class="card-group" data-toggle="tooltip" title="<?php echo $resultAmountOfComments . ' comment(s)' ?>">
                                <div class="foto">
                                    <img src="<?php echo $resultPhoto ?>", class="img-fluid" alt="image" />
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        
                                    <span class="badge badge-info"><?php echo $reslutCategory ?></span>
                                        <h4 class="card-title"><?php echo $resultTitle ?></h4>
                                        
                                        <p class="card-text info">
                                            By <em><?php echo $resultAutor ?></em> | <em><?php echo $resultDate ?></em> | <em><?php echo $resultAmountOfComments ?></em> comment(s)
                                        </p>

                                        <p><?php echo $resultTextFirstPart ?></p>
                                    </div>
                                    <a href="detail.php?postId=<?php echo $resultPost->postID ?>" class="btn btn-info readFullPostBtn">Read Full Post</a>
                                </div>
                            </div>
                    <?php
                        }
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