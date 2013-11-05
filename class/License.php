<?php

class License {

    public $attr_id;
    private  $date, $official_name;


    public function getDate(){return $this->date;}
    public function getOfficialName(){return $this->official_name;}

    public function setDate($date){$this->date = $date;}
    public function setOfficialName($official_name){$this->official_name = $official_name;}
    public function setAttrId($attr_id){$this->attr_id = $attr_id;}

}