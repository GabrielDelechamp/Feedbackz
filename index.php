<?php
require_once('Models/Actualite.php');
require_once('Models/Pdo.php');
require_once('Components/ComponentActualite.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap')
    </style>
</head>
<body>
    <header>
        <?php
        include("includes/header.php");
        ?>
    </header>
    <?php
    if(isset($_GET['ok'])){
        if ($_GET['ok']==1){
            ?>
            <h1 class='center'>Votre prise de contact à bien été enregistré</h1>
        <?php  }
     }
    ?>
    <div class="actu-container horizontal-flex-container">
    <?php
        $pdo=DonneesPdo::createPDO();
        $actualites =Actualite::getDatabase($pdo,5);
        foreach (array_slice($actualites,0,1) as $actualite) 
        { 
            ComponentActualite::afficher('first-actualite',$actualite);
        } 
         ?>
        <div class="small-actu">
        <?php foreach (array_slice($actualites,1) as $actualite)
        { 
            ComponentActualite::afficher('actualite',$actualite);
        } 
        ?>
        </div>
    </div>
    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>
</body>
</html>