<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

class EXTMxU extends Tag{

    public function __construct($tag=null){
        parent::__construct($tag ?? Tag::EXTM3U);
    }

}