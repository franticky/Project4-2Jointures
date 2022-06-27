<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <title>traitement d ajout de produits</title>
</head>
<body>
<header>
        <?php
            require_once "navbar.php";
        ?>
    </header>
        <div class="mt-4 container bg-main overflow-hidden">
            <div class="row g-2" >
                <?php
                try{
                    $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
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

    $sql = "INSERT INTO `produits`(`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`, `categorie_id`, `vendeur_id`) VALUES (?,?,?,?,?,?,?,?,?)";
                        $insert = $dbh->prepare($sql);      
/*les parametres de la requete sont lies aux champs du formulaire*/   
                                $insert->bindParam(1, $_POST['id_produit']);
                              $insert->bindParam(2, $_POST['nom_produit']);
                              $insert->bindParam(3, $_POST['description_produit']);
                              $insert->bindParam(4, $_POST['prix_produit']);
                              $insert->bindParam(5, $_POST['stock_produit']);
                              $insert->bindParam(6, $_POST['date_depot']);
                              $insert->bindParam(7, $_POST['image_produit']);
                              $insert->bindParam(8, $_POST['categorie_id']);
                              $insert->bindParam(9, $_POST['vendeur_id']);

                              $insert->execute(
                                array(
                                    $_POST['id_produit'],
                                    $_POST['nom_produit'],
                                    $_POST['description_produit'],
                                    $_POST['prix_produit'],
                                    $_POST['stock_produit'],
                                    $_POST['date_depot'],
                                    $_POST['image_produit'],
                                    $_POST['categorie_id'],
                                    $_POST['vendeur_id'],

                                ));
            if($insert){
                echo "<p class='container alert alert-primary'>sucess de l ajout</p>";
                    echo    "<div class='text-center'>
                                <a href='produits.php' class='container btn btn-primary' >
                                    voir produit
                                </a>
                            </div>";
            }else{
                echo "<p class='alert alert-danger'>
                            error d ajout
                        </p>";
            }
            ?>
            </div>
        </div>
</body>
</html>