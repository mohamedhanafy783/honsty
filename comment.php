<?php
ob_start();
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>comment</title>
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

            .in_comment {
                height: 4%;
                width: 25%;
                position: fixed;
                box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
                margin-top: 43%;
                border-radius: 05px;
                border-style: hidden;
            }

            .b_comment {
                height: 4%;
                width: 3%;
                position: fixed;
                box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
                margin: 43% 0% 0% 26%;
                background-color: rgb(255, 255, 255);
                border-style: hidden;
                border-radius: 05px;
            }

            .img_send {
                height: 80%;
                width: 80%;
            }

            .photo_commenter {
                margin-left: 45%;
                margin-top: 2%;
                height: 7%;
                width: 10%;
                border-radius: 50%;
            }

            .h3 {
                
                margin-left: 10%;
                margin-right: 10%;
                background-color: rgb(232 232 233);
                border-radius: 10px 0px 10px 10px;
            }

            h3{
                text-align: center;
                

            }

            h1{
                text-align: center; 
            }

            .comment{
                text-align: center;
                margin-right: 5%;
                
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

                .in_comment {
                height: 4%;
                width: 80%;
                position: fixed;
                box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
                margin-top: 100%;
                 margin-left: 1%;
                border-radius: 05px;
                border-style: hidden;
            }

            .b_comment {
                height: 4%;
                width: 14%;
                position: fixed;
                box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
                margin-top: 100%;
                margin-left: 83%;
                background-color: rgb(255, 255, 255);
                border-style: hidden;
                border-radius: 05px;
            }
               
            }

        </style>
    </head>
    <body>

   
  <div class="div1"> 
    
        <form method="POST" enctype="multipart/form-data" >
            <input type="text" class="in_comment" name="comment"/>
            <button type="submit" class="b_comment" name="send"><img class="img_send" src="161-trending-flat-outline.png"/></button>
        </form>
    

        <?php
        
        
        $id_post=$_SESSION['id_post'];
        $myid=$_SESSION['id'];

        
        
        //open data base 
        $username="root";
        $password="";
        $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
        echo '<h1>.....Comment.....</h1>';
        //add comment 
        if (isset($_POST['send'])){
        echo'<script>window.history.back()</script>';
        $comment=$_POST['comment'];
        
        //increese commeint in table of posts
        $getlike = $database->prepare("SELECT * FROM posts WHERE id=$id_post  ");
        $getlike ->execute();
        foreach ($getlike as $arrlike) {
            $whohavepost=$arrlike['data_id'];
            $addcomment =$database->prepare("INSERT INTO `comment` (`posts_id`, `client_like_id`, `id_who_have_post`, `comment`) VALUE(:postid,:clientcomment,:whopost,:com)");
            $addcomment->bindparam("postid", $id_post);
            $addcomment->bindparam("clientcomment", $myid);
            $addcomment->bindparam("whopost", $whohavepost);
            $addcomment->bindparam("com", $comment);
            $addcomment ->execute();
            
            $commente=$arrlike["comment"];
            $commente=$commente + 1;
    
            $addlike = $database->prepare("UPDATE posts SET `comment`=$commente WHERE id = $id_post");
            $addlike ->execute();
        }

        }
        $puplish_comment=$database->prepare("SELECT * FROM comment WHERE posts_id=$id_post"); 
        $puplish_comment->execute();
        foreach($puplish_comment AS $comm){
            $client_id=$comm['client_like_id'];
            $client=$database->prepare("SELECT * FROM client_data WHERE ip=$client_id"); 
            $client->execute();
            
            foreach($client AS $data){
                $getphotoclient="data:".$data['type_photo'].";base64,".base64_encode($data['file']);
                echo '<img class="photo_commenter" hight="10%" width="10%" src="'.$getphotoclient.'"/><form method="POST" enctype="multipart/form-data"><button type="submit" class="fbuttons" name="b'.$data['ip'].'"><h3 >'. $data['f_name'].' '.$data['l_name'].'</h3></button><input type="hidden" value="'.$data['ip'].'" name="i1'.$data['ip'].'"/></form>'  ;
                
               /*
                $getphotoclient="data:".$data['type_photo'].";base64,".base64_encode($data['file']);
                echo '<img class="photo_commenter" hight="10%" width="10%" src="'.$getphotoclient.'"/><img class="imglike"src="icons/124-thumb-up-solid.png"/><form method="POST" enctype="multipart/form-data"><button type="submit" class="fbuttons" name="b'.$data['ip'].'"><h3 class="name_client">'.$data['f_name'].$data['l_name'].'</h3></button><input type="hidden" value="'.$data['ip'].'" name="i1'.$data['ip'].'"/></form>'  ;
                */
                if (isset($_POST['b'.$data["ip"]])) {
                    $id_anither_client=$_POST['i1'.$data["ip"]];
                
                    $_SESSION["id_frind"]=$id_anither_client;
                    header("location: friend_page.php");
                    ob_end_flush();
                }
                
            
            }

            echo '<div class="h3"><p class="comment">'. $comm['comment'].'</p><br></div><br>';
            
        }
        ?>
     </div>
 </body>
</html>