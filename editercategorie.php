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
</body>
</html>