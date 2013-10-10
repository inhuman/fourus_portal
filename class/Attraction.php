<?php
require_once __DIR__."/PDOConfig.php";

class Attraction {

    public $id;

    private $serial_id, $town_id, $mobility, $capacity, $comment, $user_id, $modem;
    private $town_history, $projectors, $effects;


    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getCapacity(){return $this->capacity;}
    public function getComment(){return $this->comment;}
    public function getEffects(){return $this->effects;}
    public function getMobility(){return $this->mobility;}
    public function getModem(){return $this->modem;}
    public function getProjectors(){return $this->projectors;}
    public function getSerialId(){return $this->serial_id;}
    public function getTownHistory(){return $this->town_history;}
    public function getTownId(){return $this->town_id;}
    public function getUserId(){return $this->user_id;}

    public function setEffects($effects){$this->effects = $effects;}
}