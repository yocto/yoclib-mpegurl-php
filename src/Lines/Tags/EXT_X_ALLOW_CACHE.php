<?php
namespace YOCLIB\MPEGURL\Lines\Tags;

use YOCLIB\MPEGURL\Lines\Tag;

/**
 * Class EXT_X_ALLOW_CACHE
 * @deprecated
 * @package YOCLIB\MPEGURL\Lines\Tags
 */
class EXT_X_ALLOW_CACHE extends Tag{

    public const NO = 'NO';
    public const YES = 'YES';

    public function __construct($value=null){
        parent::__construct(Tag::EXT_X_ALLOW_CACHE,$value);
    }

}