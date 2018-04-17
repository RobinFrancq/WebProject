<!-- Dit is de side menu die wordt gebruikt op de detail pagina -->

<?php
    // Afhankelijk of de session gestart is of niet wordt er een andere menu weergegeven
    // Daarom wordt dit eert nagegaan 

    include_once "sessionSecurity.php";
    // Indien de session niet gestart is wordt volgende side menu gebruikt
    if(!checkSession()){
?> 

<!-- Vorm en inhoud van de side menu -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="index.php">
                EHB Blog
            </a>
        </li>
        <li>
            <a href="index.php">Home</a>
        </li>
        <br />
        <li style="color:white;">
            <em>Same Category Posts</em>
        </li>
            <?php
                // Hier worden de posts weergegeven met dezelfde category als de weergegeven
                // post op de detail page

                // Indien er geen post is van dezelfde category zal "none" worden weergegeven
                if(empty($sameCatPosts)){
                    echo "<li><em>None</em></li>";
                }

                // Indien er wel post(s) is/zijn met dezelfde categorie, worden deze weergegeven
                // in de side menu
                foreach($sameCatPosts as $sameCatPost){
                    $title = $sameCatPost->title;
                    $titleLenght = strlen($title);
                    $sameCatPostId = $sameCatPost->postID;

                    if($titleLenght > 20){
                        $partOfTitle = substr($title, 0, 23);
                        $partOfTitle = $partOfTitle . "...";
                        echo 
                        '<li>
                            <form action="detail.php" method="POST">
                                <div class="input">
                                    <input type="hidden" name="postId" class="form-control" value="'. $sameCatPostId .'">
                                    <input type="submit" class="btn btn-dark readAllBtn" value="'. $partOfTitle .'"/>
                                </div>
                            </form>
                        </li>';
                    }
                    else{
                        echo
                        '<li> 
                            <form action="detail.php" method="POST">
                                <div class="input">
                                    <input type="hidden" name="postId" class="form-control" value="'. $sameCatPostId .'">
                                    <input type="submit" class="btn btn-dark readAllBtn" value="'. $title .'"/>
                                </div>
                            </form>
                        <li>';
                    }
                }
            ?>
        <br />
        <li style="color:white;">
            <em>Categories</em>
        </li>
            <?php
                // Hier worden alle mogelijke categorieen weergegeven
                foreach($categories as $category){
                    echo '<li><a href="#">' . $category->name . '</a></li>';
                }
            ?>
        <br />
        <li style="color:white;">
            <em>Archive</em>
        </li>
            <?php
                // Alle mogelijke data van de posts worden overlopen en weergegeven in
                // het juiste formaat. Alle mogelijk data worden eerst geplaatst in de 
                // array "months" en vervolgens worden ze weergegeven in de side menu
                foreach($dates as $date){
                    $date = strtotime($date);
                    $date = date('F Y',$date);

                    if (!in_array($date, $months)) {
                        array_push($months, $date);
                    }
                }

                foreach($months as $month){
                    echo '<li><a href="#">' . $month . '</a></li>';
                }
            ?>
        <br />
        <li style="color:white;">
            <em>Account</em>
        </li>
        <li>
            <a href="login.php">Login</a>
        </li>
        <li>
            <a href="register.php">Register</a>
        </li>
    </ul>
</div>

<?php
    }
    // Indien de session wel gestart is wordt volgende side menu gebruikt
    else{
?>

<!-- Vorm en inhoud van de side menu -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="index.php">
                EHB Blog
            </a>
        </li>
        <li>
            <a href="index.php">Home</a>
        </li>
        <br />
        <li style="color:white;">
            <em>Same Category Posts</em>
        </li>
            <?php
                // Hier worden de posts weergegeven met dezelfde category als de weergegeven
                // post op de detail page

                // Indien er geen post is van dezelfde category zal "none" worden weergegeven
                if(empty($sameCatPosts)){
                    echo "<li><em>None</em></li>";
                }

                // Indien er wel post(s) is/zijn met dezelfde categorie, worden deze weergegeven
                // in de side menu
                foreach($sameCatPosts as $sameCatPost){
                    $title = $sameCatPost->title;
                    $titleLenght = strlen($title);
                    $sameCatPostId = $sameCatPost->postID;

                    if($titleLenght > 20){
                        $partOfTitle = substr($title, 0, 23);
                        $partOfTitle = $partOfTitle . "...";
                        echo 
                        '<li>
                            <form action="detail.php" method="POST">
                                <div class="input">
                                    <input type="hidden" name="postId" class="form-control" value="'. $sameCatPostId .'">
                                    <input type="submit" class="btn btn-dark readAllBtn" value="'. $partOfTitle .'"/>
                                </div>
                            </form>
                        </li>';
                    }
                    else{
                        echo
                        '<li> 
                            <form action="detail.php" method="POST">
                                <div class="input">
                                    <input type="hidden" name="postId" class="form-control" value="'. $sameCatPostId .'">
                                    <input type="submit" class="btn btn-dark readAllBtn" value="'. $title .'"/>
                                </div>
                            </form>
                        <li>';
                    }
                }
            ?>
        <br />
        <li style="color:white;">
            <em>Categories</em>
        </li>
            <?php
                // Hier worden alle mogelijke categorieen weergegeven
                foreach($categories as $category){
                    echo '<li><a href="#">' . $category->name . '</a></li>';
                }
            ?>
        <br />
        <li style="color:white;">
            <em>Archive</em>
        </li>
            <?php
                // Alle mogelijke data van de posts worden overlopen en weergegeven in
                // het juiste formaat. Alle mogelijk data worden eerst geplaatst in de 
                // array "months" en vervolgens worden ze weergegeven in de side menu
                foreach($dates as $date){
                    $date = strtotime($date);
                    $date = date('F Y',$date);

                    if (!in_array($date, $months)) {
                        array_push($months, $date);
                    }
                }

                foreach($months as $month){
                    echo '<li><a href="#">' . $month . '</a></li>';
                }
            ?>
        <br />
        <li style="color:white;">
            <em>Account</em>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</div>

<?php    
    }
?>