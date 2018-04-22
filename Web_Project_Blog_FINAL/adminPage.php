<?php
    // Nodige includes voor deze pagina + initialisatie van de nodige variabelen
    
    include_once "sessionSecurity.php";
    include_once "./Database/CRUD/UserDb.php";
    include_once "./Database/CRUD/PostDb.php";
    include_once "./Database/CRUD/CategoryDb.php";
    
    // Hier wordt de checkSession functie gebruikt om na te gaan of de gebruiker is ingelogd
    if(!checkSession()){
        header("location:index.php");
    }
    // Hier wordt nagegaan of de gebruiker een Admin is, indien dit niet zo is wordt hij 
    // geredirect naar de homepage
    if(UserDb::getUserById($_SESSION["user"])->isAdmin == 0){
        header("location:index.php");
    }
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
            <?php include ("navBar.php"); ?>

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <!-- Side Menu knop -->
                <div class="container-fluid">
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a>
                </div>
                <br />

                <!-- Table met overzicht van alle posts op de website -->
                <blockquote class="blockquote onderwerp">
                    <p>All Posts on EHB Blog </p>
                </blockquote>
                <br />
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Title</th> 
                            <th>Category</th>
                            <th>Creation Date</th>
                            <th>Autor</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                        // Alle posts worden opgehaald van de database, vervolgens zal elke post in 
                        // de tabel worden geplaatst
                        $posts = PostDb::getAll();
                        foreach($posts as $post) {
                    ?>
                    
                    <tr>
                        <th><?php echo $post->postID ?></th>
                        <td><?php echo $post->title ?></td> 
                        <td><?php echo CategoryDb::getCategoryById($post->categoryID)->name ?></td>
                        <td><?php echo $post->date ?></td>
                        <td><?php echo UserDb::getUserById($post->autorID)->name . " " . UserDb::getUserById($post->autorID)->lastName; ?></td>
                        <td>
                            <!-- Dit is een knop die je stuurt naar de juiste details-page -->
                            <a href="detail.php?postId=<?php echo $post->postID ?>" class="btn btn-info readFullPostBtn">Read This Post</a>
                        </td>
                        <td>
                            <!-- Dit is de knop waarmee je een post kunt verwijderen, er wordt gebruik gemaakt van de deletePost.php file -->
                            <a href="deletePost.php?postId=<?php echo $post->postID ?>" class="btn btn-info readFullPostBtn">Delete This Post</a>
                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                    </tbody>
                    
                </table>

                <!-- Category Form met een POST methode naar categoryCheck.php -->
                <!-- Deze Form wordt ook Client Side gevalideert door categoryValidation.js-->
                <form class="form-signin loginBody" action="categoryCheck.php" method="POST" enctype="multipart/form-data">
                    <h2 class="form-signin-heading">Add a category</h2>
                        <div class="input">
                            <label for="postTitle">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $values["name"]; ?>">
                            <!-- Dit is de plaats waar de foutboodschap komt van de client side validation -->
                            <div id="fault"></div>
                            <div style="color:red;" id="serverSideValidation">
                                <?php echo $errors["name"]; ?>
                            </div>
                        </div>
                        <br />
                        <div class="input">
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Make Category" id="catBtn"/>
                        </div>
                </form>

            </div>
        </div>

        <!-- JQuery -->
        <script src="js/JQuery.js"></script> 

        <!-- Script voor de werking van de side menu -->
        <script src="js/navBar.js"></script>

        <!-- Script voor het client side validatie van de Category Form -->    
        <script src="js/categoryValidation.js"></script>
        
        <!-- Scripts van Bootstrap (omvat jQuery)-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    </body>
</html>