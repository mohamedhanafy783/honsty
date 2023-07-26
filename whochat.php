<?php
ob_start();
session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>who chat</title>
    <style>
      body {
        background-color: rgb(242, 244, 248);
      }

      .div1 {
          
        margin: 0% 33% 2% 33%;
        background-color: rgb(255, 255, 255);
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
          
      }

      .taskbar {
        
        margin: 0% 33% 0% 32.5%;
        background-color: rgb(255, 255, 255);
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
      }

      .iconchat{
        height: 7%;
        width: 10%;
        margin-left:85%;
        margin-top: 1%;
        margin-bottom: 1%;
        
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

      @media screen and (min-width:451px) and (max-width: 1200px) {
    .taskbar {
        margin: 0% 20% 2% 19.5%;
        background-color: rgb(255, 255, 255);
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
    }

    .div1 {
          
          margin: 0% 20% 2% 20%;
          background-color: rgb(255, 255, 255);
          box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
          border-radius: 05px;
            
        }
    
}

@media screen and (min-width:1px) and (max-width: 500px) {
    .taskbar {
        margin: 0% 0% 2% 0%;
        background-color: rgb(255, 255, 255);
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
    }
    
    .div1 {
          
          margin: 0% 0% 2% 0%;
          background-color: rgb(255, 255, 255);
          box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
          border-radius: 05px;
            
        }
}
    </style>
    
  </head>
  <body>
  <div class="taskbar">
    
    <img class="iconchat" src="papyrus (8).png"/>
    
  </div>
  <br>
  <br>
  <br>
  <br>
  <div class="div1"> 
  <br>
  <br>
    <?php
        
        
        $myid=$_SESSION['id'];
        //connect data base
        $username="root";
        $password="";
        $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
        //get friend chat 
        $friendchat = $database->prepare("SELECT * FROM `who_chat` WHERE `my_id`=$myid OR `friend_id`=$myid ORDER BY end_id DESC ");
        $friendchat ->execute();
        foreach ($friendchat as $data) {
            //get photo friend
            $data_id=$data['friend_id'];
            $fdata_id=$data['my_id'];
            
            if ($fdata_id===$myid) {
                $photo = $database->prepare("SELECT * FROM client_data WHERE ip= $data_id ");
                $photo ->execute();
                foreach ($photo as $link) {
                    $getphotoclient="data:".$link['type_photo'].";base64,".base64_encode($link['file']);
                    echo '<img class="photo_client" hieght="10%" width="10%" src="'.$getphotoclient.'">';
                    echo '<form method="POST" enctype="multipart/form-data"><button type="submit" class="button_name_client" name="b'.$data['id'].'"><h4 class="name_client">'.$link['f_name'].$link['l_name'].'</h4></button><input type="hidden" value="'.$data['id'].'" name="i1'.$data['id'].'"/></form>';
                
                
                    //go to chat
                    if (isset($_POST['b'.$data["id"]])) {
                        $id_anither_client=$_POST['i1'.$data["id"]];
                
                        $_SESSION["id_chat"]=$id_anither_client;
                        header("location: chat.php");
                        ob_end_flush();
                    }
                }
            }else{
                $photo = $database->prepare("SELECT * FROM client_data WHERE ip= $fdata_id ");
                $photo ->execute();
                foreach ($photo as $link) {
                    $getphotoclient="data:".$link['type_photo'].";base64,".base64_encode($link['file']);
                    echo '<img class="photo_client" hieght="10%" width="10%" src="'.$getphotoclient.'">';
                    echo '<form method="POST" enctype="multipart/form-data"><button type="submit" class="button_name_client" name="b'.$data['id'].'"><h4 class="name_client">'.$link['f_name'].$link['l_name'].'</h4></button><input type="hidden" value="'.$data['id'].'" name="i1'.$data['id'].'"/></form>';
                
                
                    //go to chat
                    if (isset($_POST['b'.$data["id"]])) {
                        $id_anither_client=$_POST['i1'.$data["id"]];
                        
                        $_SESSION["id_chat"]=$id_anither_client;
                        header("location: chat.php");
                        ob_end_flush();
                    }
                }
            }
        }
    ?>
  </div>

  </body>
</html>