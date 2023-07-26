<?php
ob_start();
session_start();
//open data base 
$username="root";
$password="";
$database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
//this id open my data in database
$id=$_SESSION['id'];
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>home</title>
    <link rel="stylesheet" href="home.css">
    <style>
      body {
    background-color: rgb(242, 244, 248);
}

.taskbar {
    margin: 0% 33% 2% 32.5%;
    background-color: rgb(255, 255, 255);
    position: fixed;
    box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
    border-radius: 05px;
}

.search{
    height: 4%;
    width: 8%;
    margin-left: 4%;
}

.b_notic{
    background-color: rgb(255, 255, 255);
    height: 6.5%;
    width: 6.5%;
    margin-left: 10%;
    border-style: hidden;
}

.notic{
    height: 100%;
    width: 100%;
}

.icon_mypage {
    height: 4%;
    width: 5%;
    margin-left: 10%;
}

.world{
    height: 4%;
    width: 4%;
    margin-left: 10%;
}

.icon_home {
    height: 4%;
    width: 5%;
    margin-left: 8%;
}

.logo{
    height: 4%;
    width: 10%;
    margin-left: 6%;
    margin-right: 4%;

}

.icon_add_post {
    height: 5%;
    width: 3%;
    margin-left: 26%;
    margin-top: 39%;
    position: fixed;
}

.posts {
    margin: 0% 33% 2% 33%;
    background-color: rgb(255, 255, 255);
    box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
    border-radius: 05px;
}

.photo_client {
    margin-left: 45%;
    height: 7%;
    width: 10%;
    border-radius: 50%;
}

.button_name_client {
    height: 5%;
    width: 100%;
    background-color: rgb(255, 255, 255);
    border-style: hidden;
}

.name_client {
    text-align: center;
}

.text_post {
    text-align: right;
    margin-right: 10px;
}

.photo_post {
    width: 100%;
    height: 70%;
}

.fbuttons{
    height: 5%;
    width: 50%;
    background-color: rgb(255, 255, 255);
    border-style: hidden;
}

.buttons {
    height: 5%;
    width: 33%;
    background-color: rgb(255, 255, 255);
    border-style: hidden;
}

.dlike {
    height: 100%;
    width: 28%;
}

.comment {
    height: 100%;
    width: 28%;
}

.like {
    height: 100%;
    width: 28%;
}

.hr {
    border: 1px;
    height: 5px;
    width: 97%;
    border-color: rgb(255, 255, 255);
}

.dlike1 {
    height: 3%;
    width: 4%;
}

.like1 {
    height: 3%;
    width: 4%;
    align-items: right;
}


.personal_photo {
    margin-left: 68%;
    height: 20%;
    width: 28%;
    border-radius: 50%;
}

h3 {
    text-align: right;
    margin-right: 5%;
}

