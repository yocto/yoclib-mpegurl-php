<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

class EXT_X_STREAM_INF extends Tag{

    public function __construct($value=null){
        parent::__construct(Tag::EXT_X_STREAM_INF,$value);
    }

}