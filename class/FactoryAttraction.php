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
        $attraction->id = $id;
        $stmt->closeCursor();

        $effxx = $dbh->prepare("SELECT e.ico, e.name FROM effects as e INNER JOIN attraction_effects as l ON (l.effect_id = e.id) WHERE l.attr_id = :id");
        $effxx->bindValue(':id',$id);
        $effxx->execute();
        $attraction->setEffects($effxx->fetchAll());
        $effxx->closeCursor();

        $town = $dbh->prepare("SELECT name FROM towns WHERE id=:id");
        $town->bindValue(':id',$attraction->getTownId());
        $town->execute();
        $attraction->setTown($town->fetch());
        $town->closeCursor();

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

    static public function findAll()
    {
        $dbh = new PDOConfig();
        $query = $dbh->query("SELECT attraction.id, towns.name, attraction.serial_id, attraction.mobility, attraction.capacity, attraction.comment FROM attraction INNER JOIN towns ON ( attraction.town_id = towns.id ) ;");
        $queryArr = $query->fetchAll();

        foreach ($queryArr as $row)
        {
            $id = $row[0];
            $ride[$id] = self::findOne($id);
            $ride[$id]->SetTown($row[1]);

        }
        return $ride;
    }

}
