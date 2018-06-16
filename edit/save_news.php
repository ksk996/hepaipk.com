<?php
require_once '../modal.php';

function generateRCID()
{
    // From: http://codeaid.net/php/generate-a-random-guid
    if (function_exists('com_create_guid')) {
        return substr(com_create_guid(), 1, 36);
    } else {
        mt_srand((double)microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));

        $guid = substr($charid, 0, 8) .
            substr($charid, 8, 4) .
            substr($charid, 12, 4) .
            substr($charid, 16, 4) .
            substr($charid, 20, 12);

        return strtolower($guid);
    }
}

$title = trim($_POST['title']);
$date = $_POST['date'];
$content = trim($_POST['content']);
$is_top_news = $_POST['is_top_news'];
$is_recommend_news = $_POST['is_recommend_news'];
$thumbnail = $_POST['thumbnail'];


$local_time = date("Y-m-d H:m", strtotime($date));

$news = [
    '_id' => generateRCID(),
    'title' => $title,
    'content' => $content,
    'time' => $local_time,
    'order' => 1,
    'image' => $thumbnail,
    'desc' => mb_substr(strip_tags($content),0,100),
    'timestamp' => strtotime($local_time)
];

if($is_recommend_news == 'true') {
    $recommend_news_co->updateOne(
        [
            '_id' => $news['_id']
        ],
        [
            '$set' => $news,
        ],
        [
            'upsert' => true
        ]
    );
}
unset($news['order']);
$news['paiming'] = 1;
if ($is_top_news == 'true') {
    $top_news_co->updateOne(
        [
            '_id' => $news['_id']
        ],
        [
            '$set' => $news
        ],
        [
            'upsert' => true
        ]
    );
}
$news_co->updateOne(
    [
        '_id' => $news['_id']
    ],
    [
        '$set' => $news
    ],
    [
        'upsert' => true
    ]
);
echo json_encode(
    [
        'code' => '0000'
    ]
);