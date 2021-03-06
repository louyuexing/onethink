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
       <?php foreach($info as $row):?>
        <div class="row noticeList">
            <div class="col-xs-2">

                <img class="noticeImg" src="<?php echo ($row['img']); ?>" width="90px" height="90px" alt="图片丢失"/>

            </div>
            <div class="col-xs-10">
                <p class="title"><a href="<?php echo U('Wechat/noticeinfo?id='.$row['id']);?>"><?php echo ($row['title']); ?></a></p>
                <p class="intro"><?php echo ($row['description']); ?></p>
                <p class="info">浏览: <?php echo ($row['view']); ?><span class="pull-right"><?php echo (time_format($row['create_time'])); ?></span> </p>
            </div>
        </div>
        <?php endforeach;?>
        <div id="amore"></div>
    </div>

    <span style="display:block; width:1200px; text-align:center"><input type="button" value="获得更多" id="more" /></span>
    <!--<div><a href="<?php echo U('Wechat/active?page='.$i);?>" id="more">点击更多</a></div>-->

</div>







<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/Public/Wechat/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    var page=1;
   $('#more').click(function(){
          page++;
       $.post('?s=/Wechat/Wechat/notice.html',{'page':page},function(e){
           var html='';
           console.debug(e,9090);
          $(e).each(function(i,v){
              console.debug(v.id);
              console.debug(v);
              time=parseInt(v.create_time);
              console.debug(time);
              var date = new Date(time);
              var create_time=date.toLocaleString(time);

              html+='<div class="row noticeList"><div class="col-xs-2"><img class="noticeImg" src='+v.img+' width="90px" height="90px" alt="图片丢失"/> </div> <div class="col-xs-10"> <p class="title"><a href="?s=/Wechat/Wechat/noticeinfo/id/'+v.id+'.html">'+v.title+'</a></p> <p class="intro">'+v.description+'</p> <p class="info">浏览:'+v.view+' <span class="pull-right">'+create_time+'</span> </p> </div> </div>';
          });
           $(html).appendTo('#amore');
       },'json')

   });

</script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Public/Wechat/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>