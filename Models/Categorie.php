<?php
require_once('Models/Pdo.php');

class Categorie extends DonneesPdo
{
    public $id_categorie;
    public $nom_categorie;
    public $id_parent;

    public function __construct(array $values)
    {
        $this->id_categorie = $values['id_categorie'];
        $this->nom_categorie = $values['nom_categorie'];
        $this->id_parent = $values['id_parent'];
    }

    private static function afficher($sql){
        $pdo=DonneesPdo::createPDO();
        $temp = $pdo->prepare($sql);
        $temp -> execute();
        return $temp;
    }

    public static function getDatabase($pdo){
        $categories=[];
        $sql="SELECT * FROM categorie WHERE id_categorie NOT IN (SELECT id_categorie FROM page)";
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($categories,new Categorie($resultats));
        }
        return $categories;
    }
    
    public static function select_parent(){
        $categorie=[];
        $sql = 'SELECT * FROM categorie WHERE id_parent=0';
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($categorie,new Categorie($resultats));
        }
        return $categorie;
    }

    public function has_menus_enfants(): bool
    {
        $sql = 'select * from categorie where id_parent ='.$this->id_categorie;
        $count = parent::createPdo()->query($sql)->fetch();
        return $count > 0;
    }


    public function menus_enfants(): array
    {
        $enfant=[];
        $sql = 'select * from categorie where id_parent = ' . $this->id_categorie;
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($enfant,new Categorie($resultats));
        }
        return $enfant;
    }
}