<?php

namespace Gravata;

class DownloaderTest extends \PHPUnit_Framework_TestCase
{
    private $destinationFile = '/tmp/example.org.html';

    protected function tearDown()
    {
        @unlink($this->destinationFile);
    }
    /**
     * @group integration
     */
    public function testDownloadFromUrlUsingFileGetContents()
    {
        $downloader = new Downloader;
        $url = 'http://example.org';
        $destinationFile = $this->destinationFile;
        $this->assertFileNotExists($destinationFile);
        $downloader->fromUrlToFile($url, $destinationFile);
        $this->assertFileExists($destinationFile);
    }

    public function testDownloadFromUrlWithoutUsingFileGetContents()
    {
        $downloader = new Downloader;
        $downloader->disableStreamSupport();
        $url = 'http://example.org';
        $destinationFile = $this->destinationFile;
        $this->assertFileNotExists($destinationFile);
        $downloader->fromUrlToFile($url, $destinationFile);
        $this->assertFileExists($destinationFile);
    }
}
