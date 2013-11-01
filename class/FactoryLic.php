<?php
require_once __DIR__."/PDOConfig.php";
require_once __DIR__."/License.php";
class FactoryLic {

    public static function findCurrent($id)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT lic.date, Rides.official_name
                  FROM Rides
                  INNER JOIN lic ON ( Rides.id = lic.film_id )
                  WHERE (lic.attr_id = :id AND lic.date !=  '0000-00-00')
                  GROUP BY official_name
                  ORDER BY lic.date
                  LIMIT 30;") ;
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $licArr = $stmt->fetchAll();


        $i=0;
        foreach($licArr as $licRow)
        {
           $lic[$i] = new License();
           $lic[$i]->setAttrId($id);
           $lic[$i]->setDate($licRow[0]);
           $lic[$i]->setOfficialName($licRow[1]);
           $i++;

        }

        $stmt->closeCursor();
        return $lic;
    }

}

