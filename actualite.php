<?php
require_once('Models/Actualite.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap')
    </style>
</head>
<body>
<header>
    <?php
    include('includes/header.php');
    ?>
</header>
<?php
    $pdo=DonneesPDO::createPDO();
    $actualite=Actualite::getArticle($_GET['id'],$pdo);
        echo'<div class="full-article horizontal-flex-container">
                    <div class="imageANDsources">
                    <img src="'.$actualite->image.'" alt="">
                    <p class="date-article"><b>Actualité crée le : '.$actualite->date_publication.'</b></p>
                    <p><b> Ecrit par : '.$actualite->auteur.'</b></p>
                    <a href="index.php" class="bouton">⬅</a>
                    </div>
                    <div class="actualite-text">
                    <h1>'.$actualite->titre.'</h1>
                    <p class="contenu-article">'.$actualite->corps_texte.'</p>
                    <p><b>Source : '.$actualite->sources.'</b></p>
                    </div>
                    </div>';
    ?>
    <footer>
    <?php
    include('includes/footer.php');
    ?>
    </footer>
</body>
</html>