<?php

  class connexionDB {

    private $host = 'localhost'; 
    private $name = 'cemea';
    private $user = 'root';
    private $password = '';
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null) {
      if($host != null){
        $this->host = $host;           
        $this->name = $name;           
        $this->user = $user;          
        $this->password = $password;
      }
      try {
        $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      }
      catch(PDOException $e) {
        echo 'Erreur : Impossible de se connecter  à la BDD !';
        die();
      }
    }

    public function connexion() {
    	return $this->connexion;
    }

    public function query($sql, $data = array()){
      $req = $this->connexion->prepare($sql);
      $req->execute($data);

      return $req;
    }

    public function insert($sql, $data = array()){
      $req = $this->connexion->prepare($sql);
      $req->execute($data);
    }
  }

  $DB = new connexionDB;
  $BDD = $DB->connexion();
?>