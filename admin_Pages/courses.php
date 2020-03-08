<?php

class courses {

    public  $crs_id;
    public $crs_name;
    public $dr_id;


    public function __construct($crs_name) {
        
        $this->crs_name=$crs_name;
      
    }
    
}