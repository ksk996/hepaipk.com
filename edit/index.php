<?php
require_once 'session.php';
if ($uid == 'unknown') {
    header('Location: login.html');
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>河牌网</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<style>
		.main{
			margin-top: 80px;
		}
		.sidebar {
			position: fixed;
			top: 51px;
			bottom: 0;
			left: 0;
			z-index: 1000;
			display: block;
			padding: 20px 0;
			overflow-x: hidden;
			overflow-y: auto;
			background-color: #f5f5f5;
			border-right: 1px solid #eee;
		}
		.sidebar li a{
			color: #428bca;
		}
		.sidebar li.active {
			color: #fff ;
			background: #428bca;
		}
		.sidebar li.active a {
			color: #fff;
		}
		.club-content {
			margin-top: 20px;

		}

		.club-content div {
			padding: 0;
		}

		.active {
			background: blue;
			color: #ffffff;
		}
		#show-intro_imgs > div, #show-logo > div, #show-qrcode_img > div {
			display: inline-flex;
			flex-direction: column;
			align-items: center;
			margin-right: 10px;
		}
		#show-intro_imgs img, #show-logo img, #show-qrcode_img img{
			height: 100px;
			width: 100px;
			display: inline-block;
		}
		#show-intro_imgs span, #show-logo span, #show-qrcode_img span {
			border: 1px solid #ddd;
		}
		.del_img {
			margin-top:10px;
		}
	</style>
	<link rel="stylesheet" href="../assets/css/Huploadify.css">
	<link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">河牌网后台管理系统</a>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="col-sm-3 col-md-2 sidebar">
		<ul class="nav nav-sidebar">
			<li class="active"><a href="#">俱乐部</a></li>
			<li><a href="news.php">新闻</a></li>
		</ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

		<div class="row">
			<button type="button" class="btn-default btn select-paiming active" id="total_ranking">全部排名</button>
			<button type="button" class="btn-default btn select-paiming" id="pkpoker_ranking">Pkpoker排名</button>
		</div>
		<div class="row club-content">
			<div class="col-md-12">
				<form class="form-inline">
					<div class="form-group">
						<input type="text" class="form-control" id='search-item' placeholder="俱乐部名称">
					</div>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" id="search"
					">
					搜索
					</button>
					<button type="button" class="btn btn-primary" id="search"
					">
					查看所有
					</button>
				</form>
			</div>
			<input type="hidden" class="form-control" id="id" hidden placeholder="描述">

			<div class="col-md-12">
				<h4><span>描述</span></h4>
				<input type="text" class="form-control" id="description" placeholder="描述">
			</div>
			<div class="col-md-12">
				<h4><span>头图（只限一张）</span></h4>
				<div id="show-logo"></div>
				<div id="upload-logo"></div>
			</div>

			<div class="col-md-12">
				<h4><span>二维码（只限一张）</span></h4>
				<div id="show-qrcode_img"></div>
				<div id="upload-qrcode_img"></div>
			</div>
			<div class="col-md-12">
				<h4><span>图片集（不限图片张数）</span></h4>
				<div id="show-intro_imgs"></div>
				<div id="upload-intro_imgs"></div>
			</div>
			<div class="col-md-12">
				<h4><span>排名</span></h4>
				<input type="number" class="form-control" id="paiming" placeholder="排名（仅限数字）">
			</div>
			<div class="col-md-12">
				<h4><span>人数</span></h4>
				<input type="number" class="form-control" id="num_of_people" placeholder="参加人数（仅限数字）">
			</div>
			<div class="col-md-12">
				<h4><span>联系方式</span></h4>
				<input type="text" class="form-control" id="contact" placeholder="联系方式">
			</div>
			<div class="col-md-12">
				<h4><span>更多信息</span></h4>
				<textarea class="form-control" id="more_info" placeholder="更多信息（换行请用<br>）" rows="3"></textarea>
			</div>
			<button type="button" id="save" style="margin-top: 20px;" class="btn btn-default">保存</button>

		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">选择俱乐部</h4>
			</div>
			<div class="modal-body">
				<select id="modelRecommendPoi" multiple class="form-control">
					<option></option>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger del_club" style="visibility: hidden;" >删除</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">选择</button>
			</div>
		</div>
	</div>
</div>
<script src="../assets/js/jquery.min.js" rel="script"></script>
<script src="../assets/js/bootstrap.min.js" rel="script"></script>
<script src="../assets/js/jquery-ui.min.js" rel="script"></script>
<script src="../assets/js/jquery.Huploadify.js" rel="script"></script>
<script src="../assets/js/jquery-confirm.min.js" rel="script"></script>
<script src="../assets/js/edit.js" rel="script"></script>
</body>
</html>