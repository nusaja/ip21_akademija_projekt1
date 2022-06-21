<?php


if ($argv[1] === "list" && sizeof($argv) === 3) {
    ListAllBreeds($argv);
} elseif ($argv[1] === "search" && is_string($argv[3]) && ctype_alpha($argv[3]) && strlen($argv[3]) < 100) {
    SearchBreeds($argv);
}
  
function ListAllBreeds($argv) {
    
    if ($argv[2] === "dogs") {
        $api_url = 'https://api.thedogapi.com/v1/breeds';
    } elseif ($argv[2] === "cats") {
        $api_url = 'https://api.thecatapi.com/v1/breeds';
    }
    
    $json_data = @file_get_contents($api_url);

    if ($json_data === FALSE) { 
        echo "Error cought.\n";
        die;
    } 

    $array = json_decode($json_data, true);

    if ($array === null) {
        echo "Json cannot be decoded.\n";
        die;
    }
 
    for ($i = 0; $i < count($array); $i++) {
        echo $array[$i]['name'] . "\n"; 
    }

}

function SearchBreeds($argv) {

    if ($argv[2] === "dogs") {
        $api_url_search = 'https://api.thedogapi.com/v1/breeds/search?q=' . $argv[3];
    } elseif ($argv[2] === "cats") {
        $api_url_search = 'https://api.thecatapi.com/v1/breeds/search?q=' . $argv[3];
    }

    $json_data = file_get_contents($api_url_search);
    $array_search = json_decode($json_data, true);

    if (sizeof($array_search) === 0) {
        echo "No such breed.\n";
        die;
    }
    
    for ($i = 0; $i < count($array_search); $i++) {
        echo $array_search[$i]['name'] . "\n"; 
    }

}


