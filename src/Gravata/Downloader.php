<?php

namespace Gravata;

class Downloader
{
    private $disableStreamSupport = false;

    public function fromUrlToFile($originUrl, $destinationFile)
    {
        if (false === $this->disableStreamSupport) {
            $content = file_get_contents($originUrl);
            return file_put_contents($destinationFile, $content);
        }

        $client = new \Guzzle\Http\Client;

        touch($destinationFile);
        $client->get($originUrl, array('save_to' => $destinationFile));
    }

    public function disableStreamSupport()
    {
        $this->disableStreamSupport = true;
    }
}
