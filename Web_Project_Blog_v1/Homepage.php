<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      
    <!-- zelfgeschreven css -->
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <title>EHB BLOG</title>
  </head>
  
<body>
    <?php
        include_once './Database/CRUD/UserDb.php';
        include_once './Database/CRUD/PostDb.php';
        include_once './Database/CRUD/CommentDb.php'; 
        include_once './Database/CRUD/CategoryDb.php'; 
    ?>
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">EHB BLOG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Lees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schrijf</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Over ons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html">Login or Register</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <blockquote class="blockquote onderwerp">
        <p>Popular Posts</p>
    </blockquote>

    <?php
        $popPosts = PostDb::get3PopularPostIDs();
    
        foreach($popPosts as $postId){
            $post = PostDb::getPostById($postId);
            $demo = 1;

            $category = CategoryDb::getCategoryById($post->categoryID)->name;
            $title = $post->title;
            $autor = UserDb::getUserById($post->autorID)->name . " " . UserDb::getUserById($post->autorID)->lastName;
            $date = $post->date;
            $amountOfComments = PostDb::getAmountOfCommentsByID($postId); 
            $textFirstPart = $post->text;
    ?>    
    
    <div class="card-group">
        <div class="foto">
            <?php echo '<img src="data:image/png;base64,' .  base64_encode($post->photo)  . '", class="img-fluid" alt="image" />'; ?>
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
                <input type="button" class="btn btn-dark readAllBtn" onclick="location.href='detail.html'" value="Read Full Post"/>
        </div>
    </div> 


    <?php
        }        
    ?>
    
    
    
    <blockquote class="blockquote onderwerp">
        <p>Random Posts</p>
    </blockquote>
    
    
    <!-- 
        Colors:
        #96858F
        #6D7993
        #9099A2
        #D5D5D5
    -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>