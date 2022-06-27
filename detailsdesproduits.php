<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <title>Document</title>
</head>
<body>
<header>
        <?php
            require_once "navbar.php";
        ?>
    </header>
    <div class="mt-4 container bg-main" >
        <div class="row">
            <?php
                try{
                    $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    print"error" . $e->getMessage() . "<br/>";
                    die();
                }

                    $sql = "SELECT * FROM `produits` INNER JOIN categories ON produits.categorie_id = categories.id_categorie INNER JOIN
                    vendeurs ON produits.vendeur_id = vendeurs.id_vendeur WHERE id_produit = ?";
                $request = $dbh->prepare($sql);
                    $id = $_GET['id_produit'];
                        $request->bindParam(1, $id);
                            $request->execute();
                                $details_produit = $request->fetch();
                                ?>
                                <div class="container details_produits" >
                                    <div class="titre-produit-container" >
                                        <h2 class="text-warning">
                                            <?= $details_produit['nom_produit']; ?>
                                        </h2>
                                    </div>
                                </div>
                    <div class="text-center" >
                        <img src="<?= $details_produit['image_produit'] ?>" alt="<?= $details_produit['nom_produit']; ?>" title="<?= $details_produit['nom_produit']; ?>" class="img-details-produit img-thumbnail">
                    </div>            
                        <p class="mt-3">
                            categories 
                                <b class="text-info"><?= $details_produit["categories"]; ?></b>
                        </p>
                    <p class="text-info">
                        <b>
                            description
                        </b>
                    </p>
                        <em>
                            <?= $details_produit["description_produit"]; ?>
                        </em>
                    <p>
                            Prix <b class="text-primary">
                            <?= $details_produit["prix_produit"]; ?>
                                €
                             </b>
                    </p>
                        <p class="text-warning" >
                            nom du vendeur 
                            <?= $details_produit['nom_vendeur'] ?>
                        </p>
                       
                            <?php $date = new DateTime($details_produit['date_depot']);
                                if($details_produit == true){
                                    echo "<p>en stock</p>";
                                }else{
                                    echo "<p>en rupture</p>";
                                }
                                    ?>
                                    <p>Date de depot
                                        <?= $date->format("d/m/Y") ?>
                                    </p>
                                <a href="produits.php" class="btn btn-danger">
                                    retour aux produits
                                </a>
                    </div> 
        </div> 
    </div>
</body>
</html>