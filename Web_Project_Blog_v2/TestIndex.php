<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UsersTest</title>
    </head>

    <body>
    <table>
      

      <?php
        //include_once './Database/CRUD/UserDb.php';
        //include_once './Database/CRUD/PostDb.php';
        //include_once './Database/CRUD/CommentDb.php';

        //var_dump(PostDb::getImageById(1));

        //$result = PostDb::get3PopularPostIDs();
        //$result2 = CommentDb::get3PopularPostIDs();
        
        //var_dump($result2);
        //var_dump(PostDb::getPostById($result[1]));

        //echo '<img src="data:image/png;base64,' .  base64_encode($result->photo)  . '", height=100, width=150 />';

        /*
        function dec_enc($action, $string) {
            $output = false;
        
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'hHp56fst5';
            $secret_iv = 'kd90IsBRT5';
        
            // hash
            $key = hash('sha256', $secret_key);
            
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
            if( $action == 'encrypt' ) {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            }
            else if( $action == 'decrypt' ){
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        
            return (string)$output;
        }

        echo dec_enc('encrypt', "pass2");
        echo "<br />";
        echo dec_enc('decrypt', dec_enc('encrypt', "pass2"));
        */
        echo hash('ripemd160', 'test');
      ?>
    </table>

  </body>
</html>




 