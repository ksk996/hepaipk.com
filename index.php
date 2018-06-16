<?php
require_once 'modal.php';
$typeMap = ['root' => 'array', 'array' => 'array', 'document' => 'array'];
$ads_cursor = $ads_co->find([], ['typeMap' => $typeMap]);
$ads = [];
foreach ($ads_cursor as $ad) {
    $ads[$ad['position']] = $ad;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>河牌网</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/common.css">
	<link rel="stylesheet" href="assets/css/index.css">

</head>
<body>
<div class="container">
    <?php require_once 'common.php' ?>
	<div class="ad row">
		<img src="<?php echo $ads['header']['img']; ?>" class="img-responsive">
	</div>
	<div class="row">
		<div class="news-left">
			<div class="events-list">
				<div class="title">
					<span id="events-title">赛事日历</span>
				</div>
				<div class="content">
                    <?php
                    date_default_timezone_set('Asia/Shanghai');
                    $current_timestamp = strtotime('now');
                    $events_cursor = $events_co->find(
                        ['event_date_timestamp' => ['$exists' => true, '$gte' => $current_timestamp]],
                        [
                            'typeMap' => $typeMap, 'limit' => 4,
                            'sort' => ['order' => 1],
                        ]
                    );
                    foreach ($events_cursor as $event) {
                        $event_date = date('m月d日', $event['event_date_timestamp']);
                        $event_logo = $event['event_logo'];
                        $event_title = $event['event_name'];
                        $event_place = $event['event_place'];
                        $event_url = $event['event_url'];
                        $event_award = $event['event_award'];
                        echo <<<EOF
<div class="event-item">
<div class="event-left-box">
<span class="event-date">$event_date</span>
<img src="$event_logo" class="img-responsive">
</div>
<div class="event-right-box">
<span class="event-title">$event_title</span>
<span class="event-place">$event_place</span>
<p><span class="event-award">奖池：$event_award</span><a class="event-link" href="$event_url" target="_blank">详情</a></p>
</div>
</div>
EOF;

                    }
                    ?>
				</div>
			</div>

			<div class="news-list">
				<div class="title">
					<span id="news-title">扑克资讯</span>
					<span id="news-more"><a href="news.php">更多>></a></span>
				</div>
				<div class="content">
					<ul>
                        <?php
                        $news_cursor = $news_co->find(
                            [],
                            [
                                'typeMap' => $typeMap, 'limit' => 6,
                                'sort' => ['order' => 1],
                            ]
                        );
                        foreach ($news_cursor as $news) {
                            $title = $news['title'];
                            $time = date('Y-m-d', strtotime($news['time']));
                            $img = $news['image'];
                            $desc = $news['desc'];
                            $news_id = $news['_id'];
                            $url = "news_detail.php?id=$news_id&news_type=normal";
                            echo <<< EOF
<li><span style="width:70%;display:inline-block"><a href="$url" target="_blank">·&nbsp&nbsp$title</a></span><a href="$url" target="_blank"> $time</a></span></li>
EOF;
                        }
                        ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="rankings">
			<div id="total_ranking-container">
				<div class="title">
					<span id="news-title">综合排名</span>
					<span id="news-more"><a href="club.php">更多>></a></span>
				</div>
				<div class="ranking-list">
                    <?php
                    $total_ranking_cursor = $total_ranking_co->find(
                        [],
                        [
                            'limit' => 5,
                            'typeMap' => $typeMap,
                            'sort' => ['paiming' => 1]
                        ]
                    );
                    foreach ($total_ranking_cursor as $ranking) {
                        $qrcode = $ranking['qrcode_img'];
                        $title = $ranking['title'];
                        $num_of_people = $ranking['num_of_people'];
                        $desc = $ranking['description'];
                        $paiming = $ranking['paiming'];
                        $club_id = $ranking['_id'];
                        echo <<<EOF
<div class="ranking" data-name="$title" data-type="total_ranking" data-club_id="$club_id">
<span class="ranking_$paiming ranking_paiming">$paiming</span>
<img src="$qrcode" class="img-responsive">
<p class="club-info">
<span class="club-title">$title</span>
<span class="num-of-people">人数：$num_of_people</span>
<span class="club-desc">$desc</span>
<span class="more-info"><a href="club_detail.php?type=total_ranking&id=$club_id" style="color:white">更多详情</a></span>
</p>
</div>
EOF;

                    }
                    ?>
				</div>
			</div>
			<div id="pkpoker_ranking-container">
				<div class="title">
					<span id="news-title">PKpoker排名</span>
					<span id="news-more"><a href="club.php">更多>></a></span>

				</div>
				<div class="ranking-list">
                    <?php
                    $pkpoker_ranking_cursor = $pkpoker_ranking_co->find(
                        [],
                        [
                            'limit' => 5,
                            'typeMap' => $typeMap,
                            'sort' => ['paiming' => 1]
                        ]
                    );
                    foreach ($pkpoker_ranking_cursor as $ranking) {
                        $qrcode = $ranking['qrcode_img'];
                        $title = $ranking['title'];
                        $num_of_people = $ranking['num_of_people'];
                        $desc = $ranking['description'];
                        $paiming = $ranking['paiming'];
                        $club_id = $ranking['_id'];
                        echo <<<EOF
<div class="ranking" data-type="pkpoker_ranking" data-club_id="$club_id">
<span class="ranking_$paiming ranking_paiming">$paiming</span>
<img src="$qrcode" class="img-responsive">
<p class="club-info">
<span class="club-title">$title</span>
<span class="num-of-people">人数：$num_of_people</span>
<span class="club-desc">$desc</span>
<span class="more-info"><a href="club_detail.php?type=pkpoker_ranking&id=$club_id" style="color:white">更多详情</a></span>
</p>
</div>
EOF;

                    }
                    ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="celue-container">
		<div class="title">
			<span id="news-title">扑克策略</span>
			<span id="news-more"><a href="news.php">更多>></a></span>
		</div>
		<div class="celue-list">
            <?php
            $celues = [];
            $culues_cursor = $celue_co->find(
                [],
                [
                    'typeMap' => $typeMap, 'limit' => 18,
                ]
            );
            foreach ($culues_cursor as $celue) {
                array_push($celues, $celue);
            }
            for ($i = 0; $i < 3; $i++) {
                $tmp_celues = array_slice($celues, $i, 6);
                echo "<div class='col-md-4'><ul>";
                foreach ($tmp_celues as $tmp_celue) {
                    $title = $tmp_celue['title'];
                    $url = 'celue_detail.php?id=' . $tmp_celue['_id'];
                    echo "<li><a href=\"$url\" target=\"_blank\">$title</a></li> ";
                }
                echo "</ul></div>";
            }
            ?>
		</div>
	</div>
	<div class="ad row">
		<img src="<?php echo $ads['footer']['img']; ?>" class="img-responsive">
	</div>
    <?php
    require_once 'footer.php';
    ?>
	<div class="right-bar"
		 style="background-color: white;position: fixed; bottom: 200px;right: 0;height: 114px;width: 182px;border: 1px solid #f7e8bb">
		<div style="height: 30px;background: #f7e8bb; color: black; display: flex;align-items: center;justify-content: center;">
			商务合作
		</div>
		<div style="display: flex;flex-direction:column;align-items: center;margin-top: 20px;justify-content: center;">
			<span>QQ: 973530000
 <a style="color: #dfa300;" href="#">在线咨询</a></span>
			<span>微信: woniupuke <a style="color: #dfa300;" href="#">在线咨询</a></span>
		</div>
	</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $(".ranking").click(function () {
            let club_paiming_type = $(this).data('type');
            let club_id = $(this).data('club_id');
            window.location.href = 'club_detail.php?type=' + club_paiming_type + '&id=' + club_id;
        })
    })
</script>
</body>
</html>
