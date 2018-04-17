<?php
    include_once './Database/CRUD/PostDb.php';
    include_once './Database/CRUD/CategoryDb.php';
    include_once './Database/CRUD/UserDb.php';
    include_once './Database/CRUD/CommentDb.php';
    
    $popPostId = $_POST["postId"];
    $resultPost = PostDb::getPostById($popPostId);

    $resultPhoto = $resultPost->photo;
    $reslutCategory = CategoryDb::getCategoryById($resultPost->categoryID)->name;
    $resultTitle = $resultPost->title;
    $resultAutor = UserDb::getUserById($resultPost->autorID)->name . " " . UserDb::getUserById($resultPost->autorID)->lastName;
    $resultDate = $resultPost->date;
    $resultAmountOfComments = PostDb::getAmountOfCommentsByID($popPostId); 
    $resultText = $resultPost->text;
    $resultTextFirstPart = substr($resultText, 0, 300) . "...";
    
    echo 

    '<div class="card-group" data-toggle="tooltip" title="'. $resultAmountOfComments .' comment(s)">
        <div class="foto">
            <img src="data:image/png;base64,' .  base64_encode($resultPhoto)  . '", class="img-fluid" alt="image" />
        </div>
        <div class="card">
            <div class="card-body">
                
            <span class="badge badge-info">'. $reslutCategory .'</span>
                <h4 class="card-title">'. $resultTitle .'</h4>
                
                <p class="card-text info">
                    By <em>'. $resultAutor .'</em> | <em>'. $resultDate .'</em> | <em>'. $resultAmountOfComments .'</em> comments
                </p>

                <p>'. $resultTextFirstPart .'</p>
            </div>
            <form action="detail.php" method="POST">
                <div class="input">
                    <input type="hidden" name="postId" class="form-control" value='. $popPostId .'>
                    <input type="submit" class="btn btn-dark readAllBtn" value="Read Full Post"/>
                </div>
            </form>
        </div>
    </div>'
?>