<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

class EXTINF extends Tag{

    public function __construct($value=null){
        parent::__construct(Tag::EXTINF,$value);
    }

}