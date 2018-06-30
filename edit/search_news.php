<?php
require_once '../modal.php';

$keyword = trim($_GET['q']);

$news = [];

$query = [
    'title' => ['$regex' => new MongoDB\BSON\Regex($keyword, 'i')]
];

$cursor = $recommend_news_co->find($query, ['typeMap' => $typeMap]);


foreach ($cursor as $new) {
    array_push($news, $new);
}

$cursor = $top_news_co->find($query, ['typeMap' => $typeMap]);

foreach ($cursor as $new) {
    array_push($news, $new);
}

$cursor = $news_co->find($query, ['typeMap' => $typeMap]);

foreach ($cursor as $new) {
    array_push($news, $new);
}
$news = array_values(array_unique($news));
echo json_encode(['code' => '0', 'data' => $news]);
exit();