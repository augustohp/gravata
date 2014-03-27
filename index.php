<?php

require_once 'vendor/autoload.php';

$slimConfiguration = array(
    'templates.path' => __DIR__.'/templates'
);
$app = new Slim\Slim($slimConfiguration);

$app->get('/', function() use ($app) {
   if (isset($_GET['email'])) {
        $email = filter_input(INPUT_GET, 'email');
        $calculator = new Gravata\Service\Gravatar\EmailHashCalculator;
        $downloader = new Gravata\Downloader;
        $emailHash = $calculator->calculate($email);
        $gravatarUrl = 'http://www.gravatar.com/avatar/'.$emailHash.'?size=640';
        $gravatarFilename = sprintf('/tmp/%s.jpeg', $email);
        $downloader->fromUrlToFile($gravatarUrl, $gravatarFilename);

        $stylist = new \Gravata\Stylist;
        $avatarWithTie = $stylist->applyTie(__DIR__ . '/overlays/gravata.png', $gravatarFilename);

        $resultFilename = $avatarWithTie->getRealPath();

        header('Content-Type: image/jpeg');
        $app->response->headers->set('Content-Type', 'image/jpeg');
        $app->response->setBody(file_get_contents($resultFilename));
   }

   $app->render('search.php');
});

$app->run();
