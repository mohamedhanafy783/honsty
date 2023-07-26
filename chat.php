<?php
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

        .taskbar {
        
            margin: 0% 33% 0% 32.5%;
            background-color: rgb(255, 255, 255);
            position: fixed;
            box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
            border-radius: 05px;
        }

        .iconchat{
            height: 7%;
            width: 7%;
            margin-left:5%;
            margin-top: 1%;
            margin-bottom: 1%;
            border-radius: 50%;
            
            
            display: inline-block;
            vertical-align: middle;
            
        }

        .name_client{
            text-align: right;
            margin-left: 3%;
            
            display: inline-block;

        }

        .div1 {
            
            margin: 0% 33% 2% 33%;
            background-color: rgb(255, 255, 255);
            box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
            border-radius: 05px;
            
        }

            
        .in_send {
            height: 4%;
            width: 28%;
            position: fixed;
            box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
            margin-top: 37%;
            margin-left: 1%;
            border-radius: 05px;
            border-style: hidden;
        }

        .b_send {
            height: 4%;
            width: 3%;
            position: fixed;
            box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
            margin: 37% 0% 0% 30%;
            background-color: rgb(255, 255, 255);
            border-style: hidden;
            border-radius: 05px;
        }

        .img_send {
            height: 80%;
            width: 80%;
        }

        .friend{
            text-align: right;
            margin-right: 5%;
            margin-left: 20%;
            background-color: rgb(209, 208, 211);
            border-width: 2%;
            border-color:  rgb(0, 208, 211);
            
        }

        .friendchat{
            
            background-color: rgb(255, 255, 255);
            text-align: right;
            margin-right: 1%;
            margin-left: 1%;
            border-style:dashed;
            border-color:  rgb(209, 208, 211);
            
            
        }

        .me{
            text-align: left;
            margin-right: 20%;
            margin-left: 5%;
            background-color: rgb(209, 208, 211);
            border-width: 2%;
            border-color:  rgb(0, 208, 211);
        }

        .mychat{
            background-color: rgb(255, 255, 255);
            text-align: left;
            margin-right: 1%;
            margin-left: 1%;
            border-style:dashed;
            border-color:  rgb(209, 208, 211);
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

    .in_send {
        height: 4%;
        width: 80%;
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        margin-top: 100%;
        margin-left: 1%;
        border-radius: 05px;
        border-style: hidden;
    }

    .b_send {
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
<div class="taskbar">
    <?php
        //data desblay data
        
        
        $myid=$_SESSION['id'];
        $idchat=$_SESSION["id_chat"];
        //open data base 
        $username="root";
        $password="";
        $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
        //tasckbar and photon friend
        $friendchat = $database->prepare("SELECT * FROM `who_chat` WHERE `id`=$idchat ");
        $friendchat ->execute();
        foreach ($friendchat as $data){
            $data_id=$data['friend_id'];
            $fdata_id=$data['my_id'];
            if($fdata_id===$myid){
                $photo = $database->prepare("SELECT * FROM client_data WHERE ip= $data_id ");
                $photo ->execute();
                foreach ($photo as $link) {
                    $getphotoclient="data:".$link['type_photo'].";base64,".base64_encode($link['file']);
                    echo '<img class="iconchat"  src="'.$getphotoclient.'">';
                    echo '<h4 class="name_client">'.$link['f_name'].$link['l_name'].'</h4> ';
                }
            }else{
                $photo = $database->prepare("SELECT * FROM client_data WHERE ip= $fdata_id ");
                $photo ->execute();
                foreach ($photo as $link) {
                    $getphotoclient="data:".$link['type_photo'].";base64,".base64_encode($link['file']);
                    echo '<img class="iconchat"  src="'.$getphotoclient.'">';
                    echo '<h4 class="name_client">'.$link['f_name'].$link['l_name'].'</h4> ';
                }
            }
        }
    ?>
    
    
  </div>
  <br>
  <br>
  <br>
  <br>
<div class="div1"> 
    <br>
    
    <form method="POST" enctype="multipart/form-data" >
        <input type="text" class="in_send" id="massege" name="massege"/>
        <button type="submit" class="b_send" name="send"  ><img class="img_send" src="161-trending-flat-outline.png"/></button>
    </form>
    <?php
        //data desblay data
        
        $myid=$_SESSION['id'];
        $idchat=$_SESSION["id_chat"];
        //open data base 
        $username="root";
        $password="";
        $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
        //tasckbar and photon friend up up up up *****

        //get id of recieve massege 
        $getid=$database->prepare("SELECT * FROM `who_chat` WHERE `id`=$idchat");
        $getid->execute();
        foreach ($getid as $reciver) {
            $check=$reciver['friend_id'];
            if ($check!==$myid) {
                $id_reciver=$check;
            } else {
                $id_reciver=$reciver['my_id'];
            }

        
        
        
            //send massege
            if (isset($_POST['send'])) {
                $massege=$_POST['massege'];
                echo'<script>window.history.back();</script>';
                $addmassege =$database->prepare("INSERT INTO `chat` (`chat_id`, `my_id`, `id_recive`, `chat`) VALUE(:chatid, :myid, :idreciver, :chat)");
                $addmassege->bindParam("chatid", $idchat);
                $addmassege->bindParam("myid", $myid);
                $addmassege->bindParam("idreciver", $id_reciver);
                $addmassege->bindParam("chat", $massege);
                $addmassege->execute();

                //document.getElementById('year3').value = year3;inbut become empty
            //echo'<script>var massege=" ";document.getElementById("massege").value = massege;</script>';
            }
        }
        //desplay chat
        $puplish_massege=$database->prepare("SELECT * FROM `chat` WHERE chat_id=$idchat"); 
        $puplish_massege->execute();
        foreach($puplish_massege AS $massege){
            $client_id=$massege['my_id'];
            $client=$database->prepare("SELECT * FROM `client_data` WHERE `ip`=$client_id"); 
            $client->execute();
            
            foreach($client AS $data){
                $check_id=$data['ip'];
                if ($check_id===$myid){
                    echo '<div class="me"><h3 >Me</h3><div class="mychat"><p>'. $massege['chat'].'</p></div></div>';
                }else{
                    echo '<div class="friend"><p >'. $data['f_name'].' '.$data['l_name'].'</p><div class="friendchat"><p>'. $massege['chat'].'</p></div></div>';
                }
            }
            $id=$massege['id'];
            $id_endmassege=$database->prepare("UPDATE `who_chat` SET `end_id`= $id WHERE id=$idchat");
            $id_endmassege->execute();
            
        }
        

    ?>
    <br>
    <br>
</div>
</body>
</html>