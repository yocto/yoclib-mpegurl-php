<?php
namespace YOCLIB\MPEGURL;

use YOCLIB\MPEGURL\Lines\Comment;
use YOCLIB\MPEGURL\Lines\EmptyLocation;
use YOCLIB\MPEGURL\Lines\Location;
use YOCLIB\MPEGURL\Lines\Tag;
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
        $tag = explode(':',$input)[0] ?? '';
        switch($tag){
            case '#EXTM0U':
            case '#EXTM1U':
            case '#EXTM2U':
            case '#EXTM3U':
            case '#EXTM4U':
            case '#EXTM5U':
            case '#EXTM6U':
            case '#EXTM7U':
            case '#EXTM8U':
            case '#EXTM9U':new EXTMxU($input);break;
            case '#EXTINF':new EXTINF($input);break;
        }
        return new Tag($input);
    }

}