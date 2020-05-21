<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ($_site['name']); ?>-登录</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="/Public/admin/css/bootstrap.min.css">
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/admin/css/AdminLTE.min.css">
<link rel="stylesheet" href="/Public/admin/css/blue.css">
<link rel="stylesheet" href="/Public/layer/skin/default/layer.css">
<link href="/Public/admin/images/favicon.ico" rel="icon" type="image/x-icon">

<script src="/Public/admin/js/jquery-2.2.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/layer/layer.js"></script>
<style type="text/css">
	#captcha_change {
		cursor: pointer;
	}
	.wrap_box_n {
		width: 100%;
		height: 100%;
		min-height: 700px;
		display: -webkit-box;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		flex-direction: column;
		-webkit-box-align: center;
		align-items: center;
		-webkit-box-pack: center;
		justify-content: center;
	}

</style>
<style scoped="">
	.panel-body{
		padding: 30px 20px 20px;
	}
	.form-group{
		margin-bottom: 20px;
	}
	.form-horizontal .form-group:last-child{
		margin-top: 35px;
	}
</style>
</head>
<body class="" style="background: url(./Public/admin/images/bg8.jpg) 0% 0% / 100% 100% no-repeat; height: auto;">
<div class="wrap_box_n">
    <div class="container container_n">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo ($_site['name']); ?></div>
                    <div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">用户名</label>
								<div class="col-md-7">
									<input type="text" class="form-control" placeholder="输入您的用户名" name="name" id="name" value="" required="" autofocus="" />
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">密码</label>
								<div class="col-md-7">
									<input id="pass" type="password" placeholder="输入您的密码" class="form-control" name="pass" required="" />
								</div>
							</div>
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label">验证码</label>
								<div class="col-md-4">
									<input id="code" class="form-control col-md-2" placeholder="输入右侧验证码" type="captcha" name="code" value="" required="" />
								</div>
								<span class="col-md-3 refereshrecapcha">
									<img src="<?php echo U('Pub/verify');?>" id="verify_img" style="width:90px;" title="点击更换验证码">
								</span>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-block btn-primary" onclick="Dlogin();">
										登录
									</button>
								</div>
							</div>
							<div>&#25042;&#20154;&#28304;&#30721;&#119;&#119;&#119;&#46;&#108;&#97;&#110;&#114;&#101;&#110;&#122;&#104;&#105;&#106;&#105;&#97;&#46;&#99;&#111;&#109;&#32;&#20840;&#31449;&#36164;&#28304;&#50;&#48;&#22359;&#20219;&#24847;&#19979;&#36733;</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$("#verify_img").click(function() {
		var verifyURL = "<?php echo U('Pub/verify');?>";
		var time = new Date().getTime();
		$("#verify_img").attr({
			"src" : verifyURL + "&" + time
		});
	});
	
	var random = Math.floor(Math.random()*8+1);
	var img = './Public/admin/images/bg' + random + '.jpg';
	$('body').css({
        'background': 'url('+img+') no-repeat',
        'background-size': '100% 100%',
        'height': 'auto'
    });
	
	
	//input回车事件,触发登录事件
	$('input').bind('keypress',function(event){ 
        if(event.keyCode == 13){  
           Dlogin();
        }  
    });
	
	function Dlogin(){
		var data = {};
			msg = "";
		$('input').each(function(){
			if($(this).val() == ""){
				msg = $(this).attr("placeholder");
				return false;
			}else{
				data[$(this).attr('id')] = $(this).val();
			}
		});
		if(msg !=""){
			layer.msg(msg);
			return false;
		}
		$.post("<?php echo U('login');?>",data,function(d){
			if(d){
				console.log(d);
				if(d.status){
					location.href = d.url;
				}else{
					layer.msg(d.info);
					$("#verify_img").click();
				}
			}else{
				layer.msg('请求失败！');
			}
		})
	}
</script>
</body>
</html>