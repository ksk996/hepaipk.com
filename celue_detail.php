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
    if (!isset($_GET['id']) || empty($_GET['id']) ) {
        die();
    }
    $celue_id = $_GET['id'];
    $celue = $celue_co->findOne(['_id' => $celue_id]);
    $celue_content = $celue['content'];
    $celue_title = $celue['title'];
    echo <<<EOF
<div class="row" style="border: 1px solid #ddd;padding: 20px;font-size: 16px;">
<div class="col-md-12" style="margin-bottom: 50px">
<h2 style="text-align: center">$celue_title</h2>
</div>
<div class="col-md-12 news_content" >
$celue_content
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
