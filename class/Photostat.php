<?php

class Photostat
{
    public   $full_path, $cunt;

    private  $file_name, $ext, $date, $time, $ride_name, $attr_id, $town, $local_path;

    public function __construct($file_path)
    {
        $this->full_path = $file_path;
        $this->ParseFileName();
        $this->ParseDateTime();
        $this->ParseRideName();
        $this->ParseCunt();
        $this->ParseAttrId();
        $this->ParseTown();
        $this->ParseLocalPath();
    }

    private function ParseFileName()
    {
        $path_parts = pathinfo($this->full_path);
        $this->file_name = $path_parts['basename'];
        $this->ext = $path_parts['extension'];
    }

    private function ParseDateTime()
    {
        $date_time = explode('_',$this->file_name);
        $date = $date_time[0];
        $time = $date_time[1];
        $this->time = $time[0].$time[1].':'.$time[2].$time[3];
        $this->date = $date[0].$date[1].$date[2].$date[3].'-'.$date[4].$date[5].'-'.$date[6].$date[7];
    }

    private function ParseRideName()
    {
        $ride_name_arr_full = explode('_',$this->file_name);
        $ride_name_arr = explode('.',$ride_name_arr_full[2]);
        $this->ride_name = $ride_name_arr[0];
    }

    private function ParseCunt()
    {
        $path_parts = pathinfo($this->full_path);
        $filename_arr = explode('_',$path_parts['filename']);
        $this->cunt = $filename_arr[3];
    }

    private  function ParseAttrId()
    {
        $data_arr = explode('//',$this->full_path);
        $data = explode('/',$data_arr[0]);
        $attr_id_arr = explode(' - ',$data[4]);
        $this->attr_id = $attr_id_arr[0];

    }

    private function ParseTown()
    {
        $data_arr = explode('//',$this->full_path);
        $data = explode('/',$data_arr[0]);
        $town_arr = explode(' - ',$data[4]);
        $this->town = $town_arr[1];
    }


    private function ParseLocalPath()
    {
        $data_arr = explode('/FTP-shared',$this->full_path);
        $this->local_path = '"'.$data_arr[1].'"';

    }

    public function getCunt()
    {
        return $this->cunt;
    }
/*
     public static function setCunt($path)
     {
         $img = new Photostat($path);

         $path_parts = pathinfo($this->full_path);
         $dirname = $path_parts['dirname'];
         $filename = $path_parts['filename'];
         $ext = $path_parts['extension'];
         $oldfilename = $this->file_name;
         $this->file_name = $dirname.'/'.$filename.'_'.$cunt.'.'.$ext;
         rename($oldfilename,$this->file_name);
     }
*/
     public static function setCunt($path,$cunt)
     {
         $pathParts = pathinfo($path);
         $filename = $pathParts['filename'];
         $ext = $pathParts['extension'];
         $dirname = $pathParts['dirname'];

         $oldFileName = $dirname.'/'.$filename . '.' . $ext;

         if(Photostat::checkFileName($oldFileName))
         {
             chown($oldFileName,'www-data');
             $newFilName = $dirname.'/'.$filename . '_' . $cunt . '.' . $ext;
         }
         else
         {
             $newFilName = Photostat::renameBadNamedFile($oldFileName,$cunt);
         }
         rename($oldFileName,$newFilName);

         //var_dump(rename($oldFileName,$newFilName));
         //echo '<br>oldFileName '.$oldFileName;
         //echo '<br>newFilName'.$newFilName;
         //echo var_dump(error_get_last());
     }


     public static function checkFileName($filename)
     {
        $filenameArr = explode('_',$filename);
        if($filenameArr[4]){return false;}
        else{return true;}
     }

    public static function renameBadNamedFile($filename,$cunt)
    {
        $filenameArr = explode('_',$filename);
        $newFilename = $filenameArr[0].$filenameArr[1].$filenameArr[2].'_'.$cunt.'.jpg';
        chown($filename,'www-data');
        rename($filename,$newFilename);
        return $newFilename;
    }


    public function getFileName(){return $this->file_name;}
    public function getExt(){return $this->ext;}
    public function getDate(){return $this->date;}
    public function getTime(){return $this->time;}
    public function getRideName(){return $this->ride_name;}
    public function getAttrId(){return $this->attr_id;}
    public function getTown(){return $this->town;}
    public function getFullPath(){return $this->full_path;}
    public function getLocalPath(){return $this->local_path;}





}


