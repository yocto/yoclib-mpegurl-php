<?php
namespace YOCLIB\MPEGURL\Lines;

use YOCLIB\MPEGURL\MPEGURLLine;

class Comment extends MPEGURLLine{

    /**
     * Comment constructor.
     * @param $comment string Comment
     */
    public function __construct($comment){
        parent::__construct('#'.$comment);
    }

}