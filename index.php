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
        $emailHash = $calculator->calculate($email);

        return $app->redirect('http://www.gravatar.com/avatar/'.$emailHash.'?d=404&size=640', 307);
   }

   $app->render('search.php');
});

$app->run();
