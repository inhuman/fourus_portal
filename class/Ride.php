<?php
require_once __DIR__."/PDOConfig.php";
class Ride
{

    public $id;

    private $official_name, $file_name, $duration, $description, $effx;
    private $banner_big, $banner_medium, $banner_small, $file_size_mb, $dynamic_prv, $dynamic_prvk, $demo_1080p ;

    public function  __construct($id)
    {
       $this->id = $id;
    }

    public function getDemo(){return $this->demo_1080p;}
    public function getDescription(){return $this->description;}
    public function getDuration(){return $this->duration;}
    public function getFileName(){return $this->file_name;}
    public function getFileSize(){return $this->file_size_mb;}
    public function getPoster60x80(){return $this->banner_big;}
    public function getPosterA3(){return $this->banner_small;}
    public function getPosterA4(){return $this->banner_medium;}
    public function getPrv(){return $this->dynamic_prv;}
    public function getPrvk(){return $this->dynamic_prvk;}
    public function getRideName(){return $this->official_name;}
    public function getEffx(){return $this->effx;}
    public function setEffx($effx){$this->effx = $effx;}




}
