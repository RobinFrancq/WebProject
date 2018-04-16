<!-- Dit is de side menu die wordt gebruikt op de read pagina -->

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
        <li>
            <em>Popular Posts</em>
        </li>
            <?php
                // Hier worden de 3 meest populaire posts weergegeven
                foreach($popPosts as $postId){
                    $post = PostDb::getPostbyId($postId);
                    $postTitle = $post->title;
                    $postTitleLenght = strlen($postTitle);

                    // Indien de post te lang is om weer te geven in de side menu
                    // wordt deze ingekort
                    if($postTitleLenght > 20){
                        $partOfTitle = substr($postTitle, 0, 23);
                        $partOfTitle = $partOfTitle . "...";
                        echo '<li><a href="#" class="popPostBtn" id="'. $postId .'">' . $partOfTitle . '</a></li>';
                    }
                    else{
                        echo '<li><a href="#" class="popPostBtn" id="'. $postId .'">' . $post->title . '</a></li>';
                    }
                }
            ?>
        <br />
        <li>
            <em>Categories</em>
        </li>
            <?php
                // Hier worden alle mogelijke categorieen weergegeven 
                foreach($categories as $category){
                    echo '<li><a href="#" class="catBtn" id="'. $category->categoryID .'">' . $category->name . '</a></li>';
                }
            ?>
        <br />
        <li>
            <em>Archive</em>
        </li>
            <?php
                // Alle mogelijke data van de posts worden overlopen en weergegeven in
                // het juiste formaat. Alle mogelijk data worden eerst geplaatst in de 
                // array "months" en vervolgens worden ze weergegeven in de side menu
                foreach($dates as $date){
                    $date = strtotime($date);
                    $formatDate = date('F Y', $date);

                    if (!in_array($formatDate, $months)) {
                        array_push($months, $formatDate);
                        $dateMonthNumber = date('n', $date);
                        echo '<li><a href="#" class="argBtn" id="'. $dateMonthNumber .'">' . $formatDate . '</a></li>';
                    }
                }
            ?>
        <br />
        <li>
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
        <li>
            <em>Popular Posts</em>
        </li>
            <?php
                // Hier worden de 3 meest populaire posts weergegeven
                foreach($popPosts as $postId){
                    $post = PostDb::getPostbyId($postId);
                    $postTitle = $post->title;
                    $postTitleLenght = strlen($postTitle);

                    // Indien de post te lang is om weer te geven in de side menu
                    // wordt deze ingekort
                    if($postTitleLenght > 20){
                        $partOfTitle = substr($postTitle, 0, 23);
                        $partOfTitle = $partOfTitle . "...";
                        echo '<li><a href="#" class="popPostBtn" id="'. $postId .'">' . $partOfTitle . '</a></li>';
                    }
                    else{
                        echo '<li><a href="#" class="popPostBtn" id="'. $postId .'">' . $post->title . '</a></li>';
                    }
                }
            ?>
        <br />
        <li>
            <em>Categories</em>
        </li>
            <?php
                // Hier worden alle mogelijke categorieen weergegeven 
                foreach($categories as $category){
                    echo '<li><a href="#" class="catBtn" id="'. $category->categoryID .'">' . $category->name . '</a></li>';
                }
            ?>
        <br />
        <li>
            <em>Archive</em>
        </li>
            <?php
                // Alle mogelijke data van de posts worden overlopen en weergegeven in
                // het juiste formaat. Alle mogelijk data worden eerst geplaatst in de 
                // array "months" en vervolgens worden ze weergegeven in de side menu
                foreach($dates as $date){
                    $date = strtotime($date);
                    $formatDate = date('F Y', $date);

                    if (!in_array($formatDate, $months)) {
                        array_push($months, $formatDate);
                        $dateMonthNumber = date('n', $date);
                        echo '<li><a href="#" class="argBtn" id="'. $dateMonthNumber .'">' . $formatDate . '</a></li>';
                    }
                }
            ?>
        <br />
        <li>
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