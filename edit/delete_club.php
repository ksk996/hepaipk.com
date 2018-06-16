<?php
require_once '../modal.php';

$club_id = $_GET['id'];
$type = $_GET['type'];

if ($type == 'total_ranking') {
    $collection = $total_ranking_co;
} else {
    $collection = $pkpoker_ranking_co;
}

$deleteResult = $collection->deleteOne(['_id' => $club_id]);

if ($deleteResult->getDeletedCount() == 1) {
    echo json_encode(['code' => '0000']);
} else {
    echo json_encode(['code' => '2000']);
}