@media screen and (min-width:451px) and (max-width: 1200px) {
    .taskbar {
        margin: 0% 20% 2% 19.5%;
        background-color: rgb(255, 255, 255);
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
    }
    .posts {
        margin: 0% 20% 2% 20%;
        background-color: rgb(255, 255, 255);
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
    }
    .photo_client {
        margin-left: 45%;
        height: 7%;
        width: 10%;
        border-radius: 50%;
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
    .posts {
        margin: 0% 0% 2% 0%;
        background-color: rgb(255, 255, 255);
        box-shadow: 2px 2px 2px 2px rgb(209, 208, 211);
        border-radius: 05px;
    }
    .photo_client {
        margin-left: 45%;
        height: 7%;
        width: 10%;
        border-radius: 50%;
    }

    .icon_add_post {
    height: 8%;
    width: 8%;
    margin-left: 80%;
    margin-top: 110%;
    position: fixed;
}
}
    </style>
  </head>
  <body>
  
  <div class="taskbar">
    <br>
    <form method="POST" enctype="multipart/form-data">
    <a href="search.php"><img class="search" src="42-search-outline.png"/></a>

    <button name="notic" class="b_notic"><img class="notic" src="bell.png"/><?php
        //check number of like and dislike and comment
    //checknumber in like 
    $check=$database->prepare("SELECT * FROM `end_like` WHERE `my_id` = $id ");
    $check->execute();
    $count=$database->prepare("SELECT * FROM `like` WHERE `id_who_have_post` = $id ");
    $count->execute();
    $var=$count->rowCount();
    foreach ($check as $num) {
        $number=$var-$num['end_number'];
    }
    //checknumber in comment
    $check=$database->prepare("SELECT * FROM `end_comment` WHERE `my_id` = $id ");
    $check->execute();
    $count=$database->prepare("SELECT * FROM `comment` WHERE `id_who_have_post` = $id ");
    $count->execute();
    $var=$count->rowCount();
    foreach ($check as $num) {
        $number=$number+($var-$num['end_number']);
    }
    //checknumber in dis_like
    $check=$database->prepare("SELECT * FROM `end_d_like` WHERE `my_id` = $id ");
    $check->execute();
    $count=$database->prepare("SELECT * FROM `d_like` WHERE `id_who_have_post` = $id ");
    $count->execute();
    $var=$count->rowCount();
    foreach ($check as $num) {
        $number=$number+($var-$num['end_number']);
    }
    echo '<label>'.$number.'</label>';
    ?></button>
    
    <a href="mypage.php"><img class="icon_mypage" src="8-account-outline.png" /> </a> 

    <a href="world.php"><img class="world" src="globe (1).png"/></a>

    <a href="home.php"><img class="icon_home" src="41-home-solid.png" /></a>
    <img class="logo" src="pharaoh (6).png"/>
    </form>
    <br>
  </div>
  <br>
  <br>
  <br>
  <br>
  
  <div class="posts">
  
    <?php 
      
      echo '<a href="img_post.php"><img class="icon_add_post" src="40-add-card-outline.png" /></a>';
        
        //header to notic page
        if(isset($_POST['notic'])){
            $count=$database->prepare("SELECT * FROM `like` WHERE `id_who_have_post` = $id ");
            $count->execute();
            $var=$count->rowCount();
            $update=$database->prepare("UPDATE `end_like` SET `end_number`=$var WHERE my_id =$id" );
            $update->execute();
            header("location: notic.php");
        }
        
        //get id of posts i follow him
        $getidpost=$database->prepare("SELECT * FROM `post_frind` WHERE `id_friend`=$id ORDER BY id DESC ");
        $getidpost->execute();
        //puplish posts of i follow
        foreach($getidpost AS $idpost){
          $post_id=$idpost['id_post'];
        
         // get of data frome data base 
          $publish = $database->prepare("SELECT * FROM posts WHERE `id`=$post_id ORDER BY id DESC ");
          $publish ->execute();
          
         //object become array 
          foreach ($publish as $result) {
              $getpost="data:".$result['type'].";base64,".base64_encode($result['file']);
              echo "<br>";
              $data_id=$result['data_id'];
              $photo = $database->prepare("SELECT * FROM client_data WHERE ip= $data_id ");
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
                  }
              }

              //posts client
              if ($result['name']=="") {
                echo '<p class="text_post">'.$result['text'].'</p><br>';
                
            }else{
                echo '<p class="text_post">'.$result['text'].'</p><br>'; 
                echo '<img class="photo_post" hieght="10%" width="10%" src="'.$getpost.'">' ;
            }
              //show fans and notfans
              echo '<form method="POST" enctype="multipart/form-data"><input type="hidden" name="i'.$result['id'].'" value="'.$result['id'].'"/><button type="submit" class="fbuttons" name="nf'.$result['id'].'">notfans</button><button type="submit" class="fbuttons" name="f'.$result['id'].'">fans</button></form>';
              //show like and dlike
              //button dlike,comment ,like
                 $id_like=$result["id"];

                  $search = $database->prepare("SELECT * FROM `like` WHERE `post_id` = $id_like AND `client_id`=$id ");
                  $search->execute();
                  $get = $database->prepare("SELECT * FROM `d_like` WHERE `post_id`=$id_like AND `client_data`=$id");
                  $get->execute();
                if ($search->rowCount()===1) {
                    echo '<form method="POST" enctype="multipart/form-data"><input type="hidden" name="i'.$result['id'].'" value="'.$result['id'].'"/><button type="submit" class="buttons" name="d'.$result['id'].'">'.$result['dlike'].'<img class="dlike" src="125-thumb-down-outline (1).png"/></button><button type="submit" class="buttons" name="c'.$result['id'].'"><img class="comment" src="47-chat-outline.png"/></button><button type="submit" class="buttons" name="li'.$result['id'].'"><img class="like" src="124-thumb-up-solid.png"/>'.$result['like'].'</button></form>';
                    echo '<hr class="hr">';
                }elseif ($get->rowCount()===1) {
                    echo '<form method="POST" enctype="multipart/form-data"><input type="hidden" name="i'.$result['id'].'" value="'.$result['id'].'"/><button type="submit" class="buttons" name="di'.$result['id'].'">'.$result['dlike'].'<img class="dlike" src="125-thumb-down-solid (1).png"/></button><button type="submit" class="buttons" name="c'.$result['id'].'"><img class="comment" src="47-chat-outline.png"/></button><button type="submit" class="buttons" name="l'.$result['id'].'"><img class="like" src="124-thumb-up-outline.png"/>'.$result['like'].'</button></form>';
                    echo '<hr class="hr">';
                }else{
                    echo '<form method="POST" enctype="multipart/form-data"><input type="hidden" name="i'.$result['id'].'" value="'.$result['id'].'"/><button type="submit" class="buttons" name="d'.$result['id'].'">'.$result['dlike'].'<img class="dlike" src="125-thumb-down-outline (1).png"/></button><button type="submit" class="buttons" name="c'.$result['id'].'"><img class="comment" src="47-chat-outline.png"/></button><button type="submit" class="buttons" name="l'.$result['id'].'"><img class="like" src="124-thumb-up-outline.png"/>'.$result['like'].'</button></form>';
                    echo '<hr class="hr">';
                }
                //decreas like
                if (isset($_POST['li'.$result["id"]])){
                    echo'<script>window.history.back()</script>';
                    $id_like=$_POST['i'.$result["id"]];
                    $getlike = $database->prepare("SELECT * FROM posts WHERE id= $id_like  ");
                    $getlike ->execute();
                    $deletelike=$database->prepare("DELETE FROM `like` WHERE `client_id`=$id && `post_id`=  $id_like ");
                    
                    $deletelike->execute();
                    foreach ($getlike as $arrlike) {
                        $like=$arrlike["like"];
                        $like=$like-1;
                    
                        $addlike = $database->prepare("UPDATE posts SET `like`=$like WHERE id = $id_like");
                        $addlike ->execute();
                    }
                }
              //opration increese like
              if (isset($_POST['l'.$result["id"]])) {
                  echo'<script>window.history.back()</script>';
                   
                  $id_like=$_POST['i'.$result["id"]];

                  $search = $database->prepare("SELECT * FROM `like` WHERE `post_id` = $id_like AND `client_id`=$id ");
                  $search->execute();
                  $get = $database->prepare("SELECT * FROM `d_like` WHERE `post_id`=$id_like AND `client_data`=$id");
                  $get->execute();

                  if ($search->rowCount()!==1&&$get->rowCount()!==1) {
                    $getlike = $database->prepare("SELECT * FROM posts WHERE id= $id_like  ");
                    $getlike ->execute();
                    foreach ($getlike as $arrlike) {
                        $whohavepost=$arrlike['data_id'];
                        $addlike=$database->prepare("INSERT INTO `like` ( `post_id`, `client_id`,`id_who_have_post`) VALUE(:id_post,:id,:who_have_post)");
                        $addlike->bindparam("id_post", $id_like);
                        $addlike->bindparam("id", $id);
                        $addlike->bindparam("who_have_post", $whohavepost);
                        $addlike->execute();
                    
                        $like=$arrlike["like"];
                        $like=$like+1;
                    
                        $addlike = $database->prepare("UPDATE posts SET `like`=$like WHERE id = $id_like");
                        $addlike ->execute();
                    }
                }
            }
            //decreese d_like
            if (isset($_POST['di'.$result["id"]])){
                echo'<script>window.history.back()</script>';
                $id_like=$_POST['i'.$result["id"]];
                $getlike = $database->prepare("SELECT * FROM posts WHERE id= $id_like  ");
                $getlike ->execute();
                $deletelike=$database->prepare("DELETE FROM `d_like` WHERE `client_data`=$id && `post_id`=  $id_like ");
                
                $deletelike->execute();
                foreach ($getlike as $arrlike) {
                    $like=$arrlike["dlike"];
                    $like=$like-1;
                
                    $addlike = $database->prepare("UPDATE posts SET `dlike`=$like WHERE id = $id_like");
                    $addlike ->execute();
                }
            }
              //opration increese dlike
              if (isset($_POST['d'.$result["id"]])) {
                  echo'<script>window.history.back()</script>';
                  $id_like=$_POST['i'.$result["id"]];
                  $search = $database->prepare("SELECT * FROM `like` WHERE `post_id` = $id_like AND `client_id`=$id ");
                  $search->execute();
                  $get = $database->prepare("SELECT * FROM `d_like` WHERE `post_id`=$id_like AND `client_data`=$id");
                  $get->execute();

                if ($get->rowCount()!==1&&$search->rowCount()!==1) {
                      $getlike = $database->prepare("SELECT * FROM posts WHERE id= $id_like  ");
                      $getlike ->execute();
                      foreach ($getlike as $arrlike) {
                      $whohavepost=$arrlike['data_id'];
                      $adddlike=$database->prepare("INSERT INTO `d_like` ( `post_id`, `client_data`,`id_who_have_post`) VALUE(:iid_post,:iid,:who_have_post)");
                      $adddlike->bindparam("iid_post", $id_like);
                      $adddlike->bindparam("iid", $id);
                      $adddlike->bindparam("who_have_post",$whohavepost );
                      $adddlike->execute();
                      
                          $like=$arrlike["dlike"];
                          $like=$like+1;
                   
                          $addlike = $database->prepare("UPDATE posts SET `dlike`=$like WHERE id = $id_like");
                          $addlike ->execute();
                      }
                  }
              }
              //opration increese comment
              if (isset($_POST['c'.$result["id"]])) {
                $_SESSION['id_post']=$_POST['i'.$result["id"]];
                header('location: comment.php');
                
              }
              //opration show who notfans
              if (isset($_POST['nf'.$result["id"]])) {
                $_SESSION['id_post']=$_POST['i'.$result["id"]];
                header('location: notfans.php');
               
              }
              //opration show who fans
              if (isset($_POST['f'.$result["id"]])) {
                $_SESSION['id_post']=$_POST['i'.$result["id"]];
                header('location: fans.php');
                ob_end_flush();
              }
          }      
        } 
          
          
         
          
        
        ?> 
  
  </div>
   
  
         
  </body>
</html>