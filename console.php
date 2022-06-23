<?php

$type = $argv[2] ?? null;
$query = $argv[3] ?? null;

switch ($argv[1]) {
    case "list":
        if (empty($type) || !$type === "dog" || !$type === "cat" || !$type === "both") {
            echo "Error: after list type in either dog, cat or both.\n";
            die;
        }
        listAllBreeds($type);
        break;
    case "search":
        if (!is_string($query) || !ctype_alpha($query) || strlen($query) > 100) {
            echo "Error: breed name must have from 1-100 alphabetical characters.\n";
            die;
        }
        searchBreeds($type, $query);
        break;
    default:
        echo "Please type in: php console.php [list/search] [optional: dog/cat] [optional: breed name if you chose dog/cat]\n";
        break;
}

function listAllBreeds($type) {
    $path = 'breeds';

    if ($type === "both") {
        $list = callApi("dog", $path);
        printList($list);
        $list = callApi("cat", $path);
        printList($list);
        die;
    }
    
    $list = callApi($type, $path);
    printList($list);
}

function searchBreeds($type, $query) {
   $path = 'breeds/search?q=' . $query;
   $list = callApi($type, $path);
   printList($list);
}

function callApi($type, $path) {

    $fullPath = 'https://api.the' . $type . 'api.com/v1/' . $path;
    $json_data = @file_get_contents($fullPath);

    if ($json_data === FALSE) { 
        echo "Error cought.\n";
        die;
    } 

    $list = json_decode($json_data, true);

    if ($list === null) {
        echo "Json cannot be decoded.\n";
        die;
    }

    if (sizeof($list) === 0) {
        echo "No such breed.\n";
        die;
    }

    return $list;
}

function printList($list) {
    for ($i = 0; $i < count($list); $i++) {
        echo $list[$i]['name'] . "\n"; 
    }
}
