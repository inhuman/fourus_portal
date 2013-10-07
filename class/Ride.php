<?php
include('PDOConfig.php');
class Ride
{

    public $id;

    private $official_name, $file_name, $duration, $description;
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

}

// TODO: write class RideFactory, place to RideFactory.php

function findRide($id)
{

    $dbh = new PDOConfig();
    $stmt = $dbh->prepare("SELECT official_name, local_path, file_name, duration, description, demo_720p, demo_480p, demo_360p, banner_big, banner_medium, banner_small, file_size_mb, dynamic_prv, dynamic_prvk, demo_1080p FROM Rides WHERE id=:id");
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    $ride = $stmt->fetchObject('Ride');
    return $ride;

}

function CountAllRides()
{
    $dbh = new PDOConfig();
    $query=$dbh->query("SELECT COUNT(*) as id FROM Rides");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $row=$query->fetch();
    $members=$row['id'];
    return $members;

}

