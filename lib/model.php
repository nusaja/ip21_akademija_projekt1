<?php

class Model {

    public function getListOfAllBreeds($type): array {
        $path = 'breeds';

        if ($type === "both") {
            $listDog = $this->callApi("dog", $path);
            $keyListDog = [];

            for ($i=0; $i<count($listDog); $i++) {
                $keyListDog[$listDog[$i]['name']] = "d";
            }

            $listCat = $this->callApi("cat", $path);
            $keyListCat = [];

            for ($i=0; $i<count($listCat); $i++) {
                $keyListCat[$listCat[$i]['name']] = "c";
            }

            $list = array_merge($keyListDog, $keyListCat);
            ksort($list);
            
            $toPrint = [];
            foreach($list as $key => $value) {
                $toPrint[] = [
                    'label' => $key,
                    'type' => $value === "d" ? "dog" : "cat"
                ];
            }

        } else {
            $list = $this->callApi($type, $path);

            $toPrint = [];
            foreach($list as $line) {
                $toPrint[] = [
                    'label' => $line['name'],
                    'type' => $type
                ];
           }
        }
        return $toPrint;
    }

    public function searchBreeds($type, $query) {
        $path = 'breeds/search?q=' . $query;

        if ($type === "both") {
            $listDog = $this->callApi("dog", $path);
            $keyListDog = [];

            for ($i=0; $i<count($listDog); $i++) {
                $keyListDog[$listDog[$i]['name']] = "d";
            }

            $listCat = $this->callApi("cat", $path);
            $keyListCat = [];

            for ($i=0; $i<count($listCat); $i++) {
                $keyListCat[$listCat[$i]['name']] = "c";
            }

            $list = array_merge($keyListDog, $keyListCat);
            ksort($list);
            
            $toPrint = [];
            foreach($list as $key => $value) {
                $toPrint[] = [
                    'label' => $key,
                    'type' => $value === "d" ? "dog" : "cat"
                ];
            }
        } else {
            $list = $this->callApi($type, $path);

            $toPrint = [];
            foreach($list as $line) {
                $toPrint[] = [
                    'label' => $line['name'],
                    'type' => $type
                ];
            }
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