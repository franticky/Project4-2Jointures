<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    
    <link rel="stylesheet" href="../assets/sass/styles.css">
    <link rel="stylesheet" href="../assets/sass/bootstrap.css">
    <link rel="stylesheet" href="../assets/sass/_bootswatch.scss">
    <link rel="stylesheet" href="../assets/sass/_variables.scss">
    <title>Soleil Couchant</title>
</head>
<body style="background-image: url("assets/sea-205717_1920.jpg");">
    <header>
        <?php
            require_once "navbar.php";
        ?>
    </header>
    
<div class="mt-4 container bg-main overflow-hidden">
    <div class="text-center">
        <a href="ajouter_produit.php" class="btn btn-secondary" >
            ajout de produit
        </a>
    </div>
    <div class="row g-2" >
        <?php
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "connection a pdo";                
            }catch(PDOException $e){
                print "erreur" . $e->getMessage() . "<br/>";
                die();
            }
//une clef etrangere est une reference a une clef primaire d une autre table//                
$sql = "SELECT * FROM produits 
INNER JOIN categories ON produits.categorie_id = categories.id_categorie 
INNER JOIN vendeurs ON produits.vendeur_id = vendeurs.id_vendeur";
                   $produits = $dbh->query($sql);
/*exemple de requete externe*/ foreach ($produits as $produit){
//requete sur la table vendeurs pour afficher tous les produits du vendeur killiki
//SELECT * FROM `vendeurs` LEFT JOIN produits ON vendeurs.id_vendeur = produits.vendeur_id WHERE vendeur.nom_vendeur = "killiki"
?>
<div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
        <div class="card-body">
            <h4 class="card-title">
                <?= $produit['nom_produit']; ?>
            </h4>
        </div>

        <img src="<?= $produit['image_produit'] ?>" alt="<?= $produit['nom_produit']; ?>" title="<?= $produit['nom_produit'] ?>" class="img-produit img-thumbnail">
            
            <p class="mt-3" >
                categories 
                    <b class="text-info"> 
                        <?= $produit["categories"]; ?>
                    </b>
            </p>

            <p class="card-text">
                <b>
                    description
                </b>
            </p>
            
            <em>
                    <?= $produit["description_produit"]; ?>
            </em>
                
                <p>
                    prix
                        <b class="text-primary" > 
                            <?= $produit['prix_produit'] ?>€
                        </b>
                </p>

<!--les dates, stock booleens & noms des vendeurs--> <p class="text-warning">
                                                nom du vendeur
                                        <?= $produit['nom_vendeur'] ?> 
                                    </p>
    <a href="detailsdesproduits.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-primary">
        details des produits
    </a>
    <a href="supprimer_produit.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-warning">
        supprimer le produit
    </a>
    <a href="editerproduit.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-light">
        editer le produit
    </a>
    
        </div>
            <?php
                        }
                ?>                
                    </div>
        </div>
</body>
</html>