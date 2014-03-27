<?php

namespace Gravata;

class Stylist
{
    public function applyTie($tieOverlayPath, $avatarPath)
    {
        $resultFilename = dirname($avatarPath) . '/' .  sprintf('gravata_%s', basename($avatarPath));
        $imagine = new \Imagine\Gd\Imagine;
        $gravata = $imagine->open($tieOverlayPath);
        $avatar = $imagine->open($avatarPath);
        $pointToStartOfImage = new \Imagine\Image\Point(0,0);
        $avatar->paste($gravata, $pointToStartOfImage);
        $avatar->save($resultFilename, array('quality'=>70));

        return new \SplFileObject($resultFilename);
    }
}
