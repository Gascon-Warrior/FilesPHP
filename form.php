<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {         
        
        $uploadDir = 'img/';

        $exploded= explode('.', basename($_FILES['file']['name']));
        
        $uniqName= uniqid($exploded[0]);
       
        $fullUniqId= $uniqName .'.'. $exploded[1];
        
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
       
        $maxFileSize = 1000000;

        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        $authorizedExtensions = ['jpg','jpeg','png'];

        $errors= [];
        if (!in_array($extension, $authorizedExtensions)){
            $errors[] = 'Veuillez respecter les extensions demandées Jpg ou Jpeg ou Png  !';
        }

        if( file_exists($_FILES['file']['tmp_name']) && filesize($_FILES['file']['tmp_name']) > $maxFileSize)
        {
        $errors[] = "Votre fichier doit faire moins de 1M !";
        }

        if (empty($errors)) {
            # code...
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
            
            echo '<div class="card"> <h1>SPRINGFIELD, IL</h1>
                <div class="info">
                    <div>LISENCE# <br> 1254792</div>
                    <div>BIRTH DATE <br> 15/10/89</div>
                    <div>EXPIRE <br> 4.25.22</div>
                    <div>CLASS <br> NONE</div>
                </div>  
                
                <div class="adress">
                <img src=img/'.basename($_FILES["file"]["name"]) .'> 
                <div class="ordre">
                    <div>Name: ' .$_POST["name"] . '</div><br>
                    <div>firstName: ' .$_POST["firstname"] . '</div><br>
                    <div>Age: ' .$_POST["age"] . '</div><br>
                </div>
                </div>
            </div>';
        }       
        
        var_dump($errors);
    }
?>

    <form style="background-color: lightgrey;" action="" method='post' enctype="multipart/form-data">
        <label for="file">Choississez une photo</label><br>
            <input type="file" name="file" id="file"><br>
        <label for="name">Votre nom</label><br>
            <input type="text" name="name" id="name"><br>
        <label for="firstname">Votre prénom</label><br>
            <input type="text" name="firstname" id="firstname"><br> 
         <label for="age">Votre age</label><br>
            <input type="number" name="age" id="age"><br> 
        <button name="send">Envoyer</button><br>
        
    </form>
</body>
</html>