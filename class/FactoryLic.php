<?php
require_once __DIR__."/PDOConfig.php";
require_once __DIR__."/License.php";
class FactoryLic {

    public static function findCurrent($id)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT lic.date, Rides.official_name
                  FROM attraction
                  INNER JOIN lic ON ( attraction.id = lic.attr_id )
                  INNER JOIN Rides ON ( Rides.id = lic.film_id )
                  WHERE attraction.id =:id;") ;
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $licArr = $stmt->fetchAll();

        $i=0;
        foreach($licArr as $licRow)
        {
           echo '<br>'.$licRow[0].' '.$licRow[1];
           $lic[$i] = new License();
           $lic[$i]->setAttrId($id);
           $lic[$i]->setDate($licRow[0]);
           $lic[$i]->setDate($licRow[0]);
           $i++;

        }

        $stmt->closeCursor();
        return $lic;
    }

}

FactoryLic::findCurrent(37);