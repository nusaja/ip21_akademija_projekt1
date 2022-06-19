<?php

echo "Hello world \n\n";

$api_url = 'https://api.thedogapi.com/v1/breeds';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$array = json_decode($json_data, true);


for ($i = 0; $i < count($array); $i++) {
    echo $array[$i]['name'] . "\n"; 
}



