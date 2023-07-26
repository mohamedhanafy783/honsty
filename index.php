<?php
ob_start();
session_start();
?>

<html>
<head>
    
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>enter page </title>
    <link rel="stylesheet" type="text/css" href="enter.css"/>
    <style>
            * {
            padding: 0;
            margin: 0;
            outline: 0;
        }

        body {
            background-color: rgb(242, 244, 248);
        }

        form {
            width: 20%;
            height: 33%;
            margin-left: 40%;
            margin-right: 40%;
            margin-top: 6%;
            background-color: rgba(255, 255, 255, 0.897);
            border-radius: 05px;
            box-shadow: 1px 1px 2px 2px grey;
        }

        input {
            margin-left: 10%;
            margin-right: 10%;
            width: 80%;
            height: 10%;
            border: 1px;
            border-radius: 05px;
            padding: 5px 8px 5px 8px;
            box-shadow: 1px 1px 2px 2px grey;
        }

        .p1 {
            margin-left: 10%;
            margin-top: 5%;
        }

        .error {
            text-align: center;
            margin-bottom: 5%;
            color: brown;
        }

        button {
            height: 15%;
            width: 20%;
            margin: 3% 40% 1% 40%;
            background-color: rgba(245, 250, 255, 0.897);
            border-radius: 05px;
            box-shadow: 1px 1px 2px 2px grey;
        }

        h2{
            text-align: center;
        }

        @media only screen and (min-width:451px) and (max-width: 1200px) {
            form {
                width: 60%;
                height: 40%;
                margin-left: 20%;
                margin-right: 20%;
                margin-top: 6%;
                background-color: rgba(255, 255, 255, 0.897);
                border-radius: 05px;
                box-shadow: 1px 1px 2px 2px grey;
            }
        } 
        @media only screen and (min-width:1px) and (max-width: 500px) {
            form {
                width: 100%;
                height: 40%;
                margin-left: 0%;
                margin-right: 0%;
                margin-top: 6%;
                background-color: rgba(255, 255, 255, 0.897);
                border-radius: 05px;
                box-shadow: 1px 1px 2px 2px grey;
            }
        }
    </style>
</head>
<body>

<form method="POST">

    <p class="p1" >phone numper :</p>
    <input type="text" name="phone"/>
    <p class="p1">password :</p>
    <input type="text"name="password"/>

    <button type="subment" name="login">login</button>





<?php

if (isset($_POST['login'])) {
    //inter database
    $username="root";
    $password="";
    $database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);
    //storage data 
    $phone =$_POST['phone'];
    $password=$_POST['password'];
    //search in data base 
    $search = $database->prepare("SELECT * FROM client_data WHERE phon = $phone AND password LIKE '$password'");
    $search->execute();
    //sure this data in data base or no 
    if ($search->rowCount()===1) {
        foreach($search As $result){
            
            $_SESSION["id"]=$result['ip'];
            $id=$result['ip'];
            //insert in end_chat
            $check=$database->prepare("SELECT * FROM `end_chat` WHERE `my_id` = $id ");
            $check->execute();
            if ($check->rowCount()!==1){
                 $add=$database->prepare("INSERT INTO `end_chat` (`my_id`) VALUE($id) ");
                 $add->execute();
            }
            //insert in end_like
            $check=$database->prepare("SELECT * FROM `end_like` WHERE `my_id` = $id ");
            $check->execute();
            if ($check->rowCount()!==1){
                 $add=$database->prepare("INSERT INTO `end_like` (`my_id`) VALUE($id) ");
                 $add->execute();
            }
            //insert in end_comment
            $check=$database->prepare("SELECT * FROM `end_comment` WHERE `my_id` = $id ");
            $check->execute();
            if ($check->rowCount()!==1){
                 $add=$database->prepare("INSERT INTO `end_comment` (`my_id`) VALUE($id) ");
                 $add->execute();
            }
            //insert in end_d_like
            $check=$database->prepare("SELECT * FROM `end_d_like` WHERE `my_id` = $id ");
            $check->execute();
            if ($check->rowCount()!==1){
                 $add=$database->prepare("INSERT INTO `end_d_like` (`my_id`) VALUE($id) ");
                 $add->execute();
            }
            

        }

        header("location:home.php");
        ob_end_flush();

    }
    else{
        echo '<p class="error">pass or phon is error!!!</p>';
    }
    
}
?>
<h2><a href="f_data.php">sign up</a></h2>
</form>
</body>
</html>