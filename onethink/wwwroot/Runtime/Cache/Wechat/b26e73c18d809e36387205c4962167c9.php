<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/Public/Home/Wechat/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Home/Wechat/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <!--导航部分-->
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid text-center">
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo U('Wechat/index');?>" class="navbar-link">首页</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
        </div>
        <div class="col-xs-3">
            <p class="navbar-text"><a href="<?php echo U('Wechat/content');?>" class="navbar-link">我的</a></p>
        </div>
    </div>
</nav>
<!--导航结束-->
    <!--导航结束-->

    <div class="container-fluid">
        <div class="blank"></div>
        <h3 class="noticeDetailTitle"><strong><h1><?php echo ($info[0]['title']); ?></h1></strong></h3>
        <div class="noticeDetailInfo">发布者:<?php echo ($info['user']); ?></div>

        <div class="noticeDetailInfo">建时间：<?php echo (time_format($info[0]['create_time'])); ?></div>
        <br/>
        <div class="noticeDetailInfo">内容：<?php echo ($info[0]['description']); ?></div>
        <!--<a href="javascript:void(0)">"<u><h3>报名参加</h3></u>"</a>-->
        <div class="noticeDetailContent">
            <img src="<?php echo ($info['img']); ?>"  height="400px" alt="没有图片"/>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/Public/Wechat/jquery-1.11.2.min.js"></script>
<script src="/Public/Wechat/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
//    $('a').click(function(){
//         console.debug(123,$(this));
//        var document =<?php echo ($info[0]['id']); ?>;
//        $.post('?s=/Wechat/Wechat/addactive.html',{'document':document},function(e){
//            console.debug(e);
//           if(e==1){
//               alert("报名成功等待后台确定");
//           }else{
//               alert("已经报名等待确定");
//           }
//        },'json')
//    });




</script>
</body>
</html>