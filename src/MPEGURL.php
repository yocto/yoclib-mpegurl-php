<?php
namespace YOCLIB\MPEGURL;

class MPEGURL{

    /**
     * @var MPEGURLLine[]
     */
    private $lines;

    private function __construct($lines){
        $this->lines = $lines;
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
            //$this->lines[0]->
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

}