<?php
require_once '../modal.php';

$cursor = $top_news_co->find();
foreach ($cursor as $item) {
    $timestamp = strtotime($item['time']);
    $top_news_co->updateOne(['_id' => $item['_id']],['$set' => ['timestamp' => $timestamp]]);
}
$cursor = $recommend_news_co->find();
foreach ($cursor as $item) {
    $timestamp = strtotime($item['time']);
    $recommend_news_co->updateOne(['_id' => $item['_id']],['$set' => ['timestamp' => $timestamp]]);
}

$cursor = $news_co->find();
foreach ($cursor as $item) {
    $timestamp = strtotime($item['time']);
    $news_co->updateOne(['_id' => $item['_id']],['$set' => ['timestamp' => $timestamp]]);
}
