<?php
namespace YOCLIB\MPEGURL;

use YOCLIB\MPEGURL\Lines\Comment;
use YOCLIB\MPEGURL\Lines\EmptyLocation;
use YOCLIB\MPEGURL\Lines\Location;
use YOCLIB\MPEGURL\Lines\Tag;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_VERSION;
use YOCLIB\MPEGURL\Lines\Tags\EXTINF;
use YOCLIB\MPEGURL\Lines\Tags\EXTMxU;

abstract class MPEGURLLine{

    private $line;

    private function __construct($line){
        $this->line = $line;
    }

    /**
     * @param string $input
     * @return MPEGURLLine|null
     */
    public static function read(string $input): ?MPEGURLLine{
        $line = str_replace(["\r","\n"],'',$input);
        if(strlen($line)==0){
            return new EmptyLocation($input);
        }
        if($line[0]==='#'){
            $subLine = substr($line,0,4);
            if($subLine==='#EXT'){
                return self::readTag($input);
            }else{
                return new Comment($input);
            }
        }
        return new Location($input);
    }

    /**
     * @param string $input
     * @return Tag|null
     */
    private static function readTag($input){
        $tag = substr(explode(':',$input)[0] ?? '',1);
        switch($tag){
            case Tag::EXTMxU(0):
            case Tag::EXTMxU(1):
            case Tag::EXTMxU(2):
            case Tag::EXTMxU(3):
            case Tag::EXTMxU(4):
            case Tag::EXTMxU(5):
            case Tag::EXTMxU(6):
            case Tag::EXTMxU(7):
            case Tag::EXTMxU(8):
            case Tag::EXTMxU(9):new EXTMxU($input);break;
            case Tag::EXTINF:new EXTINF($input);break;
            case 'EXT-X-VERSION':new EXT_X_VERSION($input);break;
        }
        return new Tag($input);
    }

}