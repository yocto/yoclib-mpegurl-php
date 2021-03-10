<?php
namespace YOCLIB\MPEGURL\Tests;

use PHPUnit\Framework\TestCase;
use YOCLIB\MPEGURL\MPEGURL;

class MPEGURLTest extends TestCase{

	public function testReadEmptyFile(){
		self::assertNotNull(MPEGURL::read(''));
	}

    public function testReadNormalFile(){
	    $input = '';
        $input .= 'Some file1.mp4'."\n";
        $input .= '#This is a comment'."\n";
        $input .= 'Some file2.mp4'."\n";
        $input .= ''."\n";
        $input .= 'Some file3.mp4'."\n";
        $input .= ''."\n";
        $input .= 'Some file4.mp4'."\n";
        $input .= '#This is another comment'."\n";
        $input .= 'Some file5.mp4'."\n";

        $mpegurl = MPEGURL::read($input);

        self::assertNotNull($mpegurl);
        self::assertFalse($mpegurl->isExtended());
        self::assertCount(9,$mpegurl->getLines());
    }

    public function testReadExtendedFile(){
        $input = '';
        $input .= '#EXTM3U'."\n";
        $input .= 'Some file1.mp4'."\n";
        $input .= '#This is a comment'."\n";
        $input .= 'Some file2.mp4'."\n";
        $input .= ''."\n";
        $input .= 'Some file3.mp4'."\n";
        $input .= ''."\n";
        $input .= 'Some file4.mp4'."\n";
        $input .= '#This is another comment'."\n";
        $input .= 'Some file5.mp4'."\n";

        $mpegurl = MPEGURL::read($input);

        self::assertNotNull($mpegurl);
        self::assertFalse($mpegurl->isExtended());
        self::assertCount(10,$mpegurl->getLines());
    }

}