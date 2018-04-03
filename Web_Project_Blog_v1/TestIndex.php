<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UsersTest</title>
    </head>

    <body>
    <table>
      

      <?php
        include_once './Database/CRUD/UserDb.php';
        include_once './Database/CRUD/PostDb.php';
        include_once './Database/CRUD/CommentDb.php';

        //var_dump(PostDb::getImageById(1));

        //$result = PostDb::get3PopularPostIDs();
        //$result2 = CommentDb::get3PopularPostIDs();
        
        //var_dump($result2);
        //var_dump(PostDb::getPostById($result[1]));

        echo '<img src="data:image/png;base64,' .  base64_encode($result->photo)  . '", height=100, width=150 />';
      ?>
    </table>

  </body>
</html>




 