<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>traitement edition de produit</title>
</head>
<body>
<header>
        <?php
            require_once "navbar.php";
        ?>
    </header>
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

        
/*upload photo*/ if(isset($_FILES['image_produit'])){
    $repertoireDestination = "assets/";
    $photo_produit = $repertoireDestination . basename($_FILES['image_produit']['name']);
        $_POST['image_produit'] = $photo_produit;
        if(move_uploaded_file($_FILES['image_produit']['tmp_name'], $photo_produit)){
            echo "<p class='alert alert-primary'>photo bien telechargee</p>";
        }else{
            echo "error";
        }
}

$sql = "UPDATE `produits`SET `nom_produit`= ?, `description_produit` = ?, `prix_produit` = ?, `stock_produit` = ?, `date_depot` = ?, `image_produit` = ?, `categorie_id` = ?, `vendeur_id` = ?) WHERE id_produit = ?)";
    $insert = $dbh->prepare($sql);      
          $insert->execute(
            array(
                $_POST['nom_produit'],
                $_POST['description_produit'],
                $_POST['prix_produit'],
                $_POST['stock_produit'],
                $_POST['date_depot'],
                $_POST['image_produit'],
                $_POST['categorie_id'],
                $_POST['vendeur_id'],
/*recuperation de l id dans l url*/ $_GET['id_produit']
            )
        );

    if($update){
        echo "<p class='container alert alert-success'>Votre produit a été mis a jour avec succès !</p>";
        echo "<div class='text-center'><a href='produits.php' class='container btn btn-success'>Voir mon produit</a></div> ";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de la mise a jour  du produit</p>";
    };