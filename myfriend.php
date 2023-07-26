<?php
ob_start();
session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>my friend</title>
    <style>
      body {
        background-color: rgb(242, 244, 248);
      }

      .div1 {
          
        margin: 0% 35% 2% 35%;
        background-color: rgb(255, 255, 255);
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
          
      }

      .photo_client{
        margin-left: 45%;
        height: 7%;
        width: 10%;
        border-radius: 50%;
      }

      .button_name_client{
        height: 5%;
        width: 100%;
        background-color: rgb(255, 255, 255);
        border-style: hidden;
      }

      .name_client{
        text-align: center;
      }

      h1{
        text-align: center;
      }

      @media only screen and (min-width:451px) and (max-width: 1200px) {
                
          .div1 {
              margin: 0% 20% 2% 20%;
              background-color: rgb(255, 255, 255);
              box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
              border-radius: 05px;
          }
          
      }

      @media only screen and (min-width:1px) and (max-width: 500px) {
          
          .div1 {
              margin: 0% 0% 2% 0%;
              background-color: rgb(255, 255, 255);
              box-shadow: 2px 2px 2px 2px rgb(209, 208, 211);
              border-radius: 05px;
          }
          
      }
    </style>
    
  </head>
  <body>
  <div class="div1"> 
      <?php
        
        $id=$_SESSION['id'];
        
        //inter database
        $username="root";
        $password="";
        $database= new PDO("mysql:host=localhost;dbname=honsty",$username,$password);
        $getfollower=$database->prepare("SELECT * FROM `friends` WHERE `client_id`=$id");
        $getfollower->execute();
        echo '<h1>.....I Follow.....</h1>';
        foreach ($getfollower as $friend) {
            //id of friend 
            $friend_id= $friend["friend_id"];
            //get data of friend by id get it from table of friends
            $photo = $database->prepare("SELECT * FROM client_data WHERE ip= $friend_id ");
            $photo ->execute();
            //puplish photo of clients up posts
            foreach ($photo as $link) {
                $getphotoclient="data:".$link['type_photo'].";base64,".base64_encode($link['file']);
                echo '<img class="photo_client"  src="'.$getphotoclient.'">';
                echo '<form method="POST" enctype="multipart/form-data"><button type="submit" class="button_name_client" name="b'.$link['ip'].'"><h4 class="name_client">'.$link['f_name'].$link['l_name'].'</h4></button><input type="hidden" value="'.$link['ip'].'" name="i1'.$link['ip'].'"/></form>';
              

                if (isset($_POST['b'.$link["ip"]])) {
                    $id_anither_client=$_POST['i1'.$link["ip"]];
                
                    $_SESSION["id_frind"]=$id_anither_client;
                    header("location: friend_page.php");
                    ob_end_flush();
                }
            }
        }

      ?>
  </div>
</body>
</html>