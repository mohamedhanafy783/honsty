<?php
ob_start();
session_start();
//this id open my data in database
$id=$_SESSION['id'];
//open data base 
$username="root";
$password="";
$database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
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

.buttons {
    height: 5%;
    width: 32%;
    background-color: rgb(255, 255, 255);
    border-style: hidden;
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

.fbuttons{
    height: 5%;
    width: 100%;
    background-color: rgb(255, 255, 255);
    border-style: hidden;
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
}
</style>
</head>
  <body>
  
  <div class="taskbar">
    <br>
    <form method="POST" enctype="multipart/form-data">
    <a href="search.php"><img class="search" src="42-search-outline.png"/></a>

    <button name="notic" class="b_notic"><img class="notic" src="bell (1).png"/><?php
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

    <a href="home.php"><img class="icon_home" src="41-home-outline.png" /></a>
    <img class="logo" src="pharaoh (6).png"/>
    </form>
    <br>
  </div>
  
  <div class="posts">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <form method="POST" enctype="multipart/form-data">
      <button class="buttons" name="notfans">not fans<?php
            //checknumber in dis_like
            $check=$database->prepare("SELECT * FROM `end_d_like` WHERE `my_id` = $id ");
            $check->execute();
            $count=$database->prepare("SELECT * FROM `d_like` WHERE `id_who_have_post` = $id ");
            $count->execute();
            $var=$count->rowCount();
            foreach ($check as $num) {
                $number=$var-$num['end_number'];
            }
            echo $number;
      ?></button>
      <button class="buttons" name="comment">comment<?php
            //checknumber in comment
            $check=$database->prepare("SELECT * FROM `end_comment` WHERE `my_id` = $id ");
            $check->execute();
            $count=$database->prepare("SELECT * FROM `comment` WHERE `id_who_have_post` = $id ");
            $count->execute();
            $var=$count->rowCount();
            foreach ($check as $num) {
                $number=$var-$num['end_number'];
            }
            echo $number;
      ?></button>
      <button class="buttons" name="fans">fans<?php
       //checknumber in like 
    $check=$database->prepare("SELECT * FROM `end_like` WHERE `my_id` = $id ");
    $check->execute();
    $count=$database->prepare("SELECT * FROM `like` WHERE `id_who_have_post` = $id ");
    $count->execute();
    $var=$count->rowCount();
    foreach ($check as $num) {
        $number=$var-$num['end_number'];
    }
    echo $number ;
      ?></button>

</form>
  
  <?php
  
    //header to notic page
    if(isset($_POST['notic'])){
        header("location: notic.php");
    }
    //chose like or comment or dis_like
    
    if(isset($_POST['fans'])){
        header("location: notic.php");
    }
    if(isset($_POST['comment'])){
        $count=$database->prepare("SELECT * FROM `comment` WHERE `id_who_have_post` = $id ");
        $count->execute();
        $var=$count->rowCount();
        $update=$database->prepare("UPDATE `end_comment` SET `end_number`=$var WHERE my_id =$id" );
        $update->execute();
        header("location: noticcomment.php");
    }
    if(isset($_POST['notfans'])){
        $count=$database->prepare("SELECT * FROM `d_like` WHERE `id_who_have_post` = $id ");
        $count->execute();
        $var=$count->rowCount();
        $update=$database->prepare("UPDATE `end_d_like` SET `end_number`=$var WHERE my_id =$id" );
        $update->execute();
        header("location: noticdislike.php");
    }
    
    
    
        $puplish_fans=$database->prepare("SELECT * FROM `like` WHERE `id_who_have_post`=$id ORDER BY id DESC" ); 
        $puplish_fans->execute();
        foreach($puplish_fans AS $fans){
            $client_id=$fans['client_id'];
            $post=$fans['post_id'];
            $client=$database->prepare("SELECT * FROM `client_data` WHERE `ip`=$client_id"); 
            $client->execute();
            
            foreach($client AS $data){
                $getphotoclient="data:".$data['type_photo'].";base64,".base64_encode($data['file']);
                echo '<img class="photo_commenter" hight="10%" width="10%" src="'.$getphotoclient.'"/><img class="imglike"src="icons/124-thumb-up-solid.png"/><form method="POST" enctype="multipart/form-data"><button type="submit" class="fbuttons" name="b'.$post.'"><h3 class="name_client">'.$data['f_name'].$data['l_name'].'</h3></button><input type="hidden" value="'.$post.'" name="i1'.$post.'"/></form>'  ;
                if (isset($_POST['b'.$post])) {
                    $id_anither_client=$_POST['i1'.$post];
                
                    $_SESSION['id_post']=$id_anither_client;
                    header('location: fans.php');
                   
                }
            }

        
            
        }
    
    
  ?>
  
    
  </div>
         
  </body>
</html>
