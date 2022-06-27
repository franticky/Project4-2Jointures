<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $user = "root";
    $pass = "";
    try{
        $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "connection a pdo";                
    }catch(PDOException $e){
        print "erreur" . $e->getMessage() . "<br/>";
        die();
    }
    
    if($dbh){
        $sql = "INSERT INTO `categories`(`id_categorie`, `categories`) VALUES (?,?)";
            $insert = $dbh->prepare($sql);
                $insert->bindParam(1, $_POST['id_categorie']);
                $insert->bindParam(2, $_POST['categories']);
                $insert->execute(array(
                   $_POST['id_categorie'],
                   $_POST['categorie'],
                ));

                if($insert){
                    echo"<p class='container alert alert-warning'>categorie ajoutée</p>";
                    echo "<div class='text-center'<a href='categories.php' class='container btn btn-success'>voir les categories</div>";
                }else{
                    echo "<p class='container alert alert-warning'>categorie ajoutée</p>";
                
   
                };
            }
    ?>
</body>
</html>