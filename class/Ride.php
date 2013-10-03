<?php

class Ride {

    public $id;
    private $ride_name, $file_name, $duration, $file_size;
    private $demo, $poster_A4, $poster_A3, $poster_60x80;
    private  $prv, $prvk, $description;

    public function getDemo(){return $this->demo;}
    public function getDescription(){return $this->description;}
    public function getDuration(){return $this->duration;}
    public function getFileName(){return $this->file_name;}
    public function getFileSize(){return $this->file_size;}
    public function getPoster60x80(){return $this->poster_60x80;}
    public function getPosterA3(){return $this->poster_A3;}
    public function getPosterA4(){return $this->poster_A4;}
    public function getPrv(){return $this->prv;}
    public function getPrvk(){return $this->prvk;}
    public function getRideName(){return $this->ride_name;}

}