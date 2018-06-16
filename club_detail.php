<?php
require_once 'modal.php';
if (!isset($_GET['type']) || empty($_GET['type']) || !isset($_GET['id']) || empty($_GET['id'])) {
    die();
}
$type = trim($_GET['type']);
if (!in_array($type, ['total_ranking', 'pkpoker_ranking'])) {
    die();
}

if ($type == 'total_ranking') {
    $collection = $total_ranking_co;
} else {
    $collection = $pkpoker_ranking_co;
}

$club_id = $_GET['id'];

$club = $collection->findOne(['_id' => $club_id]);
if (empty($club)) {
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>河牌网</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/common.css">
	<style>
		.club-info {
			display: flex;
			flex-direction: row;
			align-items: flex-start;
			position: relative;
			margin-bottom: 20px;
		}

		.club-info .header-img {
			height: 256px;
			width: 256px;
			margin-right: 20px;
		}

		.club-info div {
			display: flex;
			flex-direction: column;
			justify-content: flex-start;
		}

		.club-info .contact {
			bottom: 0;
			position: absolute;
		}

		.club-info .club-name {
			font-size: 20px;
			margin-bottom: 18px;
		}

		.club-info .num-of-people {
			margin-bottom: 14px;
		}

		.more-info {
			margin-top: 20px;
			margin-bottom: 12px;
			border: 1px solid #ddd;
			padding: 0;
		}

		.more-info .info-list .info {
			display: flex;
			flex-direction: column;
			padding: 14px 14px 40px;

			color: rgba(123, 124, 124, 1);
		}

		.more-info .info-list .info span:first-child {
			margin-bottom: 14px;
		}
	</style>
	<style>
		.slider-wrap {
			position: relative;
			margin: 0 auto;
			width: 1200px;
			border: 1px solid #ddd;
		}

		.slider {
			position: relative;
			width: 1100px;
			margin: auto;
		}

		ul {
			margin: 0;
			padding: 0;
		}

		ul li {
			list-style: none;
			text-align: center;
		}

		ul li img {
			display: inline-block !important;
			vertical-align: middle !important;
			width: 267px;
			height: 344px !important;
		}

		.slider-arrow {
			position: absolute;
			top: 170px;
			width: 50px;
			height: 50px;
		}

		.sa-left {
			left: 0;
		}

		.sa-right {
			right: 0;
		}

	</style>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.lbslider.js"></script>

	<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?php
    require_once 'common.php';
    ?>
    <?php
    $header_img = $club['logo'];
    $club_name = $club['title'];
    $contact = $club['contact'];
    $num_of_people = $club['num_of_people'];
    $description = $club['description'];
    $more_info = isset($club['more_info']) ? $club['more_info'] : '';
    echo <<<EOF
<div class="row club-info">
<img src="$header_img" class="img-responsive header-img">
<div>
<span class="club-name">$club_name</span>
<span class="num-of-people">人数：$num_of_people</span>
<span>$description</span>
<span class="contact">微信：$contact</span>
</div>
</div>
EOF;
    $intro_imgs = $club['intro_imgs'];
    $slider_imgs = '';

    if (count($intro_imgs) > 4) {
        foreach ($intro_imgs as $img) {
            $slider_imgs .= '<li> <img src=' . $img . ' class="img-responsive"></li>';
        }
        echo <<<EOF
    <div class="row">
<div class="slider-wrap">
<div class="slider">
<ul>
$slider_imgs
</ul>
</div>
<a href="#" class="slider-arrow sa-left"><img src="assets/images/left.png" class="img-responsive"></a> <a href="#" class="slider-arrow sa-right"><img src="assets/images/right.png" class="img-responsive"></a> </div> 
</div>

EOF;
    } else {
    	foreach ($intro_imgs as $img) {
    		$slider_imgs .= '<img src=' . $img . ' class="img-responsive" style="display:inline-block;margin-right: 10px">';
		}
        echo <<< EOF
	<div class="row">
$slider_imgs
</div>	 
EOF;
    }


    echo <<<EOF
<div class="row more-info">
<div class="title">
	<span class="text">更多信息</span>
</div>
<div class="more-info-text" style="padding: 20px">
$more_info
</div>			
</div>
</div>
EOF;
    ?>
    <?php
    require_once 'footer.php';
    ?>
</div>
<script>
    jQuery('.slider').lbSlider({
        leftBtn: '.sa-left', // left button selector
        rightBtn: '.sa-right', // right button selector
        visible: 4, // visible elements quantity
        autoPlay: true, // autoscroll
        autoPlayDelay: 10 // delay of autoscroll in seconds
    });
</script>
</body>
</html>