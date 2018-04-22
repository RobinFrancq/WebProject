<?php
    //Nodige includes voor deze pagina + initialisatie van de nodige variabelen

    include_once './Database/CRUD/UserDb.php';
    include_once './Database/CRUD/PostDb.php';
    include_once './Database/CRUD/CommentDb.php'; 
    include_once './Database/CRUD/CategoryDb.php';
    include 'cookieLogin.php'; 

    $popPosts = PostDb::get3PopularPostIDs();
    $randPosts = PostDb::get3RandomPosts();
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
            <?php include ("./navBars/navBar.php"); ?>

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <!-- Side Menu knop -->
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
                </div>

                <!-- Opeenvolging van maximaal 3 populaire posts -->
                <blockquote class="blockquote onderwerp">
                    <p>Popular Posts</p>
                </blockquote>

                <?php
                    //Voor elke populaire post zal een card van deze post worden opgemaakt
                    foreach($popPosts as $postId){
                        $post = PostDb::getPostById($postId);

                        $photo = $post->photo;
                        $category = CategoryDb::getCategoryById($post->categoryID)->name;
                        $title = $post->title;
                        $autor = UserDb::getUserById($post->autorID)->name . " " . UserDb::getUserById($post->autorID)->lastName;
                        $date = $post->date;
                        $amountOfComments = PostDb::getAmountOfCommentsByID($postId); 
                        $text = $post->text;
                        $textFirstPart = substr($text, 0, 300) . "...";
                ?>    

                <!-- Vorm van de post -->
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
                            Knop die je brengt naar de detail pagina en je de juiste post ID meegeeft zodat de juiste 
                            informatie wordt weergegeven in de detail pagina
                        -->
                        <!--
                        <form action="detail.php" method="POST">
                            <div class="input">
                                <input type="hidden" name="postId" class="form-control" value=<?php //echo $postId ?>>
                                <input type="submit" class="btn btn-dark readAllBtn" value="Read Full Post"/>
                            </div>
                        </form>
                        -->
                        <a href="detail.php?postId=<?php echo $postId ?>" class="btn btn-info readFullPostBtn">Read Full Post</a>
                    </div>
                </div> 

                <?php
                    }        
                ?>

                <!-- Opeenvolging van maximaal 3 Random posts -->
                <blockquote class="blockquote onderwerp">
                    <p>Random Posts of this month</p>
                </blockquote>
                
                <?php
                    //Voor elke random post zal een card van deze post worden opgemaakt
                    foreach($randPosts as $randPost){
                        $photo = $randPost->photo;
                        $category = CategoryDb::getCategoryById($randPost->categoryID)->name;
                        $title = $randPost->title;
                        $autor = UserDb::getUserById($randPost->autorID)->name . " " . UserDb::getUserById($randPost->autorID)->lastName;
                        $date = $randPost->date;
                        $amountOfComments = PostDb::getAmountOfCommentsByID($randPost->postID); 
                        $text = $randPost->text;
                        $textFirstPart = substr($text, 0, 300) . "...";
                ?>    

                <!-- Vorm van de post -->
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
                            Knop die je brengt naar de detail pagina en je de juiste post ID meegeeft zodat de juiste 
                            informatie wordt weergegeven in de detail pagina
                        -->
                        <!--
                        <form action="detail.php" method="POST">
                            <div class="input">
                                <input type="hidden" name="postId" class="form-control" value=<?php //echo $randPost->postID ?>>
                                <input type="submit" class="btn btn-dark readAllBtn" value="Read Full Post"/>
                            </div>
                        </form>
                        -->
                        <a href="detail.php?postId=<?php echo $randPost->postID ?>" class="btn btn-info readFullPostBtn">Read Full Post</a>
                    </div>
                </div> 

                <?php
                    }        
                ?>
               
            </div>
        </div>

        <!-- Scripts van Bootstrap (omvat jQuery)-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- 
            Script voor de werking van de popup bij het hoveren over een post 
            voor de weergave van het aantal comments
        -->
        <script src="js/tooltipScript.js"></script> 
        
        <!-- Script voor de werking van de side menu -->
        <script src="js/navBar.js"></script> 
    </body>
</html>