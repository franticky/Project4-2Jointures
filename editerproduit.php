<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
        <?php
            require_once "navbar.php";
        ?>
    </header>
  <div class="mt-4 container bg-main overflow-hidden" >
      <div class="row g-2" >
          <?php
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root", "");
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                print "eror" . $e->getMessage() . "<br/>";
                    die();
            }
                    //Une clef etrangere est une reference a une clef primaire, d'une autre table
                //selection de toute la table produits
            //jointure de la table categories ou table produits.(clef etrangere) = (table) categories.(cle primaire)
        //jointure de la table vendeurs ou (table) produits.(cle etrangere) = (table) vendeurs.(clef primaire)
    //jointure de la table commentaires ou (table) produits.(clef etrangere) = (table) commentaires.(cle primaire)
//on ajoute le prediquat WHERE qui filtre les produits par id (clef primaire des produits)
                $sql = "SELECT * FROM `produits`
            INNER JOIN categories ON produits.categorie_id = categories.id_categorie
            INNER JOIN vendeurs ON produits.vendeur_id = vendeurs.id_vendeur
                WHERE id_produit = ?";
        
    $request = $dbh->prepare($sql);
/*recuperation de l' id dans url envoyee depuis la page produits.php 
 /*
    <a href="details_produits.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-success">Details du produits</a>
        */ $id = $_GET['id_produit']; //les parametres sont liés
    $request->bindParam(1, $id); //ici 1 = WHERE id_produit = ?
            $request->execute(); //et devient : $_GET['id_produit'];
/* on liste le resutlat de la requete */ $details_produit = $request->fetch(); //on execute la requete
                    //var_dump($details_produit);
                    ?>
                    <div class="text-center" >
                        <h3 class="text-warning" >
                            Editer un produit
                        </h3>
                    </div>

                    <form class="details_produits" method="post" action="traitementediterproduit.php?id_produit=<?= $details_produit['id_produit'] ?>" enctype="multipart/form-data">
                           <div class="mb-3" >
                               <label for="nom_produit" class="form-label">
                                   Nom du produit
                               </label>
                               <input type="text" class="form-control" id="nom_produit" name="nom_produit" value="<?= $details_produit['nom_produit'] ?>" required>
                           </div>
                           <div class="mb-3" >
                               <label for="description_produit" class="form-label">
                                   Description
                               </label>
                               <textarea row="5" class="form-control" id="description_produit" name="description_produit" value="<?= $details_produit['description_produit'] ?>" required>
                            </textarea>
                           </div>
                           <div class="mb-3" >
                               <label for="prix_produit" class="form-label">
                                    Prix du produit
                               </label>
                               <input  type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit"  value="<?= $details_produit['prix_produit'] ?>" required>
                        
                           </div>
                           <div class="mb-3" >
                               <label for="stock_produit" class="form-label">
                                    Disponible
                               </label>
                               <select  class="form-control" id="stock_produit" name="stock_produit" required>
                                   <option value="0">en stock</option>
                                   <option value="1">rupture</option>
                           </div>
                           <div class="mb-3" >
                               <label for="date_depot" class="form-label">
                                   date de depot
                               </label>
                               <input  type="date" class="form-control" id="date_depot" name="date_depot"  value="<?= $details_produit['date_depot'] ?>" required>
                           </div>
                           <div class="mb-3" >
                               <label for="image_produit" class="form-label">
                                   image du produit
                               </label>
                               <input  type="file" class="form-control" id="image_produit" name="image_produit"  required>
                           </div>

                           <div class="mb-3" >
                               <label for="categories" class="form-label">
                                   categories
                                   <select name="categories" id="form-control">
                                       <?php
                                        $sql = "SELECT * FROM categories";
                                            $categories = $dbh->query($sql);
                                                foreach($categories as $category){
                                                    ?>
                                                    <option value="<?= $category['id_categorie'] ?>">
                                                    <?= $category['categories'] ?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                   </select>
                               </label>
                           </div>

                           <div class="mb-3" >
                               vendeurs
                               <select name="vendeurs" class="form-control">
                                   <?php

                                    $sql = "SELECT * FROM vendeurs"; //recuperation de toutes les categories depuis la table
                                        $vendeurs = $dbh->query($sql);//stock du tableau associatif dans une variable
                                            foreach ($vendeurs as $vendeur){
                                                //ici chaque valeur enrigistree dans la table produits = $_POST['vendeurs']
                                                    //$_POST['vendeurs'] = <option value="un entier"
                                                        //on affiche la categorie $vendeur['vendeurs'] entre les2 balises <option> donc on enregistre un entier dans la table produit(cle etrangere) qui fait reference a la cle primaire de la table vendeur
                                            
                                            ?>
                                            <option value="<?= $vendeur['id_vendeur'] ?>"><?= $vendeur['nom_vendeur'] ?></option>
                                            <?php
                                            }
                                            ?>
                               </select>
                           </div>
                           <div class="mb-3" >
                               <button type="submit" class="btn btn-primary" >
                                   valider l edition
                               </button>
                           </div>
                    </form>
      </div>
  </div>  
</body>
</html>