<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

class EXT_X_INDEPENDENT_SEGMENTS extends Tag{

    public function __construct(){
        parent::__construct(Tag::EXT_X_INDEPENDENT_SEGMENTS);
    }

}