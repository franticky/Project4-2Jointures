<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
$user = "root";
    $pass = "";

    try {
       
        $dbh = new PDO('mysql:host=localhost;dbname=ecommerce', $user, $pass);
        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    if($dbh){
       
        $sql = "SELECT * FROM categories WHERE id_categorie = ?";
        $id_categorie = $_GET['id_categorie'];
        $request = $dbh->prepare($sql);
        $request->bindParam(1, $id_categorie);
        $request->execute();
        $details = $request->fetch(PDO::FETCH_ASSOC);

    }
    ?>
    <div class="container">
        <form action="traitementeditervendeur.php?id_vendeur=<?= $details['id_vendeur'] ?>" id="form-update" method="post" enctype="multipart/form-data" >
            <h3 class="text-info" >
                editer le vendeur
            </h3>
            <div class="mb-4">
                    <label for="nom_vendeur">
                        Nom vendeur
                    </label>
                    <input class="form-control" type="text" id="nom_vendeur" name="nom_vendeur" value="<?= $details['nom_vendeur'] ?>" required>
                </div>

                <div class="mb-4">
                    <label for="prenom_vendeur">
                        Prenom vendeur
                    </label>
                    <input class="form-control" type="text" id="prenom_vendeur" name="prenom_vendeur" value="<?= $details['prenom_vendeur'] ?>" required>
                </div>

                <div class="mb-4">
                    <label for="email_vendeur">
                        Email vendeur
                    </label>
                    <input class="form-control" type="email" id="email_vendeur" name="email_vendeur" value="<?= $details['email_vendeur'] ?>"required>
                </div>

                <div class="mb-4">
                    <label for="logo_vendeur">
                        logo vendeur
                    </label>
                    <input class="form-control" type="file" id="logo_vendeur" name="logo_vendeur"  required>
                </div>

                <div class="mb-4">
                    <button class="btn btn-outline-info">
                        Editer le vendeur
                    </button>
                </div>

            </form>

    </div>
</body>
</html>