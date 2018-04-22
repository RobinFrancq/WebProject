<?php
    // Deze file zorgt voor het echoën van de juiste posts afhankelijk van 
    // de meegegeven catId
    
    include_once './Database/CRUD/PostDb.php';
    include_once './Database/CRUD/CategoryDb.php';
    include_once './Database/CRUD/UserDb.php';
    include_once './Database/CRUD/CommentDb.php';
    
    $catId = $_POST["catId"];
    $resultPosts = PostDb::getPostByCategory($catId);

    foreach($resultPosts as $resultPost){
        $resultPhoto = $resultPost->photo;
        $reslutCategory = CategoryDb::getCategoryById($resultPost->categoryID)->name;
        $resultTitle = $resultPost->title;
        $resultAutor = UserDb::getUserById($resultPost->autorID)->name . " " . UserDb::getUserById($resultPost->autorID)->lastName;
        $resultDate = $resultPost->date;
        $resultAmountOfComments = PostDb::getAmountOfCommentsByID($resultPost->postID); 
        $resultText = $resultPost->text;
        $resultTextFirstPart = substr($resultText, 0, 300) . "...";

        echo 

        '<div class="card-group" data-toggle="tooltip" title="'. $resultAmountOfComments .' comment(s)">
            <div class="foto">
                <img src="'. $resultPhoto .'", class="img-fluid" alt="image" />
            </div>
            <div class="card">
                <div class="card-body">
                    
                <span class="badge badge-info">'. $reslutCategory .'</span>
                    <h4 class="card-title">'. $resultTitle .'</h4>
                    
                    <p class="card-text info">
                        By <em>'. $resultAutor .'</em> | <em>'. $resultDate .'</em> | <em>'. $resultAmountOfComments .'</em> comment(s)
                    </p>

                    <p>'. $resultTextFirstPart .'</p>
                </div>
                <a href="detail.php?postId=' . $resultPost->postID . '" class="btn btn-info readFullPostBtn">Read Full Post</a>
            </div>
        </div>';
    }
?>