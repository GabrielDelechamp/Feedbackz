<?php
#Classe de gestion des donnees de la base de donnees dont hérite toutes les classes
class DonneesPdo{
 
    public static function createPDO(){
        $pdo = new PDO('mysql:host=localhost;dbname=site_actualites;charset=utf8mb4;port=3306', 'root', '');
        return $pdo;
    }

    public static function select(string $query)
    {
        $rows = self::createPDO()->query($query)->fetchAll();

        return $rows;
    }

    public static function Modifier($pdo,$table,$id,$valeur,$colonne){
        $sql='UPDATE '.$table.' SET '.$colonne.'="'.$valeur.'" WHERE id='.$id;
        $pdo->exec($sql);
    }

    public static function Ajouter($sql,$pdo){
        $pdo->exec($sql);
    }

    public static function Supprimer($pdo,$table,$id){
        $sql='DELETE FROM '.$table.' WHERE id='.$id;
        $pdo->exec($sql);
    }
    
}