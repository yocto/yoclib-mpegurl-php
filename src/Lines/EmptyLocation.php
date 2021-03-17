<?php
namespace YOCLIB\MPEGURL\Lines;

class EmptyLocation extends Location{

    /**
     * EmptyLocation constructor.
     */
    public function __construct(){
        parent::__construct('');
    }

}