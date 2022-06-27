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
    ?>
    <div class="container">

<div class="mb-4">
    <button onclick="showHideForm()" class="btn btn-outline-primary"  >
ajout de categorie
</button>
</div>

<form action="traitementajoutercategorie.php" enctype="multipart/form-data" id="formulaire-vendeur">
<div class="mb-4">
                <label for="type_categorie">
                    Type de catégorie
                </label>
                <input class="form-control" type="text" id="type_categorie" name="type_categorie" placeholder="buvables" required>
            </div>

            <div class="mb-4">
                <button class="btn btn-outline-info">
                    Ajouter la categorie
                </button>
            </div>

</form>
</div>
<div class="container table-responsive" >
    <table class="table table-warning table-striped table-sm" >
        <thread>
            <tr>
                <th scope="col" >
                    ID
                </th>
                <th scope="col" >
                    categorie
                </th> 
                <th scope="col" >
                    Nom du produit
                </th> 
                <th scope="col" >
                    image du produit
                </th> 
                <th scope="col" >
                    editer
                </th>
            </tr>
</thread>
<tbody>
    <?php
    $sql = "SELECT * FROM categories LEFT JOIN produits ON categories.id_categorie = produits.categorie_id ORDER BY id_categorie ASC";
        $categories = $dbh->query($sql);
        foreach ($categories as $categorie){
                ?>
                <tr class="align-middle fw-bold" >
                    <th scope="row"><?= $categorie['id_categorie'] ?></th>
                    <td class="text-warning">
                        <?= $categorie['categories'] ?>
                    </td>
                    <td >
                        <?= $categorie['nom_produit'] ?>
                    </td>
                    
                    <td >
                        <img src="<?= $categorie['image_produit'] ?>" alt="" title="" width="20%" >
                    </td>
                    <td >
                        <a class="btn btn-outline-info" href="editercategorie.php?id_categorie=<?= $categorie['id_categorie'] ?>">
                            editer
                        </a>
                    </td>
                </tr>
                <?php
        }
        ?>
</tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../assets/js/app.js" type="text/javascript"></script>
</body>
</html>
