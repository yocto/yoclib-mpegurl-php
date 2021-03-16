<?php
namespace YOCLIB\MPEGURL\Lines;

use YOCLIB\MPEGURL\MPEGURL;

class Tag extends Comment{

    public const EXTM3U = 'EXTM3U';
    public const EXTINF = 'EXTINF';

    //Version 1 - Draft 00
    public const EXT_X_TARGETDURATION = 'EXT-X-TARGETDURATION';
    public const EXT_X_MEDIA_SEQUENCE = 'EXT-X-MEDIA-SEQUENCE';
    public const EXT_X_KEY = 'EXT-X-KEY';
    public const EXT_X_PROGRAM_DATE_TIME = 'EXT-X-PROGRAM-DATE-TIME';
    /**
     * @deprecated The EXT-X-ALLOW-CACHE tag was removed in protocol version 7.
     */
    public const EXT_X_ALLOW_CACHE = 'EXT-X-ALLOW-CACHE';
    public const EXT_X_ENDLIST = 'EXT-X-ENDLIST';
    public const EXT_X_STREAM_INF = 'EXT-X-STREAM-INF';
    //Version 1 - Draft 02
    public const EXT_X_DISCONTINUITY = 'EXT-X-DISCONTINUITY';
    //Version 2 - Draft 03
    public const EXT_X_VERSION = 'EXT-X-VERSION';
    //Version 3 - Draft 06
    public const EXT_X_PLAYLIST_TYPE = 'EXT-X-PLAYLIST-TYPE';
    //Version 4 - Draft 07
    public const EXT_X_BYTERANGE = 'EXT-X-BYTERANGE';
    public const EXT_X_MEDIA = 'EXT-X-MEDIA';
    public const EXT_X_I_FRAMES_ONLY = 'EXT-X-I-FRAMES-ONLY';
    public const EXT_X_I_FRAME_STREAM_INF = 'EXT-X-I-FRAME-STREAM-INF';
    //Version 5 - Draft 09
    public const EXT_X_MAP = 'EXT-X-MAP';
    //Version 6 - Draft 12
    public const EXT_X_DISCONTINUITY_SEQUENCE = 'EXT-X-DISCONTINUITY-SEQUENCE';
    public const EXT_X_START = 'EXT-X-START';
    //Version 6 - Draft 13
    public const EXT_X_INDEPENDENT_SEGMENTS = 'EXT-X-INDEPENDENT-SEGMENTS';
    //Version 7 - Draft 14
    public const EXT_X_SESSION_DATA = 'EXT-X-SESSION-DATA';
    //Version 7 - Draft 17
    public const EXT_X_SESSION_KEY = 'EXT-X-SESSION-KEY';
    //Version 7 - Draft 19
    public const EXT_X_DATERANGE = 'EXT-X-DATERANGE';

    public static function EXTMxU($x){
        return 'EXTM'.$x.'U';
    }

    public static function getAllEXTMxU(){
        $tags = [];
        for($i=0;$i<9;$i++){
            $tags[] = self::EXTMxU($i);
        }
        return $tags;
    }

    public static function getVersionlessTags(){
        return array_merge(self::getAllEXTMxU(),[
            self::EXTINF,
        ]);
    }

    public static function getVersionTags($version){
        $tags = self::getVersionlessTags();
        switch($version){
            case MPEGURL::VERSION_1:{
                $tags = array_merge($tags,[
                    //Draft 00

                ]);
                break;
            }
        }
        return $tags;
    }

}