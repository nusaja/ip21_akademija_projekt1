<?php

require_once './vendor/autoload.php';

require_once 'lib/model.php';

$loader = new \Twig\Loader\FilesystemLoader('./views/templates');
$twig = new \Twig\Environment($loader, [
    //'cache' => './cache',
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$model = new Model();

$allowedTypes = ["dog", "cat", "both"];
$type = $argv[2] ?? null;
$query = $argv[3] ?? null;

if (isset($argv[1]) && (empty($type) || !in_array($type, $allowedTypes))) {
    echo "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name]. When using list function, you can type in [-v] to get additional information.\n";
    die;
}

if (($argv[$argc - 1] === "-v")) {
    $isVerbose = true; 
} else {
    $isVerbose = false; 
}

switch ($argv[1]) {
    case "list":
        $list = $model->getListOfAllBreeds($type);
        echo $twig->render('listOfBreeds.twig', ['listOfBreeds' => $list, 'isVerbose' => $isVerbose]);
        break;
    case "search":
        if (!is_string($query) || !ctype_alpha($query) || strlen($query) > 100) {
            echo "Error: breed name must have from 1-100 alphabetical characters.\n";
            die;
        } 
        $list = $model->searchBreeds($type, $query);
        echo $twig->render('listOfBreeds.twig', ['listOfBreeds' => $list, 'isVerbose' => $isVerbose]);
        break;
    default:
        echo "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n";
        break;
}