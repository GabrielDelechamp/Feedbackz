<?php
require_once('Models/Pdo.php');

class Contact extends DonneesPdo{
    public $id_contact;
    public $nom_contact;
    public $prenom_contact;
    public $mail;
    public $commentaire;

    public function __construct(array $value){
        $this->nom_contact=$value['nom_contact'];
        $this->prenom_contact=$value['prenom_contact'];
        $this->mail=$value['mail'];
        $this->commentaire=$value['commentaire'];
    }
   
    public function ajoutContact($contact,$pdo){
        $sql='INSERT INTO contact (nom_contact,prenom_contact,mail,commentaire) VALUES ("'.$contact->nom_contact.'","'.$contact->prenom_contact.'","'.$contact->mail.'","'.$contact->commentaire.'")';
        DonneesPdo::ajouter($sql,$pdo);
    }
    private static function afficher($sql){
        $pdo=DonneesPdo::createPDO();
        $temp = $pdo->prepare($sql);
        $temp -> execute();
        return $temp;
    }
    public static function getDatabase($pdo){
        $contact=[];
        $sql='SELECT * FROM contact';
        $temp=self::afficher($sql);
        while($resultats = $temp->fetch(PDO::FETCH_ASSOC)){
            array_push($contact,new Contact($resultats));
        }
        return $contact;
    }
}