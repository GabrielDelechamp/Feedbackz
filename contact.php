<?php
require_once('Models/Pdo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-Nous !</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap')
    </style>
</head>
<body>
<?php
    require_once("Models/Contact.php");
    $pdo=DonneesPDO::createPDO();
    if (isset($_GET['nom']) and isset($_GET['prenom']) and isset($_GET['mail']) and isset($_GET['message'])){
        $array = array("nom_contact"=>$_GET['nom'],"prenom_contact"=>$_GET['prenom'],"mail"=>$_GET['mail'],"commentaire"=>$_GET['message']);
    $contact= new Contact($array);
    
    $contact->ajoutContact($contact,$pdo);
    header('Location: index.php?ok=1');
    exit();
    }
?>
    <header>
        <?php
        require_once("includes/header.php");
        ?>
    </header>
    <div class="contact-container vertical-flex-container">
    <h1>Soumettez vos remarque pour <span>améliorer</span> notre site !</h1>
    <h2>Vous obtienderez un retour sous 24h dans votre boite mail.</h2>
        <form action="contact.php" method="get" class="vertical-flex-container">
        <div>
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="nom" required/>
        </div>
        <div>
        <label for="prenom">Prénom : </label>
        <input type="text" name="prenom" id="prenom" required/>
        </div> 
        <div>
        <label for="mail">Adresse Mail : </label>
        <input type="email" name="mail" id="mail" required/>
        </div>
        <div>
        <label for="message">Message : </label>
        <textarea name="message" id="message" rows="10" required></textarea>
        </div>   
            <input type="submit">
        </form>
    </div>
    <footer>
        <?php
        require_once("includes/footer.php");
        ?>
    </footer>
</body>
</html>