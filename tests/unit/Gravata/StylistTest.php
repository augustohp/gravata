<?php

namespace Gravata;

class StylistTest extends \PHPUnit_Framework_TestCase
{
    private $avatarFilePath = '/tmp/augusto@phpsp.org.br.jpeg';

    protected function setUp()
    {
        @unlink($this->avatarFilePath);
    }

    public function testStylistShouldApplyATieOverlayToAvatar()
    {
        $expectedMd5 = 'af186f6460138dc37a731f5f693b34da';
        $avatarFilePath = $this->avatarFilePath;
        $tieOverlayPath = __DIR__ . '/../../../overlays/gravata.png';
        $stylist = new Stylist;

        $resultFile = $stylist->applyTie($tieOverlayPath, $avatarFilePath);

        $this->assertEquals($expectedMd5, md5(file_get_contents($resultFile->getRealPath())));
    }
}
