<?php
require_once 'modal.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>河牌网</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/common.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<style>
		.news-content img{
			max-width: 100%;
		}
	</style>
</head>
<body>
<div class="container">
    <?php require_once 'common.php' ?>
    <?php
    if (!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['news_type']) || empty($_GET['news_type'])) {
        die();
    }
    $news_type = $_GET['news_type'];
    if ($news_type == 'normal') {
		$collection = $news_co;
	}elseif ($news_type == 'top') {
    	$collection = $top_news_co;
	}elseif ($news_type == 'recommend') {
    	$collection = $recommend_news_co;
	}
    $news_id = $_GET['id'];
    $news = $collection->findOne(['_id' => $news_id]);
    $news_content = $news['content'];
    $news_title = $news['title'];
    $news_time = $news['time'];
    echo <<<EOF
<div class="row" style="border: 1px solid #ddd;padding: 20px;font-size: 16px;">
<div class="col-md-12" style="margin-bottom: 50px">
<h2 style="text-align: center">$news_title</h2>
<h5 style="text-align: center">时间：$news_time</h5>
</div>
<div class="col-md-12 news_content" >
$news_content
</div>
</div>
EOF;

    ?>
    <?php
    require_once 'footer.php';
    ?>
</div>
</body>
</html>
