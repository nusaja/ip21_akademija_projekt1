<?php

require_once 'views/consoleView.php';

function printList(array $list) {
    
    if (empty($list)) {
        echo "No results found.\n";
    }

    foreach($list as $line) {
        echo $line . PHP_EOL;
    }
}