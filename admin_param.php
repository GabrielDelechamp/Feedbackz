<?php
require_once('Models/Actualite.php');
require_once('Models/Page.php');
require_once('Models/Categorie.php');
require_once('Models/Contact.php');
require_once('Models/Pdo.php');
$pdo=DonneesPDO::createPDO();
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
    <div class="all-param vertical-flex-container">
    
    <?php if ($_GET['type']=='contact'){
        $contact= Contact::getDatabase($pdo);
        foreach ($contact as $contact)
        {?>
            
           <div class="line-contact horizontal-flex-container">
           <p><?=$contact->nom_contact.' '.$contact->prenom_contact?></p>
           <p><?=$contact->mail?></p>
           <p><?=$contact->commentaire?></p>
           </div>

<?php   }

     } ?>


    <?php if(!isset($_GET['ajout'])){ ?>
    <?php if ($_GET['type']=='articles'){ ?>
    <a class="bouton "href="admin_param.php?ajout=1&type=articles">AJOUTER</a>
    <form method='get' action="admin_param.php">
    <input type="hidden" name="type" value="articles">
    <select name="id-article" id="id-article" onchange="this.form.submit()">
    <?php
            $actualites= Actualite::getDatabase($pdo,100);
            echo "<option value=''>--Sélectionnez votre choix--</option>"; 
                       
                    foreach($actualites as $actualite)
                    {
                        $titre=$actualite->titre;
                        $id=$actualite->id;
                        echo "<option value='".$id."'>".$titre."</option>";              
                    }
                }
            }
            ?>
    </select>
    </form>

    <?php if(!isset($_GET['ajout'])){ ?>
    <?php if ($_GET['type']=='page'){ ?>
    <a class="bouton "href="admin_param.php?ajout=1&type=page">AJOUTER</a>
    <form method='get' action="admin_param.php">
    <input type="hidden" name="type" value="page">
    <select name="id-page" id="id-page" onchange="this.form.submit()">
    <?php
            $pages= Page::getDatabase($pdo);
            echo "<option value=''>--Sélectionnez votre choix--</option>"; 
                       
                    foreach($pages as $page)
                    {
                        $titre=$page->titre;
                        $id_page=$page->id_page;
                        echo "<option value='".$id_page."'>".$titre."</option>";              
                    }
                }
            }
            ?>
    </select>
    </form>

    <?php
    if(isset($_GET['id-article'])){
        $actualite = Actualite::getArticle($_GET['id-article'],$pdo);
        ?>
        <a class="bouton" href="pagemodif?suppr=1&id-article=<?=$_GET['id-article']?>&type=<?=$_GET['type']?>">SUPPRIMER</a>
        <h1>Vous avez selectionné : <?=$actualite->titre?></h1>
        <form method='get' action="pagemodif.php" class="vertical-flex-container">
                <label for="titre">Titre : </label>
                <input type="text" name="titre" id='titre' value="<?= $actualite->titre ?>">
                <label for="contenu">Corps de texte : </label>
                <textarea class='corps_texte_input' id='corps_texte_input' name="corps-texte">
                <?= $actualite->corps_texte ?>
                </textarea>
            <input type="hidden" name="id-article" value='<?=$_GET['id-article']?>' >
            <input type="hidden" name="type" value='articles' >
            <input type='submit' value='ENVOYER'>
            
        </form>
    <?php } ?>

    <?php
    if(isset($_GET['id-page'])){
        $page = Page::getPage($_GET['id-page'],$pdo,'id');
        ?>
        <a class="bouton" href="pagemodif?suppr=1&id-page=<?=$_GET['id-page']?>&type=<?=$_GET['type']?>">SUPPRIMER</a>
        <h1>Vous avez selectionné : <?=$page->titre?></h1>
        <form method='get' action="pagemodif.php" class="vertical-flex-container">
                <label for="titre">Titre : </label>
                <input type="text" name="titre" id='titre' value="<?= $page->titre ?>">
                <label for="contenu">Corps de texte : </label>
                <textarea class='corps_texte_input' id='corps_texte_input' name="corps-page">
                <?= $page->corps_page ?>
                </textarea>
            <input type="hidden" name="id-page" value='<?=$_GET['id-page']?>' >
            <input type="hidden" name="type" value='page' >
            <input type='submit' value='ENVOYER'>
            
        </form>
    <?php } ?>

    <?php
        if(isset($_GET['ajout'])){
            if($_GET['ajout']==1){
                
            ?>
                <form method='get' action="pagemodif.php" class="vertical-flex-container">
             
                <label for="titre">Titre : </label>
                <input type="text" name="titre" id='titre' value="" required>
                
                <label for="contenu">Corps de texte : </label>
                <textarea class='corps_texte_input' id='corps_texte_input' name="corps-texte" required>
                </textarea>
            
                <?php if ($_GET['type']=='articles'){ ?>
                <label for="Auteur">Auteur : </label>
                <input type="text" name="Auteur" value="" required>

                <label for="sources">Sources : </label>
                <input type="text" name="sources" value="" required>
                <?php } ?>

                <?php if ($_GET['type']=='page'){ ?>
                <label for="id_categorie">Catégories : </label>
                <select name="id_categorie" id="">
                <?php
                    $categories= Categorie::getDatabase($pdo);
                    echo "<option value=''>--Sélectionnez votre choix--</option>"; 
                            
                            foreach($categories as $categorie)
                            {
                                $nom_categorie=$categorie->nom_categorie;
                                $id_categorie=$categorie->id_categorie;
                                echo "<option value='".$id_categorie."'>".$nom_categorie."</option>";              
                            }
                    ?>
                </select>
                <?php } ?>
                <input type="hidden" name="ajout" value="1">
                <input type="hidden" name="type" value="<?= $_GET["type"] ?>">
                <input type='submit' value='ENVOYER'>
                </form>
        <?php }
        } ?>
    </div>
    <footer>
    <?php
    include('includes/footer.php');
    ?>
    </footer>
</body>
</html>