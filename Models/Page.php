<?php
class Page extends DonneesPdo
{
    public $id_page;
    public $titre;
    public $corps_page;
    public $date_publication;

    public function __construct(array $value){
        $this->id_page=$value['id'];
        $this->titre=$value['titre'];
        $this->corps_page=$value['corps_page'];
        $this->date_publication=$value['date_fraicheur'];
    }
    private static function afficher($sql){
        $pdo=DonneesPdo::createPDO();
        $temp = $pdo->prepare($sql);
        $temp -> execute();
        return $temp;
    }
    public static function getDatabase($pdo){
        $page=[];
        $sql='SELECT * FROM page';
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($page,new Page($resultats));
        }
        return $page;
    }

    public static function getPage($id,$pdo,$selection){
        $page=[];
        $sql='SELECT * FROM page WHERE '.$selection.'='.$id;
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($page,new Page($resultats));
        }
        return $page[0];
    }
}