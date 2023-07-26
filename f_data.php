
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>client data</title>
        <link rel="stylesheet" href="client_data.css">
        <style>
            .form_data {
                margin-left: 30%;
                margin-right: 35%;
                margin-top: 6%;
                background-color: rgba(245, 250, 255, 0.897);
                border-radius: 05px;
                box-shadow: 1px 1px 2px 2px grey;
            }

            input {
                margin: 3% 3% 3% 3%;
                width: 90%;
                height: 150%;
                border: 1px;
                border-radius: 05px;
                padding: 5px 8px 5px 8px;
                box-shadow: 1px 1px 2px 2px grey;
            }

            p {
                text-align: center;
                margin-bottom: 5%;
                color: brown;
            }

            table {
                margin: 3% 3% 3% 3%;
            }

            .sub {
                height: 3%;
                width: 10%;
                margin: 3% 50% 3% 45%;
                background-color: rgba(245, 250, 255, 0.897);
                border-radius: 05px;
                box-shadow: 1px 1px 2px 2px grey;
            }

            h1{
                text-align: center;
            }

            h3{
                text-align: center;
            }
            @media only screen and (min-width:451px) and (max-width: 1200px){
                .form_data { 
                    width: 60%;
                    height: 80%;
                    margin-left: 20%;
                    margin-right: 20%;
                    margin-top: 6%;
                    background-color: rgba(245, 250, 255, 0.897);
                    border-radius: 05px;
                    box-shadow: 1px 1px 2px 2px grey;
            } 
            }
            @media only screen and (min-width:1px) and (max-width: 500px) {
                .form_data { 
                    width: 100%;
                    height: 80%;
                    margin-left: 0%;
                    margin-right: 0%;
                    margin-top: 6%;
                    background-color: rgba(245, 250, 255, 0.897);
                    border-radius: 05px;
                    box-shadow: 1px 1px 2px 2px grey;
            }
            }
        </style>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data" class="form_data">
            <table>
                    <tr>
                        <td>First Name</td>
                        <td>Scande Name</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="input_data" name="f_name" /></td>

                        <td><input type="text" class="input_data" name="s_name" /></td>
                    </tr>
                    <tr>
                        <td>Phone number</td>
                    </tr>
                    <tr>
                        <td> <input type="text" class="input_data" name="ph_numb" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td><input type="password" class="input_data" name="f_password" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td><input type="password" class="input_data" name="s_password" /></td>
                    </tr>
                    
                    <tr>
                        <td>Age</td>
                    </tr>
                    <tr>
                        <td><input type="number" class="input_data" name="age" /></td>
                    </tr>
                    <tr>
                        <td>country</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="input_data" name="country" required/></td>
                    </tr>
                    <tr>
                    <td><input type="file" name="file"  /></td> 
                    </tr>
                    <tr>
                        <td>

                        </td>
                            <td>
                            
                            </td>
                    </tr>
                </table>
                <button type="submit" name="sub" class="sub" >sub</button>
                <a href="enter.php"><h3>singin</h3></a>

        
<?php
ob_start();
  




//opration stor data and create account 
if (isset($_POST['sub'])){
    //data client store in variable 
    $f_name=$_POST['f_name'];
    $s_name=$_POST['s_name'];
    $phon=$_POST['ph_numb'];
    $f_password=$_POST['f_password'];
    $s_password=$_POST['s_password'];
    $age =$_POST['age'];
    $country=$_POST['country'];

    //inter data of client to create account 
    $username="root";
    $password="";
    $database= new PDO("mysql:host=localhost;dbname=honsty",$username,$password);

   //check if data inter or not
   $search = $database->prepare("SELECT * FROM client_data WHERE phon = $phon ");
    $search->execute();
    //sure this data in data base or no 
    if ($search->rowCount()===1) {
        echo "<p>error this account exists</p>";
    } 
    elseif($f_name===""){
        echo "<p>error frist name!!</p>";
    }
    elseif($s_name===""){
        echo "<p>error scend name!!</p>";
    }
    elseif($phon===""){
        echo "<p>error phone number!!</p>";
    }
    elseif($f_password===""){
        echo "<p>error password!!</p>";
    }
    elseif($s_password===""){
        echo "<p>error password!!</p>";
    }
    elseif($f_password!==$s_password){
        echo "<p>error pass1 !=pass2!!</p>";
    }
    elseif($age===""){
        echo "<p>error age!!</p>";
    }
    elseif($country===""){
        echo "<p>error country!!</p>";
    }
    else{
        
        //data of my_photo
        $filetype=$_FILES['file']["type"];
        $filename=$_FILES['file']["name"];
        $file = file_get_contents( $_FILES['file']["tmp_name"]);

        
        //add data on database
        $sql=$database->prepare("INSERT INTO `client_data` (`phon`, `f_name`, `l_name`, `password`, `age`, `country`, `name_photo`, `type_photo`, `file`) 
        VALUES (:phon,:f_name,:s_name,:f_password,:age,:country,:filename,:filetype,:file)");
        $sql->bindParam("phon",$phon);
        $sql->bindParam("f_name",$f_name);
        $sql->bindParam("s_name",$s_name);
        $sql->bindParam("f_password",$f_password);
        $sql->bindParam("age",$age);
        $sql->bindParam("country",$country);
        $sql->bindParam("filename",$filename);
        $sql->bindParam("filetype",$filetype);
        $sql->bindParam("file",$file);
        $sql->execute();
        echo"<h1>congratulation</h1>";
        ob_end_flush();
        
       
    }
    
    
}



?>
        </form>
    </body>
</html>