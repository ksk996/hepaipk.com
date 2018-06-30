<?php
require_once '../modal.php';

$keyword = trim($_GET['title']);

$news = [];

$query = [
    'title' => $keyword
];

$cursor = $recommend_news_co->deleteOne($query);


$cursor = $top_news_co->deleteOne($query);


$cursor = $news_co->deleteOne($query);


echo json_encode(['code' => '0000']);
exit();