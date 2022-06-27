<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="mt-4 container bg-main overflow-hidden">
    <div class="row g-2">
        <?php   
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root","");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            print "error" . $e->getMessage() . "<br/>"; 
                die();
        }

        
if($dbh){
    $sql = "UPDATE `vendeurs` SET `nom_vendeur` = ?,`prenom_vendeur` = ?, `email_vendeur` = ?, `logo_vendeur` = ?, WHERE id_vendeur = ?";
        $update = $dbh->prepare($sql);
        $update->execute(array(
            $_POST['nom_vendeur'],
            $_POST['prenom_vendeur'],
            $_POST['email_vendeur'],
            $_POST['logo_vendeur'],
            $_POST['id_vendeur'],
        ));
        if($update){
            echo "<p class='container alert alert-primary'>mise a jour vendeur reussie !</p>";
        echo "<div class='text-center'><a href='vendeurs.php' class='container btn btn-warning'>vendeurs</a></div> ";
        }else{
            echo "<p class='alert alert-secondary'>Erreur </p>";
        }
}
?>
</body>
</html>