<?php


if (empty($argv[1])) {
    ListAllBreeds();
} elseif (is_string($argv[1]) && ctype_alpha($argv[1]) && strlen($argv[1]) < 100) {
    SearchBreeds($argv);
}
  
function ListAllBreeds() {
    
    $api_url = 'https://api.thedogapi.com/v1/breeds';
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

    global $argv; 
    $api_url_search = 'https://api.thedogapi.com/v1/breeds/search?q=' . $argv[1];
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


