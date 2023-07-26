<?php
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>add post</title>
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
<body>


    <div class="div1">
        <form method="POST" enctype="multipart/form-data">
        <input type="text" name="text"/>
        <input type="file" name="file" accept="image/*" />
        <button type="submit" name="puplish">puplish</button>

        </form>
    </div>
<?php
//this id open my data in database

$id=$_SESSION['id'];

//data text I wright it 



//inter database 
$username="root";
$password="";
$database=new PDO ("mysql:host=localhost;dbname=honsty;",$username,$password);

//make puplish when click on button his name puplish
if (isset($_POST['puplish'])){
    echo'<script>window.history.back()</script>';
    $text = $_POST['text'];
    $filetype=$_FILES['file']["type"];
    $filename=$_FILES['file']["name"];
    $file = file_get_contents( $_FILES['file']["tmp_name"]);

    
   //inter data in data base 
    $uploudfile=$database->prepare("INSERT INTO `posts` (`data_id`, `text`, `name`, `type`, `file`)
     VALUE (:id,:text,:filename,:filetype,:file)");
    $uploudfile->bindParam("id",$id);
    $uploudfile->bindParam("text",$text);
    $uploudfile->bindParam("filename",$filename);
    $uploudfile->bindParam("filetype",$filetype);
    $uploudfile->bindParam("file",$file);
    $uploudfile->execute();
    //insert data of post in table friend 
    //get end of post to stor it in table friend 
    $getpost=$database->prepare("SELECT * FROM `posts` WHERE `data_id`= $id ORDER BY `id` DESC");
    $getpost->execute();
    foreach ($getpost as $post) {
        $id_post=$post['id'];
        //get id of followme in taple friend
        $getfollowme= $database->prepare("SELECT * FROM `friends` WHERE `friend_id`= $id");
        $getfollowme ->execute();
        foreach ($getfollowme as $data) {
            $followme=$data['client_id'];
            $savepostfriend=$database->prepare("INSERT INTO `post_frind`(`id_post`,`id_who_have_post`,`id_friend`) VALUE(:idpost,:havepost,:idfriend)");
            $savepostfriend->bindParam("idpost",$id_post);
            $savepostfriend->bindParam("havepost",$id);
            $savepostfriend->bindParam("idfriend",$followme);
            $savepostfriend->execute();
        }
        break;
    }

    //go world page and home page 
    

}

?>
    

</body>
</html>