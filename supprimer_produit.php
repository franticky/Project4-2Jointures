<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <title>supprimer produit</title>
</head>

<body>
<header>
    <?php
    require_once "navbar.php";
    ?>
</header>
<div  class="mt-4 container bg-main">
    <div class="row">
        <?php
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            print "error" . $e->getMessage() . "<br/>";
                die();
        }
        if(isset($_POST['btn-delete'])){
            echo"delete?";
            $sql = "DELETE FROM `produits` WHERE `id_produit` = ?";
                $delete = $dbh->prepare($sql);
                $id = $_GET['id_produit'];
                    $delete->bindParam(1, $id);
                        $delete->execute();

                        if($delete){
                            echo "<div class='text-center'>
                                    <p class='alert alert-primary' >
                                        produit supprimé
                                    </p>
                                    </div>"
                                    ?>
                                    <style>
                                        #details_produit{
                                            display:none;
                                        }
                                    </style>
                                    <?php
                        }else{
                            echo "error";
                        }
        }

        $sql = "SELECT * FROM `produits`
            INNER JOIN categories ON produits.categorie_id = categories.id_categorie
                INNER JOIN vendeurs on produits.vendeur_id = vendeurs.id_vendeur
                    WHERE id_produit = ?";
                    $request = $dbh->prepare($sql);//lutte contre les injections SQL
                    $id = $_GET['id_produit'];//l'id est recuperee de l url envoyee depuis la page produits.php
                    $request->bindParam(1, $id);//les parametres sont liés, ici 1 = WHERE id_produit = ? et devient: $_GET['id_produit'];
                    $request->execute();//requete executée
                    $details_produit = $request->fetch();//le resultat de la requete est listé
                    //debug 
                        //var_dump($details_produit);
                    ?>
                    <div class="container details_produits" id="details_produit" >
                        <div class="titre-produit-container" >
                            <h2 class="text-primary" >
                                <?= $details_produit['nom_produit']; ?>
                            </h2>
                        </div>

                        <div class="text-center">
                            <img src="<?= $details_produit['image_produit'] ?>" alt="<?= $details_produit['nom_produit'] ?>" title="<?= $details_produit['nom_produit'] ?>" class="img-details-produit img-thumbnail">
                        </div>
                        <p class="mt-3" >
                            categories <b class="text-info" >
                                <?= $details_produit["categories"]; ?>
                                        </b>
                        </p>
                        <p class="text-info"> <b>description</b> </p>
                        <em><?= $details_produit["description_produit"]; ?></em>
                        <p  >prix <b class="text-primary" >
                            <?= $details_produit["prix_produit"]; ?>€ </b> </p>
                                <p class="text-primary">
                                    Nom du vendeurs
                                    <?= $details_produit['nom_vendeur'] ?>
                                </p>
                        <?php
                        $date = new DateTime($details_produit['date_depot']);
                            if($details_produit == true){
                                echo "<p>en stock</p>";
                            }else{
                                echo "<p>en rupture</p>";
                            }
                            ?>
                            <p> date de depot
                                    <?= $date->format("d/m/Y") ?>
                            </p>
                                <a href="produits.php" class="btn btn-primary"> 
                                    retour aux produits
                                </a>
                                <form method="post">
                                    <button type="submit" name="btn-delete" class="mt-3 btn btn-danger">
                                        confirmer suppression
                                    </button>
                                </form>
                    
                    </div>
</div>
</div>
</body>
</html>