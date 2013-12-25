<?php
require_once __DIR__ . '/PDOConfig.php';
require_once __DIR__ . '/Mailer.php';
require_once __DIR__ . '/FactoryLicBlueprint.php';

class FactoryMail {



    static public function getRecipient($FactoryID)
    {

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT AccountID, Name, Email, Phone FROM Accounting WHERE AttractionFactoryID=:AttractionFactoryID");
        $stmt->bindValue(":AttractionFactoryID",$FactoryID);
        $stmt->execute();
        $recipientArr = $stmt->fetchAll();
        $stmt->closeCursor();
        return $recipientArr;

    }

    static public function addRecipientToDeliveryList($BlueprintID, $AccountID, $Status)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("INSERT INTO LicDeliveryList VALUES (:BlueprintID, :AccountID, :Status)");
        $stmt->bindValue(":BlueprintID",$BlueprintID);
        $stmt->bindValue(":AccountID",$AccountID);
        $stmt->bindValue(":Status",$Status);
        $stmt->execute();
        $stmt->closeCursor();
    }

    static public function createEmail($AccountID, $PackageID)
    {

        $Package = self::getDeliveryPackage($PackageID);

        $Attraction = FactoryAttraction::findOne($Package['AttractionID']);

        switch($Package['PackageType'])
        {
            case "lic":
                $Subject = "Лицензии - $Attraction->getTown()";
                $Body = "Инструкция по продлению лицензий
                        1. Скачать файлы  (во вложении) и скопировать в корень USB Flash таким образом, чтобы в корне диска лежали только файлы.
                        2. Затем вставить этот USB Flash диск в компьютер \"Терминал\".
                        3. Снять защиту экрана - нажать ключик в углу экрана
                        4. Для установки лицензии нажать на нужный фильм два раза, с интервалом 5-10 секунд.
                        5. После проверки на запуск изъять USB Flash ";

                break;

            case "licnride":
                $Subject = "Лицензии и райды - $Attraction->getTown()";
                $Body = "Инструкция по установке райдов и продлению лицензий
                        1. Скачать файлы  (во вложении)
                        2. Скачать файлы по ссылкам выше (логин: test / пароль: test) и разархивировать
                        3. Скопировать скачанные файлы в корень USB Flash таким образом, чтобы в корне диска лежали только файлы.
                        4. Затем вставить USB Flash диск в компьютер \"Терминал\".
                        5. Снять защиту экрана - нажать ключик в углу экрана
                        6. Нажать 'Контроль'-'Обновить ПО', начнется установка фильмов.
                        7. После завершения установки будет выведено сообщение 'Установка завершена' и в списке появятся новые фильмы.
                        8. Затем нажать на каждый фильм новый фильм в списке с интервалом 5-10с, для установки лицензии
                        9. После проверки на запуск изъять USB Flash ";
                break;

            case "ride":
                $Subject = "Райды - $Attraction->getTown()";
                $Body = "Инструкция по установке райдов
                         1. Скачать архив(ы) по ссылке выше (логин: test / пароль: test) и распаковать в корень USB Flash таким образом, чтобы в корне диска лежали только файлы.
                         2. Затем вставить этот USB Flash диск в компьютер 'Терминал'.
                         3. Снять защиту экрана - нажать ключик в углу экрана
                         4. Нажать 'Контроль'-'Обновить ПО', начнется установка фильмов.
                         5. После завершения установки будет выведено сообщение 'Установка завершена' и в списке появятся новые фильмы.
                         6. Затем нажать на каждый фильм в списке с интервалом 5-10с, для установки лицензии
                         7. После проверки на запуск изъять USB Flash";
                break;
        }





    }

    static public function createAttachments($BlueprintIDArr)
    {
        $zag = "";

        foreach($BlueprintIDArr as $BlueprintID)
        {
         $Blueprint = FactoryLicBlueprint::getBlueprint($BlueprintID);
         $BlueprintLocationArr = explode('"',$Blueprint['location']);
         $BlueprintWmvLicLocalPath = $BlueprintLocationArr[1];
         $BlueprintPrvkLicLocalPath = $BlueprintLocationArr[3];

         $BlueprintWmvFullPath  = '/data'.$BlueprintWmvLicLocalPath;
         $BlueprintPrvkFullPath = '/data'.$BlueprintPrvkLicLocalPath;

         $f         = fopen($BlueprintWmvFullPath,"rb");
         $zag      .= "------------".$un."\nContent-Type:text/html;\n";
         $zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
         $zag      .= "------------".$un."\n";
         $zag      .= "Content-Type: application/octet-stream;";
         $zag      .= "name=\"".basename($BlueprintWmvFullPath)."\"\n";
         $zag      .= "Content-Transfer-Encoding:base64\n";
         $zag      .= "Content-Disposition:attachment;";
         $zag      .= "filename=\"".basename($BlueprintWmvFullPath)."\"\n\n";
         $zag      .= chunk_split(base64_encode(fread($f,filesize($BlueprintWmvFullPath))))."\n";

         $f         = fopen($BlueprintPrvkFullPath,"rb");
         $zag      .= "------------".$un."\nContent-Type:text/html;\n";
         $zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
         $zag      .= "------------".$un."\n";
         $zag      .= "Content-Type: application/octet-stream;";
         $zag      .= "name=\"".basename($BlueprintPrvkFullPath)."\"\n";
         $zag      .= "Content-Transfer-Encoding:base64\n";
         $zag      .= "Content-Disposition:attachment;";
         $zag      .= "filename=\"".basename($BlueprintPrvkFullPath)."\"\n\n";
         $zag      .= chunk_split(base64_encode(fread($f,filesize($BlueprintPrvkFullPath))))."\n";

        }


    }

    static public function createDeliveryPackage($BlueprintIDArr, $PackageType, $AttractionID)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT PackageID FROM LicDeliveryPackages ORDER BY PackageID DESC LIMIT 1 ");
        $stmt->execute();
        $lastPackageIDArr = $stmt->fetchAll();
        $lastPackageID = $lastPackageIDArr[0][0];
        $stmt->closeCursor();

        $PackageID = $lastPackageID + 1;

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("INSERT INTO LicDeliveryPackages VALUES (:PackageID, :BlueprintID, :PackageType)");
        $stmt->bindValue(":PackageID",$PackageID);
        $stmt->bindValue(":PackageType",$PackageType);
        $stmt->bindValue(":AttractionID",$AttractionID);

        foreach($BlueprintIDArr as $BlueprintID)
        {
            $stmt->bindValue(":BlueprintID",$BlueprintID);
            $stmt->execute();
        }
        $stmt->closeCursor();

    }

    static public function getDeliveryPackage($PackageID)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT PackageID, BlueprintID, PackageType, AttractionID FROM LicDeliveryPackages WHERE PackageID = :PackageID;");
        $stmt->bindValue(":PackageID",$PackageID);
        $stmt->execute();
        $Package = $stmt->fetchAll();
        $stmt->closeCursor();
        return $Package;
    }

    static public function DeliverPackages($FactoryID, $FirstBlueprintID, $LastBlueprintID)
    {


    }
}