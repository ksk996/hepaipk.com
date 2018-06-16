<?php
require_once 'modal.php';
$total_count = $news_co->count();
$news_count_per_page = 5;
$total_page = round($total_count / $news_count_per_page);
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
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
		.container {
			padding: 0;
			width: 1200px;
		}

		.left {
			border: 1px solid #ddd;
			padding: 0;
			width: 840px;
			margin-right: 20px;
		}

		.left .news-list {
			padding-left: 18px;
			padding-right: 18px;
		}

		.left .news-list .news {
			border-bottom: 1px dashed #ddd;
			margin-bottom: 20px;
			color: rgba(123, 124, 124, 1);
		}

		.left .news-list .news p {
			margin-bottom: 10px;
		}

		.left .news-list .news div {
			display: flex;
			flex-direction: row;
			align-items: flex-start;

		}

		.left .news-list .news div img {
			height: 84px;
			width: 124px;
			margin-right: 4px;
		}

		.left .news-list .news .news-title {
			font-size: 16px;
			font-weight: 500;
			color: #000;
		}

		.page {
			text-align: center;
			margin-top: 40px;
		}

		.page a {
			border: 1px solid #ddd;
			color: #000;
			display: inline-block;
			height: 22px;
			margin-right: 4px;
		}

		.page a:hover {
			background: #ff6500;
			border: 1px solid #ff3300;
			color: white;

		}

		.page .normal {
			width: 22px;

		}

		.page .active {
			background: #ff6500;
			border: 1px solid #ff3300;
			color: white;
		}

		.right {
			width: 340px;
		}

		#top-news-container, #recommend-news-container {
			border: 1px solid #ddd;
			margin-bottom: 10px;
		}

		#recommend-news-container .news-list,
		#top-news-container .news-list {
			padding: 16px;
		}

		#recommend-news-container .news,
		#top-news-container .news {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			margin-bottom: 16px;
		}

		#recommend-news-container .news a,
		#top-news-container .news a {
			color: black;
		}

		#top-news-container .paiming {
			background: #999999;
			width: 20px;
			text-align: center;
			color: white;
			display: inline-block;
		}

		#top-news-container .paiming_1,
		#top-news-container .paiming_2,
		#top-news-container .paiming_3 {
			background: #ff3300;
			color: white;
		}
	</style>
</head>
<body>
<div class="container">
    <?php require_once 'common.php' ?>
	<div class="row" style="display: flex; margin-bottom: 20px;">

		<div class="left">
			<div class="title">
				<span class="text">扑克策略</span>
			</div>
			<div class="news-list">
                <?php
                $news_cursor = $news_co->find(
                    [],
                    [
                        'typeMap' => $typeMap, 'limit' => $news_count_per_page, 'skip' => ($page - 1) * $news_count_per_page,
                        'sort' => ['order' => 1,'timestamp' => -1],
                    ]
                );
                foreach ($news_cursor as $news) {
                    $title = $news['title'];
                    $time = $news['time'];
                    $img = $news['image'];
                    $desc = $news['desc'];
                    $news_id = $news['_id'];
                    $url = "news_detail.php?id=$news_id&news_type=normal";
                    echo <<< EOF
<div class="news" data-news_id="$news_id">
<p class="news-title"><a href="$url" target="_blank" style="color: #000000" >$title</a></p>
<p>$time</p>
<div>
<img src="$img" class="img-responsive">
<span>$desc<a href="$url" target="_blank" >阅读原文</a></span>
</div>
</div>
EOF;
                }
                ?>
			</div>
			<div class="page">
				<span><a href="news.php?page=1" class="first-page">首页</a></span>
                <?php
                if ($page > 1) {
                    $pre_page = $page - 1;
                    echo "<span><a href=\"news.php?page=$pre_page\" class='pre-page'>上一页</a></span>";
                }
                if ($page < 5) {
                    $max_page = min(10, $total_page);
                } else {

                    $max_page = min($page + 4, $total_page);
                }
                $min_page = max(1, $page - 4);
                for ($tmp = $min_page; $tmp <= $max_page; $tmp++) {
                    $active = $tmp == $page ? 'active' : false;
                    echo "<span><a href=\"news.php?page=$tmp\" class=\"normal $active\">$tmp</a></span>";
                }
                if ($page < $total_page) {
                    $next_page = $page + 1;
                    echo "<span><a href=\"news.php?page=$next_page\" class='next-page'>下一页</a></span>";

                }
                ?>
				<span><a href="news.php?page=<?php echo $total_page; ?>" class="last-page">末页</a></span>
				<span>共<?php echo $total_page . "页" . $total_count . '条'; ?></span>
			</div>
		</div>
		<div class="right">
			<div id="top-news-container">
				<div class="title">
					<span class="text">新闻排行榜</span>
				</div>
				<div class="news-list">
                    <?php
                    $top_news_cursor = $top_news_co->find(
                        [],
                        [
                            'typeMap' => $typeMap,
                            'limit' => 12,
                            'sort' => ['paiming' => 1,'timestamp' => -1]
                        ]
                    );
                    foreach ($top_news_cursor as $news) {
                        $paiming = $news['paiming'];
                        $text = $news['title'];
                        $news_id = $news['_id'];
                        $url = "news_detail.php?id=$news_id&news_type=top";
                        echo <<< EOF
<div class="news">
<span class="paiming paiming_$paiming">$paiming</span>&nbsp
<span><a href="$url" target="_blank">$text</a></span>
</div>
EOF;

                    }
                    ?>
				</div>
			</div>
			<div id="recommend-news-container">
				<div class="title">
					<span class="text">推荐新闻</span>
				</div>
				<div class="news-list">
                    <?php
                    $recommend_news_cursor = $recommend_news_co->find(
                        [],
                        [
                            'typeMap' => $typeMap,
                            'limit' => 12,
                            'sort' => ['paiming' => 1,'timestamp' => -1]
                        ]
                    );
                    foreach ($recommend_news_cursor as $news) {
                        $news_title = $news['title'];
                        $news_id = $news['_id'];
                        $url = "news_detail.php?id=$news_id&news_type=recommend";
                        echo <<< EOF
<div class="news">
<span><a href="$url" target="_blank">·&nbsp$news_title</a></span>
</div>
EOF;

                    }
                    ?>
				</div>
			</div>
		</div>
	</div>
    <?php
    require_once 'footer.php';
    ?>
</div>
</body>
</html>