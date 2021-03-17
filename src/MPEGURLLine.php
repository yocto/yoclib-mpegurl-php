<?php
namespace YOCLIB\MPEGURL;

use YOCLIB\MPEGURL\Lines\Comment;
use YOCLIB\MPEGURL\Lines\EmptyLocation;
use YOCLIB\MPEGURL\Lines\Location;
use YOCLIB\MPEGURL\Lines\Tag;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_ALLOW_CACHE;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_BYTERANGE;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_DATERANGE;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_DISCONTINUITY;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_DISCONTINUITY_SEQUENCE;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_ENDLIST;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_I_FRAME_STREAM_INF;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_I_FRAMES_ONLY;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_INDEPENDENT_SEGMENTS;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_KEY;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_MAP;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_MEDIA;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_MEDIA_SEQUENCE;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_PLAYLIST_TYPE;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_PROGRAM_DATE_TIME;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_SESSION_DATA;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_SESSION_KEY;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_START;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_STREAM_INF;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_TARGETDURATION;
use YOCLIB\MPEGURL\Lines\Tags\EXT_X_VERSION;
use YOCLIB\MPEGURL\Lines\Tags\EXTINF;
use YOCLIB\MPEGURL\Lines\Tags\EXTMxU;

abstract class MPEGURLLine{

    /**
     * @var $line string
     */
    protected $line;

    protected function __construct($line){
        $this->line = $line;
    }

    public function getLine(){
        return $this->line;
    }

    /**
     * @param string $input
     * @return MPEGURLLine|null
     */
    public static function read(string $input): ?MPEGURLLine{
        $line = str_replace(["\r","\n"],'',$input);
        if(strlen($line)==0){
            return new EmptyLocation();
        }
        if($line[0]==='#'){
            $subLine = substr($line,0,4);
            if($subLine==='#EXT'){
                return self::readTag($input);
            }else{
                return new Comment(substr($input,1));
            }
        }
        return new Location($input);
    }

    /**
     * @param string $input
     * @return Tag|null
     */
    private static function readTag($input){
        $tagParts = explode(':',$input,1);
        $tagName = substr($tagParts[0] ?? '',1);
        $tagValue = $tagParts[1] ?? null;
        switch($tagName){
            case Tag::EXTMxU(0):
            case Tag::EXTMxU(1):
            case Tag::EXTMxU(2):
            case Tag::EXTMxU(3):
            case Tag::EXTMxU(4):
            case Tag::EXTMxU(5):
            case Tag::EXTMxU(6):
            case Tag::EXTMxU(7):
            case Tag::EXTMxU(8):
            case Tag::EXTMxU(9):new EXTMxU($tagName);break;
            case Tag::EXTINF:new EXTINF($tagValue);break;
            //Version 1 - Draft 00
            case Tag::EXT_X_TARGETDURATION:new EXT_X_TARGETDURATION($tagValue);break;
            case Tag::EXT_X_MEDIA_SEQUENCE:new EXT_X_MEDIA_SEQUENCE($tagValue);break;
            case Tag::EXT_X_KEY:new EXT_X_KEY($tagValue);break;
            case Tag::EXT_X_PROGRAM_DATE_TIME:new EXT_X_PROGRAM_DATE_TIME($tagValue);break;
            case Tag::EXT_X_ALLOW_CACHE:new EXT_X_ALLOW_CACHE($tagValue);break;
            case Tag::EXT_X_ENDLIST:new EXT_X_ENDLIST($tagValue);break;
            case Tag::EXT_X_STREAM_INF:new EXT_X_STREAM_INF($tagValue);break;
            //Version 1 - Draft 02
            case Tag::EXT_X_DISCONTINUITY:new EXT_X_DISCONTINUITY($tagValue);break;
            //Version 2 - Draft 03
            case Tag::EXT_X_VERSION:new EXT_X_VERSION($tagValue);break;
            //Version 3 - Draft 06
            case Tag::EXT_X_PLAYLIST_TYPE:new EXT_X_PLAYLIST_TYPE($tagValue);break;
            //Version 4 - Draft 07
            case Tag::EXT_X_BYTERANGE:new EXT_X_BYTERANGE($tagValue);break;
            case Tag::EXT_X_MEDIA:new EXT_X_MEDIA($tagValue);break;
            case Tag::EXT_X_I_FRAMES_ONLY:new EXT_X_I_FRAMES_ONLY($tagValue);break;
            case Tag::EXT_X_I_FRAME_STREAM_INF:new EXT_X_I_FRAME_STREAM_INF($tagValue);break;
            //Version 5 - Draft 09
            case Tag::EXT_X_MAP:new EXT_X_MAP($tagValue);break;
            //Version 6 - Draft 12
            case Tag::EXT_X_DISCONTINUITY_SEQUENCE:new EXT_X_DISCONTINUITY_SEQUENCE($tagValue);break;
            case Tag::EXT_X_START:new EXT_X_START($tagValue);break;
            //Version 6 - Draft 13
            case Tag::EXT_X_INDEPENDENT_SEGMENTS:new EXT_X_INDEPENDENT_SEGMENTS($tagValue);break;
            //Version 7 - Draft 14
            case Tag::EXT_X_SESSION_DATA:new EXT_X_SESSION_DATA($tagValue);break;
            //Version 7 - Draft 17
            case Tag::EXT_X_SESSION_KEY:new EXT_X_SESSION_KEY($tagValue);break;
            //Version 7 - Draft 19
            case Tag::EXT_X_DATERANGE:new EXT_X_DATERANGE($tagValue);break;
        }
        return new Tag($tagName,$tagValue);
    }

}