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
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"
		  rel="stylesheet">
	<style>
		.main {
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

		.sidebar li a {
			color: #428bca;
		}

		.sidebar li.active {
			color: #fff;
			background: #428bca;
		}

		.sidebar li.active a {
			color: #fff;
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

		#show-intro_imgs img, #show-logo img, #show-qrcode_img img {
			height: 100px;
			width: 100px;
			display: inline-block;
		}

		#show-intro_imgs span, #show-logo span, #show-qrcode_img span {
			border: 1px solid #ddd;
		}

		.del_img {
			margin-top: 10px;
		}
	</style>
	<link rel="stylesheet" href="../assets/css/Huploadify.css">
	<link rel="stylesheet" href="../assets/css/jquery-confirm.min.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
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
			<li><a href="index.php">俱乐部</a></li>
			<li class="active"><a href="news.php">新闻</a></li>
		</ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<h4><span>新闻标题</span></h4>
				<input type="text" class="form-control" id="news-title" placeholder="新闻标题">
			</div>
			<div class="col-md-12">
				<h4><span>发布日期</span></h4>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
						<input type='text' id="news-date" class="form-control"/>
						<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<h4><span>新闻缩略图</span></h4>
				<div id="show-thumbnail_img"></div>
				<div id="upload-thumbnail_img"></div>
			</div>

			<div class="col-md-12">
				<h4><span>发布内容</span></h4>
				<div id="summernote"></div>
			</div>
			<div class="col-md-12">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="is-recommend-news">推荐新闻
					</label>
					<label>
						<input type="checkbox" id="is-top-news">置顶新闻
					</label>

				</div>
			</div>
			<div class="col-md-12">

				<button type="button" id="save-news" style="margin-top: 20px;" class="btn btn-default">保存</button>
			</div>
		</div>
	</div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.Huploadify.js" rel="script"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.bootcss.com/bootstrap-datetimepicker/4.17.45/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(document).ready(function () {
        var thumbnail = null;


        $('#summernote').summernote({
            placeholder: '河牌网',
            tabsize: 2,
            height: 300,
            callbacks: {
                onImageUpload: function (files, editor, welEditable) {
                    var $files = $(files);
                    $files.each(function () {
                        var file = this;
                        var data = new FormData();
                        data.append("file", file);
                        $.ajax({
                            data: data,
                            type: "POST",
                            url: './upload_img.php',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                let img = JSON.parse(response)['s3_img_link'];
                                $('#summernote').summernote('insertImage', img);
                            },
                            error: function () {

                            }
                        });
                    });
                }
            }
        });
        var current = moment().format('YYYY-MM-DD h:mm');
        $('#datetimepicker1').datetimepicker({defaultDate: current,});
        $('body').on('click', '#save-news', function () {
            let news_title = $("#news-title").val();
            let news_date = $("#news-date").val();
            let news_content = $("#summernote").summernote('code');
            let is_recoomend_news = $("#is-recommend-news").is(':checked');
            let is_top_news = $("#is-top-news").is(':checked');
            if (!news_title) {
                alert("文章标题不能空");
                return;
            }
            console.log(news_date);
            if (!news_date) {
                alert("文章发布时间不能空");
                return;
            }
            if (!news_content) {
                alert("文章内容不能空");
                return;
            }
            if (!thumbnail) {
                alert("缩略图不能为空");
                return;
            }
            $.post(
                'save_news.php',
                {
                    'title': news_title,
                    'date': news_date,
                    'content': news_content,
                    'is_top_news': is_top_news,
                    'thumbnail': thumbnail,
                    'is_recommend_news': is_recoomend_news
                },
                function (data, status) {
                    if (status === 'success') {
                        alert("添加成功");
                        location.reload();
                    }else{
                        alert("保存失败，请重新尝试")
					}
                }
            )
        });


        var up = $('#upload-thumbnail_img').Huploadify({
            auto: false,
            fileTypeExts: '*.*',
            multi: false,
            formData: {key: 'thumbnail'},
            fileSizeLimit: 99999999999,
            showUploadedPercent: true,
            showUploadedSize: true,
            removeTimeout: 9999999,
            uploader: 'upload_img.php',
            onUploadStart: function (file) {
                console.log(file.name + '开始上传');
            },
            onInit: function (obj) {
                console.log('初始化');
                console.log(obj);
            },
            onUploadComplete: function (file, result) {
                console.log(file.name + '上传完成');
                let object_result = $.parseJSON(result);
                if (object_result['code'] !== '0000') {
                    alert("上传图片失败");
                    return;
                }
                alert("上传成功");
                let img_link = object_result['s3_img_link'];
                thumbnail = img_link;
                $(`#show-thumbnail_img`).empty().append("<div><img src='" + img_link + "' class='img-responsive' style='width: 100px;'><button class='del_img btn-xs btn btn-danger'>删除</button></div>");
            },
            onCancel: function (file) {
                console.log(file.name + '删除成功');
            },
            onClearQueue: function (queueItemCount) {
                console.log('有' + queueItemCount + '个文件被删除了');
            },
            onDestroy: function () {
                console.log('destroyed!');
            },
            onSelect: function (file) {

            },
            onQueueComplete: function (queueData) {
                console.log('队列中的文件全部上传完成', queueData);
            }
        });

    })
</script>
</body>
</html>