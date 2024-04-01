<?php
include('Models/Pdo.php');
class Actualite extends DonneesPdo
{
    public $id;
    public $titre;
    public $corps_texte;
    public $image;
    public $date_publication;
    public $sources;
    public $auteur;


    public function __construct(array $value){
        $this->id=$value['id'];
        $this->titre=$value['titre'];
        $this->corps_texte=$value['corps_texte'];
        $this->image=$value['image'];
        $this->date_publication=$value['date_publication'];
        $this->sources=$value['sources'];
        $this->auteur=$value['auteur'];
    }
    private static function afficher($sql){
        $pdo=DonneesPdo::createPDO();
        $temp = $pdo->prepare($sql);
        $temp -> execute();
        return $temp;
    }

    public static function getDatabase($pdo,$limit){
        $actualites=[];
        $sql='SELECT * FROM articles ORDER BY date_publication DESC LIMIT '.$limit;
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($actualites,new Actualite($resultats));
        }
        return $actualites;
    }
    public static function getArticle($id,$pdo){
        $actualites=[];
        $sql='SELECT * FROM articles WHERE id='.$id;
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($actualites,new Actualite($resultats));
        }
        return $actualites[0];
    }
    
}