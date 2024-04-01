<?php 
require_once("Models/Pdo.php");

$pdo=DonneesPDO::createPDO();

################################################################
################ Gestion de la table actualite #################
################################################################
if (!isset($_GET['suppr']) and !isset($_GET['ajout']) and $_GET['type']=='articles'){

    if(isset($_GET['titre'])){
        DonneesPdo::Modifier($pdo,$_GET["type"],$_GET['id-article'],$_GET['titre'],'titre');
    }
    if(isset($_GET['corps-texte'])){
        DonneesPdo::Modifier($pdo,$_GET["type"],$_GET['id-article'],$_GET['corps-texte'],'corps_texte');
    }
}
    if(isset($_GET['suppr']) and $_GET['type']=='articles'){
        if ($_GET['suppr']==1){
            DonneesPDO::Supprimer($pdo,$_GET["type"],$_GET['id-article']);
        }
    }
    if(isset($_GET['ajout'])){
        if ($_GET['ajout']==1 and $_GET['type']=='articles'){
            $sql="INSERT INTO ".$_GET['type']." (titre,corps_texte,auteur,sources,date_publication,image) VALUES ('".$_GET['titre']."','".$_GET['corps-texte']."','".$_GET['Auteur']."','".$_GET['sources']."','".date("Y-m-d")."','images/default')";
            DonneesPDO::Ajouter($sql,$pdo);
        }
    }


################################################################
################ Gestion de la table page ######################
################################################################
if (!isset($_GET['suppr']) and !isset($_GET['ajout']) and $_GET['type']=='page'){

    if(isset($_GET['titre'])){
        DonneesPdo::Modifier($pdo,$_GET["type"],$_GET['id-page'],$_GET['titre'],'titre');
    }
    if(isset($_GET['corps-page'])){
        DonneesPdo::Modifier($pdo,$_GET["type"],$_GET['id-page'],$_GET['corps-page'],'corps_page');
    }
}
    if(isset($_GET['suppr']) and $_GET['type']=='page'){
        if ($_GET['suppr']==1){
            DonneesPDO::Supprimer($pdo,$_GET["type"],$_GET['id-page']);
        }
    }
    if(isset($_GET['ajout'])){
        if ($_GET['ajout']==1 and $_GET['type']=='page'){
            $sql="INSERT INTO ".$_GET["type"].' (titre,corps_page,date_fraicheur,id_categorie) VALUES ("'.$_GET["titre"].'","'.$_GET["corps-texte"].'","'.date("Y-m-d").'","'.$_GET["id_categorie"].'")';
            DonneesPDO::Ajouter($sql,$pdo);
        }
    }

header("Location: admin.php");
exit();
