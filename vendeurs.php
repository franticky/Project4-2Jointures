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
            $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant;charset=UTF8', "root","");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            print "error" . $e->getMessage() . "<br/>"; 
                die();
        }
        ?>
<div class="container">
    <div class="mb-4">
        <button onclick="showHideFrom()" class="btn btn-outline-secondary" >
    ajouter vendeur
        </button>
    </div>
    <form action="traitementajoutervendeur.php" enctype="multipart/form-data" method="post" id="formulaire-vendeur">
            <div class="mb-4" >
                <label for="nom_vendeur">
                    Nom vendeur
                </label>
            </div>
            <input type="text" class="form-control" name="nom_vendeur" placeholder="nom vendeur" required>
            
            <div class="mb-4" >
                <label for="prenom_vendeur">
                prenom_vendeur
                </label>
            </div>
            <input type="text" class="form-control" name="prenom_vendeur" placeholder="prenom vendeur" required>
            
            <div class="mb-4" >
                <label for="email_vendeur">
                email_vendeur
                </label>
            </div>
            <input type="email" class="form-control" name="email_vendeur" placeholder="email vendeur" required>
            
            <div class="mb-4" >
                <label for="logo_vendeur">
                    logo vendeur
                </label>
            </div>
            <input type="file" class="form-control" id="logo_vendeur" name="logo_vendeur" placeholder="logo vendeur" required>
            
            <div class="mb-4" >
                <label for="nom_vendeur">
                    Nom vendeur
                </label>
            </div>
            <input type="text" class="form-control" name="nom_vendeur" placeholder="vendeur" required>
            
            <div>
            <button class="btn btn-outline-info" >
                valider vendeur
            </button>
            </div>
            
    </form>
</div>

<div class="container table-responsive" >
    <table class="table table-info table-striped table-sm" >
        <thread>
            <tr>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
                <th scope="col" >ID</th>
            </tr>
        </thread>

    </table>
</div>
</body>
</html>