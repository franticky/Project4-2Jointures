<?php
$user = "root";
$pass = "";

try{
    $dbh = new PDO('mysql:host=localhost;dbname=soleilcouchant', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"<p class='container alert alert-success text-center'>connection etablie a PDO Mhysql</p>";
                return $dbh;
}catch (PDOException $e){
    print "erreur!:" . $e->getMessage() ."<br/>";
        die();
}