<?php
require_once __DIR__."/FactoryAttraction.php";
require_once __DIR__."/scanFileNameRecursivly.php";
require_once __DIR__."/Photostat.php";

class FactoryPhotostat {

    public static function findAllJpeg($id)
    {
        $attraction = FactoryAttraction::findOne($id);
        $path = '/home/FTP-shared/stat/'.$attraction->getSerialId().' - '.$attraction->getTown();
        $file_names = scanFileNameRecursivly($path);
        $i=0;
        foreach($file_names as $file)
        {
            $jpegfile = new Photostat($file);

            if($jpegfile->getExt() == 'jpg')
            {
              $image[++$i] = $jpegfile;
            }
        }
        return $image; // return array with files img objects
    }

    public static function findAllJpegDateRange($id,$dateFrom, $dateTo)
    {
       $jpegs = self::findAllJpeg($id);

       $i=0;
       foreach($jpegs as $jpeg)
       {
           if($jpeg->getDate() > $dateFrom)
           {
               if($jpeg->getDate() < $dateTo)
               {
                   $image[++$i] = $jpeg;

               }
           }
       }
       return $image;
    }
}
