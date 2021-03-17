<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

class EXT_X_MEDIA_SEQUENCE extends Tag{

    public function __construct($value=null){
        parent::__construct(Tag::EXT_X_MEDIA_SEQUENCE,$value);
    }

}