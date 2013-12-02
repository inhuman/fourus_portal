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
        $townArr = $town->fetch();
        $attraction->setTown($townArr[0]);
        $town->closeCursor();

        $townHistory = $dbh->prepare("SELECT AttractionTownHistory.date, towns.name  FROM AttractionTownHistory INNER JOIN towns ON (AttractionTownHistory.town_id = towns.id) WHERE attr_id=:attr_id ORDER BY date DESC");
        $townHistory->bindValue(':attr_id',$id);
        $townHistory->execute();
        $attraction->setTownHistory($townHistory->fetchAll());

        $townHistory->closeCursor();
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

    static public function getLocalPath($id)
    {
       $attr = new Attraction($id);
       $link = $attr->getSerialId() . ' - ' . $attr->getTown();
       return $link;
    }

    static public function getLastId()
    {
        $dbh = new PDOConfig();
        $query = $dbh->query("SELECT id FROM attraction ORDER BY id DESC LIMIT 1;");
        $queryArr = $query->fetch();
        $lastId = $queryArr[0];
        return $lastId;
    }

    static public function AddAttractionToDB($TownName,$serialID,$mobility)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('INSERT INTO towns (name) VALUES (:name);');
        $stmt->bindValue(':name',$TownName);
        $stmt->execute();
        $TownID  = $dbh->lastInsertId();

        $stmt = $dbh->prepare('INSERT INTO attraction (serial_id, mobility, town_id) VALUES (:serial_id, :mobility, :town_id);');
        $stmt->bindValue(':serial_id',$serialID);
        $stmt->bindValue(':mobility',$mobility);
        $stmt->bindValue(':town_id',$TownID);
        $stmt->execute();
        $stmt->closeCursor();
    }
    protected function AddAttractionPlayerToDB($PlayerCase, $PlayerMotherboard, $PlayerPowerUnit, $PlayerCPU, $PlayerCoolingSystem, $PlayerRAM,
                                               $PlayerHDD, $PlayerMOXA, $PlayerPCICOM, $PlayerlicController, $PlayerProjector1, $PlayerProjector2,
                                               $PlayerVideoCard, $PlayerEffectBlock)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('INSERT INTO AttractionPlayer (PlayerCase, PlayerMotherboard, PlayerPowerUnit, PlayerCPU,
                                           PlayerCoolingSystem, PlayerRAM, PlayerHDD, PlayerMOXA, PlayerPCICOM,
                                           PlayerlicController, PlayerProjector1, PlayerProjector2, PlayerVideoCard,
                                           PlayerEffectBlock)
                                VALUES (:PlayerCase, :PlayerMotherboard, :PlayerPowerUnit, :PlayerCPU, :PlayerCoolingSystem,
                                        :PlayerRAM, :PlayerHDD, :PlayerMOXA, :PlayerPCICOM, :PlayerlicController, :PlayerProjector1,
                                        :PlayerProjector2, :PlayerVideoCard, :PlayerEffectBlock);');

        $stmt->bindValue(':PlayerCase',$PlayerCase);
        $stmt->bindValue(':PlayerMotherboard',$PlayerMotherboard);
        $stmt->bindValue(':PlayerPowerUnit',$PlayerPowerUnit);
        $stmt->bindValue(':PlayerCPU',$PlayerCPU);
        $stmt->bindValue(':PlayerCoolingSystem',$PlayerCoolingSystem);
        $stmt->bindValue(':PlayerRAM',$PlayerRAM);
        $stmt->bindValue(':PlayerHDD',$PlayerHDD);
        $stmt->bindValue(':PlayerMOXA',$PlayerMOXA);
        $stmt->bindValue(':PlayerPCICOM',$PlayerPCICOM);
        $stmt->bindValue(':PlayerlicController',$PlayerlicController);
        $stmt->bindValue(':PlayerProjector1',$PlayerProjector1);
        $stmt->bindValue(':PlayerProjector2',$PlayerProjector2);
        $stmt->bindValue(':PlayerVideoCard',$PlayerVideoCard);
        $stmt->bindValue(':PlayerEffectBlock',$PlayerEffectBlock);

        $stmt->execute();
        $stmt->closeCursor();
    }

    protected function AddAttractionTerminalToDB()
    {

    }

    protected function AddAttractionDynamicModuleToDB()
    {

    }

}

