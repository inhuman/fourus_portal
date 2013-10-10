<?php
require_once __DIR__."/PDOConfig.php";
require_once __DIR__."/Attraction.php";

class FactoryAttraction {

    static public function findOne($id)
    {

        try{
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT serial_id, town_id, mobility, capacity, comment, user_id, modem FROM attraction WHERE id=:id");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $attraction = $stmt->fetchObject('Attraction');
        $stmt->closeCursor();

        $effxx = $dbh->prepare("SELECT e.ico, e.name FROM effects as e INNER JOIN attraction_effects as l ON (l.effect_id = e.id) WHERE l.attr_id = :id");
        $effxx->bindValue(':id',$id);
        $effxx->execute();
        $attraction->setEffects($effxx->fetchAll());
        $effxx->closeCursor();
        return $attraction;
        }
        catch(Exception $e) {
            die("Oh noes! There's an error in the query!");
            var_dump($attraction);
        }

    }

    static public function CountAll()
    {
        $dbh = new PDOConfig();
        $query=$dbh->query("SELECT COUNT(*) as id FROM attraction");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row=$query->fetch();
        $members=$row['id'];
        return $members;

    }

}
