<?php
namespace YOCLIB\MPEGURL\Lines;

use YOCLIB\MPEGURL\MPEGURLLine;

class Location extends MPEGURLLine{

    /**
     * Location constructor.
     * @param $location string Location
     */
    public function __construct($location){
        parent::__construct($location);
    }

}