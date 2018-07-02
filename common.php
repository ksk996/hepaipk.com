<?php
$url_path = parse_url($_SERVER['REQUEST_URI'])['path'];
$arrow_html = "<img src=\"assets/images/arrow.png\"  class=\"img-responsive\">";
$index_page_active = null;
$club_page_active = null;
$news_page_active = null;
$celue_page_active = null;
$bbs_page_active = null;
if (in_array($url_path, ['/', '/index.php'])) {
    $index_page_active = 'active';
} elseif ($url_path == '/club.php' || $url_path == '/club_detail.php') {
    $club_page_active = 'active';
} elseif ($url_path == '/news.php' || $url_path == '/news_detail.php') {
    $news_page_active = 'active';
} elseif ($url_path == '/celue.php' || $url_path == '/celue_detail.php') {
    $celue_page_active = 'active';
} elseif ($url_path == '/bbs.php') {
    $bbs_page_active = 'active';
}
echo <<< EOF
<div class="row logo">

</div>
<div class="row nav">
    <div style="background:white">
        <img src="assets/images/logo.png" class="img-responsive" style="width: 60px;height: 60px">
    </div>
    <div class="nav-item $index_page_active">
        <a href="index.php">首页</a>
        $arrow_html
    </div>
    <div class="nav-item $club_page_active">
        <a href="club.php"> 俱乐部</a>
        $arrow_html
    </div>
    <div class="nav-item $bbs_page_active">
        <a href="bbs.php">讨论区</a>
        $arrow_html
    </div>
    <div class="nav-item $news_page_active">
        <a href="news.php">扑克资讯</a>
        $arrow_html
    </div>
    <div class="nav-item $celue_page_active">
        <a href="celue.php">扑克策略</a>
        $arrow_html
    </div>
</div>
EOF;
?>
