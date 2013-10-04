<?php
include('PDOConfig.php');
class Ride {

    public $id;

    private $official_name, $file_name, $duration, $description;
    private $banner_big, $banner_medium, $banner_small, $file_size_mb, $dynamic_prv, $dynamic_prvk, $demo_1080p ;


    public function  __construct($id)
    {
       $this->id = $id;

       $this->getValuesFromDB();
    }

    public function getValuesFromDB()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT official_name, local_path, file_name, duration, description, demo_720p, demo_480p, demo_360p, banner_big, banner_medium, banner_small, file_size_mb, dynamic_prv, dynamic_prvk, demo_1080p FROM Rides WHERE id=:id");

        $stmt->bindValue(':id',$this->id);

        $stmt->execute();

        $ride = $stmt->fetchObject('Ride');

       // return $ride;

        echo '<br> var_dump dbh '.var_dump($dbh);

        echo '<br>var_dump '.var_dump($stmt);

        echo '<br>var_dump'.var_dump($ride);

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

$ride = new Ride('7');
echo "<br> ride ".var_dump($ride);
echo "<br>ride name ".$ride->getRideName();