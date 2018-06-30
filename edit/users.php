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
            <li><a href="news.php">新闻</a></li>
            <li class="active"><a href="users.php">用户</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="row">
            <div class="col-md-12">
                <h2>修改密码</h2>
            </div>
            <div class="col-md-5">
                <input type="password" data-user="<?php echo $uid; ?>" id="password" class="form-control" placeholder="新的密码" required="" style="margin-top: 20px">
            </div>
            <div class="col-md-12">
                <button type="button" id="save" style="margin-top: 20px;" class="btn btn-default">保存</button>
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
        $("#save").click(function () {

            let username = $("#password").data('user');
            let password = $("#password").val();
            if (password.length === 0) {
                alert("密码不能为空");
                return;
            }
            $.getJSON("save_user.php", { 'username': username, 'password': password })
                .done(function (result) {
                    if (result.code === '0') {
                        alert("密码修改成功");
                        location.reload()
                    } else {
                        alert("保存失败，请重新尝试");
                    }
                })
                .fail(function () {
                    alert("网络错误");

                });
        })

    })
</script>
</body>
</html>