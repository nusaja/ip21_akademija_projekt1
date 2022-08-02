<?php

class Model {

    public function getListOfAllBreeds($type): array {
        $path = 'breeds';

        if ($type === "both") {
           
            return $this->prepareBothToPrint($path); 

        }

        return $this->prepareToPrint($type, $path);
    }

    public function searchBreeds($type, $query) {
        $path = 'breeds/search?q=' . $query;

        if ($type === "both") {

           return $this->prepareBothToPrint($path); 
    
        }

        return $this->prepareToPrint($type, $path);
    }

    private function extractDataForDogs($line) {
        return [
            'type' => 'dog breed',
            'label' => $line['name'],
            'breed_group' => $line['breed_group'] ?? null,
            'temperament' => $line['temperament'] ?? null
        ];
    }

    private function extractDataForCats($line) {
        return [
            'type' => 'cat breed',
            'label' => $line['name'],
            'origin' => $line['origin'] ?? null,
            'temperament' => $line['temperament'] ?? null
        ];
    }

    private function prepareBothToPrint($path) {

        $listDog = $this->callApi("dog", $path);
        $toPrint = [];

        foreach ($listDog as $line) {
            $toPrint[$line['name']] = $this->extractDataForDogs($line);
        }

        $listCat = $this->callApi("cat", $path);

        foreach ($listCat as $line) {
            $toPrint[$line['name']] = $this->extractDataForCats($line);
        }

        ksort($toPrint);
        return $toPrint;

    }

    private function prepareToPrint($type, $path) {

        $list = $this->callApi($type, $path);
        $toPrint = [];
        foreach($list as $line) {
            $toPrint[] = $type == 'dog' ? $this->extractDataForDogs($line) : $this->extractDataForCats($line);
        }

        return $toPrint;

    }

    private function callApi($type, $path) {

        $fullPath = 'https://api.the' . $type . 'api.com/v1/' . $path;

        $jsonData = @file_get_contents($fullPath);

        if ($jsonData === false) { 
            echo "Error found.\n";
            die;
        } 

        $list = json_decode($jsonData, true);

        if ($list === null) {
            echo "Json cannot be decoded.\n";
            die;
        }

        return $list;
    }
}