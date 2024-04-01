<?php
require_once('Models/Pdo.php');
require_once('Models/Page.php');
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
    $page=Page::getPage($_GET['id'],$pdo,'id_categorie');
        echo'<div class="full-article horizontal-flex-container">
                    <div class="actualite-text">
                    <h1>'.$page->titre.'</h1>
                    <p class="contenu-article">'.$page->corps_page.'</p>
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