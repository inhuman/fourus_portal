<?php
require_once('Ride.php');
require_once('PDOConfig.php');

class FactoryRide {


    static public function findRide($id)
    {

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT official_name, local_path, file_name, duration, description, demo_720p, demo_480p, demo_360p, banner_big, banner_medium, banner_small, file_size_mb, dynamic_prv, dynamic_prvk, demo_1080p FROM Rides WHERE id=:id");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $ride = $stmt->fetchObject('Ride');
        $stmt->closeCursor();

        $effxx = $dbh->prepare("SELECT e.ico, e.name FROM effects as e INNER JOIN RidesEffectsLinks as l ON (l.effx_id = e.id) WHERE l.ride_id = :id");
        $effxx->bindValue(':id',$id);
        $effxx->execute();
        $ride->setEffx($effxx->fetchAll());
        $effxx->closeCursor();
        return $ride;

    }

    static public function CountAllRides()
    {
        $dbh = new PDOConfig();
        $query=$dbh->query("SELECT COUNT(*) as id FROM Rides");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row=$query->fetch();
        $members=$row['id'];
        return $members;

    }

}


