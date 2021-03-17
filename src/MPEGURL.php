<?php
namespace YOCLIB\MPEGURL;

use YOCLIB\MPEGURL\Lines\Tags\EXTMxU;

class MPEGURL{

    public const VERSION_1 = 1;
    public const VERSION_2 = 2;
    public const VERSION_3 = 3;
    public const VERSION_4 = 4;
    public const VERSION_5 = 5;
    public const VERSION_6 = 6;
    public const VERSION_7 = 7;

    /**
     * @var MPEGURLLine[]
     */
    private $lines;

    private function __construct($lines){
        $this->lines = $lines;
    }

    public function addLine(MPEGURLLine $line){
        $this->lines[] = $line;
    }

    /**
     * Get the lines
     * @return MPEGURLLine[]
     */
    public function getLines(): array{
        return $this->lines;
    }

    public function isExtended(): bool{
        if(count($this->lines)>=1){
            $line = $this->lines[0];
            if($line instanceof EXTMxU){
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $input
     * @return MPEGURL|null
     */
    public static function read(string $input): ?MPEGURL{
        $stream = fopen('data://text/plain;base64,'.base64_encode($input),'rb');
        return self::readStream($stream);
    }

    /**
     * @param $stream
     * @return MPEGURL|null
     */
    public static function readStream($stream): ?MPEGURL{
        $lines = [];

        while(($line = fgets($stream))!==false){
            $lines[] = MPEGURLLine::read($line);
        }

        return new self($lines);
    }

    /**
     * @param MPEGURL $input
     * @return string
     */
    public static function write(MPEGURL $input){
        $output = '';
        foreach($input->getLines() AS $line){
            $output .= $line->getLine();
        }
        return $output;
    }

    /**
     * @param $stream
     * @param MPEGURL $input
     */
    public static function writeStream($stream,MPEGURL $input){
        fputs($stream,self::write($input));
    }

}