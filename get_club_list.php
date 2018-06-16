<?php
require_once 'modal.php';

if (!isset($_GET['type']) || !isset($_GET['page'])) {
    echo json_encode(['code' => 3000]);
    exit();
}

$type = trim($_GET['type']);
if (!in_array($type,['total_ranking','pkpoker_ranking'])) {
    echo json_encode(['code' => 3001]);
    exit();
}
if ($type == 'total_ranking') {
    $collection = $total_ranking_co;
} else {
    $collection = $pkpoker_ranking_co;
}
$page = intval($_GET['page']);
$club_count_for_per_page = 10;

$total_count = $collection->count();
$club_co = $collection->find(
    [],
    [
        'typeMap' => $typeMap, 'limit' => $club_count_for_per_page, 'sort' => ['paiming' => 1],
        'skip' => ($page-1) *$club_count_for_per_page
    ]
);
$clubs = [];
foreach ($club_co as $club) {
    $club['detail_page'] = 'club_detail.php?id='.$club['_id'].'&type='.$type;
    array_push($clubs, $club);
}
echo json_encode(['code' => 1, 'data' => ['clubs' => $clubs,'total_count' => $total_count,'total_page' => ceil($total_count/$club_count_for_per_page)]]);
exit();