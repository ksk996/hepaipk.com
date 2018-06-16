<?php
require_once 'vendor/autoload.php';


$m = new MongoDB\Client();

$DB_NAME = 'hepaipk';
$ADS_COLLECTION = 'ads';
$EVENTS_COLLECTION = 'events';
$CELUE_COLLECTION = 'celue';
$NEWS_COLLECTION = 'news';
$TOP_NEWS_COLLECTION = 'top_news';
$EVENTS_COLLECTION = 'events';
$RECOMMEND_NEWS_COLLECTION = 'recommend_news';
$TOTAL_RANKING_COLLECTION = 'total_ranking';
$PKPOKER_RANKING_COLLECTION = 'pkpoker_ranking';
$PKPOKER_EDITORS = 'editors';

$events_co = $m->$DB_NAME->$EVENTS_COLLECTION;
$news_co = $m->$DB_NAME->$NEWS_COLLECTION;
$top_news_co = $m->$DB_NAME->$TOP_NEWS_COLLECTION;
$recommend_news_co = $m->$DB_NAME->$RECOMMEND_NEWS_COLLECTION;
$celue_co = $m->$DB_NAME->$CELUE_COLLECTION;
$total_ranking_co = $m->$DB_NAME->$TOTAL_RANKING_COLLECTION;
$pkpoker_ranking_co = $m->$DB_NAME->$PKPOKER_RANKING_COLLECTION;
$ads_co = $m->$DB_NAME->$ADS_COLLECTION;
$events_co = $m->$DB_NAME->$EVENTS_COLLECTION;
$editors_co = $m->$DB_NAME->$PKPOKER_EDITORS;

$typeMap = ['root' => 'array', 'array' => 'array', 'document' => 'array'];

$StatusCode = [
    '3000' => 'Invalid parameters'
];