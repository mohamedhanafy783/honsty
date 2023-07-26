<?php
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>change my photo</title>
        <style>
            body {
                background-color: rgb(242, 244, 248);
            }

            .div1 {
                height: 100%;
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

            .inchange{
                display: none;
            }

            .imgchange{
                height: 10%;
                width: 12%;
                margin: 20% 0% 0% 20%;
                display: inline-block;
            }

            .button{
                height: 10%;
                width: 12%;
                background-color: rgb(255, 255, 255);
                border-style: hidden;
            }

            .imgupdate{
                margin-left: 10%;
                height: 80%;
                width: 100%;
                
            }

            h3{
                text-align: left;
                
                display: inline-block;
                vertical-align: middle;
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
</html>
<div class="div1">
    <h1>...Change Your Photo...</h1>
    <form method="POST" enctype="multipart/form-data">
        <input class="inchange" type="file" id="photo" name="photo" accept="image/*" required/>
        <label for="photo"><img class="imgchange" src="123-camera-outline.png"/><h3>Choose your photo</h3></label>
        <button class="button" type="submit" name="change"><img class="imgupdate" src="163-upgrade-outline.png"/></button>
    </form>
</div>
<?php

$id=$_SESSION['id'];

$username="root";
$password="";
$database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
if (isset($_POST['change'])){
    echo'<script>window.history.back()</script>';
    
    $filetype=$_FILES['photo']["type"];
    $filename=$_FILES['photo']["name"];
    $file = file_get_contents( $_FILES['photo']["tmp_name"]);

    

    $change=$database->prepare("UPDATE client_data SET `name_photo`=:filename, `type_photo`=:filetype, `file`=:file WHERE ip =$id");
    $change->bindparam("filename",$filename);
    $change->bindparam("filetype",$filetype);
    $change->bindparam("file",$file);
    $change->execute();

    
    
}



?>