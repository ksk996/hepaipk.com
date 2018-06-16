<?php
require_once '../modal.php';

$q = $_GET['q'];
$type = $_GET['type'];

if ($type == 'total_ranking') {
    $collection = $total_ranking_co;
} else {
    $collection = $pkpoker_ranking_co;
}

$query = [
    'title' => new MongoDB\BSON\Regex($q, 'i')
];
$cursor = $collection->find($query, ['typeMap' => ['root' => 'array', 'array' => 'array', 'document' => 'array']]);

$result = [];

$fields = [
    'paiming' => 1, 'qrcode_img' => null, 'logo' => null, 'intro_imgs' => [],
    'contact' => null, 'more_info' => null, 'num_of_people' => 0, 'description' => null, 'title' => null
];

foreach ($cursor as $item) {
    foreach ($fields as $key => $default_value) {
        $item[$key] = isset($item[$key]) && !empty($item[$key]) ? $item[$key] : $default_value;

    }
    array_push($result, $item);
}
echo json_encode(['code' => 0, 'data' => $result]);