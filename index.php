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
        $downloader->fromUrlToFile($gravatarUrl, '/tmp/'.$email.'.jpeg');

        return $app->redirect($gravatarUrl);
   }

   $app->render('search.php');
});

$app->run();
