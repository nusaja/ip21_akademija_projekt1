<?php

require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./views/templates');
$twig = new \Twig\Environment($loader, [
    //'cache' => './cache',
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

require_once 'lib/model.php';
$model = new Model();
$type = 'both';

$list = $model->getListOfAllBreeds($type);
echo $twig->render('list.html.twig', ['listOfBreeds' => $list, 'isVerbose' => $isVerbose]);
