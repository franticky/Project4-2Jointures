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
    <div class="mt-4 container bg-main overflow-hidden">
        <div class="row g-2">
            <?php
                try{
                    $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    print"error" . $e->getMessage() . "<br/>";
                        die();
                }
        ?>  
            <div class="text-center" >
                <h3 class="text-primary" >
                    ajout de produit
                </h3>
            </div>
        <form class="details_produits" method="post" action="traitementajouterproduit.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom_produit" class="form_label" >
                        Nom du produit
                    </label>
                        <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
                </div>

                    <div class="mb-3" >
                        <label for="description_produit">
                            description
                        </label>
                        <textarea class="form-control" rows="5" id="description_produit" name="description_produit" required>
                        </textarea>
                    </div>

                        <div class="mb-3" >
                            <label for="prix_produit" class="form-label" >
                                prix produit
                            </label>
                            <input type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock_produit" class="form-label">
                                disponible
                            </label>
                            <select class="form-control"  name="stock_produit" id="stock_produit" required>
                                <option value="0">disponible</option>
                                <option value="1">en rupture</option>
                            </select>
                        </div>

                        <div class="mb-3" >
                            <label for="date_depot" class="form-label">
                                date de depot du produit
                            </label>
                            <input type="date" class="form-control" id="date_depot" name="date_depot" required>
                        </div>

                        <div class="mb-3" >
                            <label for="image_produit" class="form-label">
                                image du produit
                            </label>
                                <input type="file" class="form-control" id="image_produit" name="image_produit" required>
                        </div>

<!--on effectue une requete de selection sur la table categories pour afficher ces dernieres dans une fenetre deroulante-->
            <div class="mb-3">
                categories 
                <select name="categorie_id" class="form-control">
                    <?php
/*recuperation de toutes lescategories depuis la table*/ $sql = "SELECT * FROM categories";
/*stock du tableau associatif dnas une variable*/ $categories = $dbh->query($sql);
/*boucle de parcours du tableau + alias*/ foreach($categories as $category){
//ici, chaque valeur enregistree dans la table produits = $_POST['categories']
//$_POST['categories'] = <option value="un entier" 
//par contre on affiche la categorie $category['categorie'] entre les 2 balises <option>
//donc on enregistre un entier dnas la table produit (cle etrangere) qui fait reference a la cle primaire de la table categories
                    ?>
                        <option value="<?= $category['id_categorie'] ?>">
                        <?= $category['categories'] ?>
                    </option>
                            <?php     
                            }
                            ?>
                </select>
            </div>
            
<div class="mb-3">
        vendeurs
    <select name="vendeur_id" class="form-control">
        <?php
            $sql = "SELECT * FROM vendeurs";
                $vendeurs = $dbh->query($sql); 
                    foreach($vendeurs as $vendeur){
//ici, chaque valeur enregistree dans la table produits = $_POST['vendeurs']
//$_POST['vendeurs'] = <option value="un entier" 
//par contre on affiche la categorie $vendeur['vendeurs'] entre les 2 balises <option>
//donc on enregistre un entier dans la table produit (cle etrangere) qui fait reference a la cle primaire de la table categories
?>
    <option value="<?= $vendeur['id_vendeur'] ?>">
        <?= $vendeur['nom_vendeur'] ?>
    </option>
<?php
            }
?>
    </select>
</div>

<div class="mb-3" >
    <button tybe="submit" class="btn btn-primary" >
    valider le produit
    </button>
</div>

        </form>
        </div>  
    </div>    
</body>
</html>