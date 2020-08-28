<?php
header('Content-Type: application/json');

$filename = "../logs/log.txt";
$fp = fopen($filename, "r");

$content = fread($fp, filesize($filename));
$lines = explode("\n", $content);
fclose($fp);

$arr = [];

foreach($lines as $key=>$line) {
    if($key >= 4 && $key <= 10){
        $data = explode(":", $line);
        $dataContent = explode(" ", $data[1]);
        array_push($arr, [$data[0] => $dataContent[1]]);
    }
}

echo json_encode($arr);
