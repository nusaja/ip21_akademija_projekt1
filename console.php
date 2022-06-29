<?php

require_once 'lib/model.php';
require_once 'views/consoleView.php';
$view = new ConsoleView();
$model = new Model();

$allowedTypes = ["dog", "cat", "both"];
$type = $argv[2] ?? null;
$query = $argv[3] ?? null;

if (isset($argv[1]) && (empty($type) || !in_array($type, $argv2arr))) {
    echo "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n";
    die;
}

switch ($argv[1]) {
    case "list":
        $list = $model->listAllBreeds($type);
        $view->showList($list);
        break;
    case "search":
        if (!is_string($query) || !ctype_alpha($query) || strlen($query) > 100) {
            echo "Error: breed name must have from 1-100 alphabetical characters.\n";
            die;
        } 
        $list = $model->searchBreeds($type, $query);
        $view->showList($list);
        break;
    default:
        echo "Please type in: php console.php list [dog/cat/both] OR search [dog/cat/both] [breed name].\n";
        break;
}