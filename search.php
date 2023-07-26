<?php
ob_start();
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>search</title>
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

    .in_search {
        height: 4%;
        width: 25%;
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        margin-top: 0%;
        margin-left: 0.5%;
        border-radius: 05px;
        border-style: hidden;
    }

    .b_search {
        height: 4%;
        width: 3%;
        position: fixed;
        box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
        margin: 0% 0% 0% 26%;
        background-color: rgb(255, 255, 255);
        border-style: hidden;
        border-radius: 05px;
    }

    .img_search {
        height: 80%;
        width: 80%;
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

    
    @media only screen and (min-width:451px) and (max-width: 1200px) {
                
        .div1 {
            margin: 0% 20% 2% 20%;
            background-color: rgb(255, 255, 255);
            box-shadow: 1px 1px 2px 2px rgb(209, 208, 211);
            border-radius: 05px;
        }
        .in_search {
        height: 4%;
        width: 50%;
        }

        .b_search {
            margin: 0% 0% 0% 52%; 
            height: 4%;
            width: 5%;
        }
        
    }

    @media only screen and (min-width:1px) and (max-width: 500px) {
        
        .div1 {
            margin: 0% 0% 2% 0%;
            background-color: rgb(255, 255, 255);
            box-shadow: 2px 2px 2px 2px rgb(209, 208, 211);
            border-radius: 05px;
        }

        .in_search {
        height: 4%;
        width: 80%;
        }

        .b_search {
            margin: 0% 0% 0% 83%; 
            height: 4%;
            width: 10%;
        }
        
    }

    </style>
</head>
<body>
    <div class="div1">
        <form method="POST" enctype="multipart/form-data" >
            <input type="text" class="in_search" id="in_search" name="in_search"/>
            <button type="submit" class="b_search" name="b_search"><img class="img_search" src="42-search-outline.png"/></button>
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php
        
        
        
        //open data base 
        $username="root";
        $password="";
        $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
        if (isset($_POST['b_search'])) {

            //explode("",$string);to convert string to array
            $string=$_POST['in_search'];
            //in search get again last variabl
            echo'<script>var in_search="'.$string.' ";document.getElementById("in_search").value = in_search;</script>';
            $array=explode(" ", $string);
            $var1=$array[0];
            $var2=$array[1];
            
            $photo = $database->prepare("SELECT * FROM `client_data` WHERE `f_name`='$var1' || `l_name`='$var2' ");
            $photo ->execute();
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
            
            $photo = $database->prepare("SELECT * FROM `client_data` WHERE `f_name`='$var1' && `l_name`='$var2' ");
            $photo ->execute();
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
            
        }
        
        $photo = $database->prepare("SELECT * FROM `client_data` ");
        $photo ->execute();
        foreach ($photo AS $link) {
            if (isset($_POST['b'.$link["ip"]])) {
                $id_anither_client=$_POST['i1'.$link["ip"]];
          
                $_SESSION["id_frind"]=$id_anither_client;
                header("location: friend_page.php");
            }
        }
    ?>

</body>
</div>
</html>