<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

class EXT_X_PROGRAM_DATE_TIME extends Tag{

    public function __construct($value=null){
        parent::__construct(Tag::EXT_X_PROGRAM_DATE_TIME,$value);
    }

}