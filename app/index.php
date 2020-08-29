<?php
header('Content-Type: application/json');

$filename = "../logs/log.txt";

$fhandle = fopen($filename, 'r');
while (!feof($fhandle)) {
    $data[] = fgets($fhandle);
}

fclose($fhandle);

$dataArray = array();
if (!empty($data[2]) && isset($data[2])) {
    $json = str_replace("Instance metadata: ", "", $data[2]);
    $string = str_replace("u'", "'", $json);
    $encode = json_encode(trim($string));
    $decode = json_decode($encode, true);

    $part1 = explode("'instance-id': '", $decode);
    $part2 = explode("', 'local-ipv4':", $part1[1]);
    $instaceId = explode("',", $part2[0])[0];
    $dataArray["instance"] = $instaceId;

    $part1 = explode("'public-hostname': '", $decode);
    $part2 = explode("', 'vpc-ipv4-cidr-blocks'", $part1[1]);
    $hostName = $part2[0];
    $dataArray["hostname"] = $hostName;

    $part1 = explode("'public-ipv4s': '", $decode);
    $part2 = explode("', 'interface-id'", $part1[1]);
    $publicIPV4 = $part2[0];
    $dataArray["public_ipv4"] = $publicIPV4;

    $part1 = explode("'region'", $decode);
    $part2 = explode("', 'availability-zone'", $part1[1]);
    $region = explode("'", $part2[0])[1];
    $dataArray["region"] = $region;
}

$fp = fopen($filename, "r");

$content = fread($fp, filesize($filename));
$lines = explode("\n", $content);
$arr = [];

$array = array();
foreach ($lines as $key => $line) {
    if ($key >= 4 && $key <= 10) {
        $data = explode(":", $line);
        $array[$data[0]] = explode(" ", $data[1])[1];
    }
}

$result = array_merge($array, $dataArray);
echo json_encode($result);