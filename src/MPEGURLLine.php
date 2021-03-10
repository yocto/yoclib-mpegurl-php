<?php
namespace YOCLIB\MPEGURL;

class MPEGURLLine{

    /**
     * @param string $input
     * @return MPEGURLLine|null
     */
    public static function read(string $input): ?MPEGURLLine{
//        $stream = fopen('data://text/plain;base64,'.base64_encode($input),'rb');
//        return self::readStream($stream);
    }

}