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
$description = trim($_POST['description']);
$paiming = intval($_POST['paiming']);
$contact = trim($_POST['contact']);
$num_of_people = intval($_POST['num_of_people']);
$more_info = $_POST['more_info'];
$logo = trim($_POST['logo']);
$qrcode_img = trim($_POST['qrcode_img']);
$intro_imgs = isset($_POST['intro_imgs']) ? $_POST['intro_imgs'] : [];
$current_type = trim($_POST['current_type']);
$id = !empty(trim($_POST['id'])) ? trim($_POST['id']) : generateRCID();

if ($current_type == 'total_ranking') {
    $collection = $total_ranking_co;
} else {
    $collection = $pkpoker_ranking_co;
}
$updated_at = new MongoDb\BSON\UTCDateTime(time() * 1000);

$updateResult = $collection->updateOne(
    [
        '_id' => $id
    ],
    [
        '$set' => [
            'title' => $title,
            'description' => $description,
            'paiming' => $paiming,
            'contact' => $contact,
            'num_of_people' => $num_of_people,
            'logo' => $logo,
            'qrcode_img' => $qrcode_img,
            'intro_imgs' => $intro_imgs,
            'updated_at' => $updated_at,
            'more_info' => $more_info
        ]
    ],
    [
        'upsert' => true
    ]
);

//Reorder club paiming
$cursor = $collection->find(['paiming' => ['$ne' => 0]], ['sort' => ['paiming' => 1, 'updated_at' => -1]]);
$current_paiming = 1;
foreach ($cursor as $club) {
    if ($current_paiming == $club['paiming']) {
        $current_paiming += 1;
        continue;
    }
    $collection->updateOne(['_id' => $club['_id']], ['$set' => ['paiming' => $current_paiming, 'updated_at' => $updated_at]]);
    $current_paiming += 1;
}

$result = ['code' => '0000', 'msg' => '保存成功'];
echo json_encode($result);

