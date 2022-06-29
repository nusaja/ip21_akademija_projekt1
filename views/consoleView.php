<?php

class ConsoleView {

    public function showList(array $list) {
    
        if (empty($list)) {
            echo "No results found.\n";
        }
    
        foreach($list as $line) {
            echo $line . PHP_EOL;
        }
    }

}

