<?php
class PDOConfig extends PDO {

    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;

    public function __construct(){
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'mediacontent';
        $this->user = 'mediacontent';
        $this->pass = '';
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
}
