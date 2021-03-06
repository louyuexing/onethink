<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>在线报修</title>

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
        <form method="post" action="<?php echo U('Wechat/online');?>">
            <div class="form-group">
                <label>您的姓名(必填):</label>

                <input type="text" class="form-control" name="username" id="usernmae"/>

            </div>
            <div class="form-group">
                <label>您的电话(必填):</label>
                <input type="text" class="form-control" name="tel" id="tel"/>

            </div>
            <div class="form-group">
                <label>您的地址(必填):</label>
                <input type="text" class="form-control" name="address" id="address"/>
            </div>
            <div class="form-group">
                <label>标题(必填):</label>
                <input type="text" class="form-control" name="title" id="title"/>
            </div>
            <div class="form-group">
                <label>内容(详细描述需要报修的内容):</label>
                <textarea type="text" class="form-control" name="content" style="height: 90px" id="content"></textarea>
            </div>
            <!--<div class="form-group">-->
                <!--<div><a href="#"><span class="glyphicon glyphicon-plus onlineUpImg"></span></a></div>-->
                <!--<label>图片(最多上传5张,可不上传):</label>-->
            <!--</div>-->
            <div class="form-group">
                <button class="btn btn-primary onlineBtn">确认提交</button>
            </div>
        </form>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/Public/Home/Wechat/jquery-1.11.2.min.js"></script>
<script src="/Public/Home/Wechat/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('input').blur(function(){
        var value=$(this).val();
        console.debug((($(this).val())-'')==0);
         if((($(this).val())-'')==0){
             var html='<u id="notice">必填不能为空</u>';
              var u=$(this).closest('.form-group').find('u').text();
            if(u==''){
                var p=$(this).closest('.form-group');
                $(html).appendTo(p);
            }
         }else{
             var u=$(this).closest('.form-group').find('u').remove();
         }


        var input=($('.container-fluid').find('.form-control:not(:last)'));
        var inputn=$(input).length;
        var num=0;
        $(input).each(function(i,v){
            if((($(v).val())-'')==0){
                num+=1;
            }
        });

        console.debug(num);
        if(num==0){
            $('.btn-primary').removeAttr('disabled');
        }



    });


    $('#tel').blur(function(){
        var tel=($(this).val());

        var reg = /^1[34578][0-9]{9}$/; //验证规则，[34578]之间不需要|

        var phoneNum = '15507621999';//手机号码

        var flag = reg.test(tel); //true

        if(!flag){
            var html='<u id="notice">电话号码输入错误:'+tel+'</u>';
            var p=$(this).closest('.form-group');
            $(html).appendTo(p);
        }else{
            var u=$(this).closest('.form-group').find('u').remove();
        }

    });


    $(function(){
        var input=($(this).find('.form-control:not(:last)'));
        var inputn=$(input).length;
        var num=0;
        $(input).each(function(i,v){
           if((($(v).val())-'')==0){
               num+=1;
           }
        });
        if(num!=0){
            $('.btn-primary').attr({'disabled':'disabled'});
        }
    });

</script>

</body>
</html>