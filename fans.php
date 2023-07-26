<?php
ob_start();
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>fans</title>
        <link rel="stylesheet" href="comment.css">
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

            .form1 {
                background-color: rgb(255, 255, 255);
                position: fixed;
                box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
                margin: 43% 0% 0% 0%;
            }

            h1{
                text-align: center; 
            }

            .photo_commenter {
                margin-left: 45%;
                margin-top: 2%;
                height: 7%;
                width: 10%;
                border-radius: 50%;
            }

            .imglike{
                height: 3%;
                width: 4%;
                margin-left: 50%;
            } 

            h3{
                text-align: center;
            }   
            
            .fbuttons{
                height: 5%;
                width: 100%;
                background-color: rgb(255, 255, 255);
                border-style: hidden;
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
        
        
        $id_post=$_SESSION['id_post'];
        $myid=$_SESSION['id'];
        //open data base 
        $username="root";
        $password="";
        $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
        //add comment 
       echo '<h1>.....Fans.....</h1>';
       $puplish_fans=$database->prepare("SELECT * FROM `like` WHERE `post_id`=$id_post ORDER BY `id` DESC"); 
       $puplish_fans->execute();
        foreach($puplish_fans AS $fans){
            $client_id=$fans['client_id'];
            $client=$database->prepare("SELECT * FROM `client_data` WHERE `ip`=$client_id"); 
            $client->execute();
            
            foreach($client AS $data){
                $getphotoclient="data:".$data['type_photo'].";base64,".base64_encode($data['file']);
                echo '<img class="photo_commenter" hight="10%" width="10%" src="'.$getphotoclient.'"/><img class="imglike"src="icons/124-thumb-up-solid.png"/><form method="POST" enctype="multipart/form-data"><button type="submit" class="fbuttons" name="b'.$data['ip'].'"><h3 class="name_client">'.$data['f_name'].$data['l_name'].'</h3></button><input type="hidden" value="'.$data['ip'].'" name="i1'.$data['ip'].'"/></form>'  ;
                if (isset($_POST['b'.$data["ip"]])) {
                    $id_anither_client=$_POST['i1'.$data["ip"]];
                
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