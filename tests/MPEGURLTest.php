<?php
namespace YOCLIB\MPEGURL\Tests;

use PHPUnit\Framework\TestCase;
use YOCLIB\MPEGURL\MPEGURL;

class MPEGURLTest extends TestCase{

    public function testReadEmptyFile(){
        self::assertNotNull(MPEGURL::read(''));
    }

}