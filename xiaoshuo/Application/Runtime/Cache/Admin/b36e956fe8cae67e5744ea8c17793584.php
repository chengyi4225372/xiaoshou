<?php if (!defined('THINK_PATH')) exit();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ($info["title"]); ?> - 文案制作</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Public/admin/css/toastr.min.css">
<link rel="stylesheet" href="/Public/admin/css/bootstrap.min.css">
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/admin/css/page_mp_article.css">
<link rel="stylesheet" href="/Public/admin/css/page_mp_article_improve_combo.css">
<link rel="stylesheet" href="/Public/admin/css/admin.css">

<script src="/Public/admin/js/jquery-2.2.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/admin/js/clipboard.min.js"></script>
<script src="/Public/admin/js/toastr.min.js"></script>
<style id="style-1-cropbar-clipper">
	 #editor-bar .dropdown-menu {
            height: auto;
            max-height: 400px;
            overflow-x: hidden;
        }
	.en-markup-crop-options {
		top: 18px !important;
		left: 50% !important;
		margin-left: -100px !important;
		width: 200px !important;
		border: 2px rgba(255, 255, 255, .38) solid !important;
		border-radius: 4px !important;
	}
	.en-markup-crop-options div div:first-of-type {
		margin-left: 0px !important;
	}
	p {
		margin: 0;
	}
	.set_time {
		color: #417505;
	}
	.set_time p {
		lien-height: 20px;
	}
	.push_item {
		display: relative;
	}
	.push_item::after {
		display: block;
		content: ' ';
		position: absolute;
		bottom: 0;
		width: 276px;
		height: 1px;
		background-color: #eee;
	}
	.push_item:last-child::after{
		display: none;
	}
	.box-body {
		width: 310px;
		padding: 0 !important;
		margin-right: 20px;
		border: 1px solid #ccc;
		border-radius: 3px;
	}
	.push_list {
		/*padding: 10px;*/
	}
	.data-img {
		width: 60px !important;
		height: 60px !important;
	}
	.push_item {
		position: relative;
		padding: 12px 16px;
	}
	.mask {
		position: absolute;
		display: none;
		width: 276px;
		height: 60px;
		background: rgba(25, 25, 25, 0.5);
		top: 12px;
		left: 16px;
		/*display: flex;*/
		justify-content: space-around;
		align-items: center;
		/*visibility: hidden;*/
	}
	.push_item:first-child {
		display: block;
		width: 308px;
		height: 187px;
		padding: 16px;
	}
	.push_item:first-child .mask {
		height: 155px;
		top: 16px;
	}
	.data-title {
		text-decoration: none;
	}
	.data-title:hover {
		cursor: pointer;
		text-decoration: none;
	}
	.push_item:first-child .data-title {
		position: absolute;
		bottom: 16px;
		background: rgba(51, 51, 51, 0.8);
		width: 276px;
		padding-left: 16px;
		line-height: 35px;
		font-size: 14px;
		margin: 0;
		color: #fff;
		text-overflow:ellipsis;
		white-space:nowrap;
		overflow:hidden;
	}
	.push_item:first-child .data-img {
		width: 100% !important;
		height: 100% !important;
	}
	.push_item:not(:first-child){
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	.push_item:not(:first-child) .data-title {
		width: 196px;
		line-height: 24px;
		font-size: 14px;
		color: #333;
		word-wrap:break-word;
	}
	.box_bottom {
		display: flex;
		justify-content: space-between;
		padding: 16px;
		padding-bottom: 20px;
	}
	.box_bottom>div .btn {
		width: 32px;
		height: 32px;
		margin-left: 6px;
		padding: 0;
		line-height: 32px;
		text-align: center;
	}
	.push_box {
		/*display: none;*/
	}
	.m_btn {
		background: transparent;
		border: 0;
		outline: 0;
	}
	.m_btn::before {
		color: #fff;
	}
	
	.loading {
		width: 10%;
		height: 56px;
		position: absolute;
		top: 50%;
		left: 45%;
		line-height: 56px;
		color: #fff;
		padding-left: 60px;
		font-size: 15px;
		background: #000 url(./Public/images/loading.gif) no-repeat 20px 50%;
		background-size: 20%;
		z-index: 9999;
		-moz-border-radius: 20px;
		-webkit-border-radius: 20px;
		border-radius: 20px;
		filter: progid:DXImageTransform.Microsoft.Alpha(opacity=70);
	}
</style>
</head>
<body>
<div class="row" style="margin:0">
	<div class="col-md-4 col-md-offset-4">
		<div class="rich_media_inner" style="padding-top:0">
			<div class="rich_media_area_primary">
				<h1 id="wx-article-title" class="rich_media_title"><?php echo ($covertitle); ?></h1>
				<div class="rich_media_content" id="wx-copy-content">
					<div class="article-cover">
						<img style="width:100%;display:block;margin-bottom:20px;" src="<?php echo ($coverpic); ?>" id="wx-article-cover">
					</div>
					<div>
						<div id="wx-article-content">
							<section>
								<section style="max-width: 100%;margin: 0.8em 0px 0.5em; overflow: hidden; ">
									<section style="box-sizing: border-box !important; height:36px;display: inline-block;color: #FFF; font-size: 16px;font-weight:bold; padding:0 10px;line-height: 36px;float: left; vertical-align: top; background-color: rgb(249, 110, 87); "></section>
									<section style="box-sizing: border-box !important; height:36px;display: inline-block;color: #FFF; font-size: 16px;font-weight:bold; padding:0 10px;line-height: 36px;float: left; vertical-align: top; background-color: rgb(249, 110, 87); "></section>
									<section style="box-sizing: border-box !important; height:36px;display: inline-block;color: #FFF; font-size: 16px;font-weight:bold; padding:0 10px;line-height: 36px;float: left; vertical-align: top; background-color: rgb(249, 110, 87);overflow: hidden;text-overflow: ellipsis;white-space: nowrap;max-width: 79%!important; ">
										<span style="color: rgb(254, 255, 253); font-size: 15.6px; text-align: center;" class="ztitle" _chaps="<?php echo ($oneInfo['chaps']); ?>" _title="<?php echo ($oneInfo['title']); ?>"><?php echo ($oneInfo["title"]); ?></span>
									</section>
									<section style="box-sizing: border-box !important; height:36px;display: inline-block;color: #FFF; font-size: 16px;font-weight:bold; padding:0 10px;line-height: 36px;float: left; vertical-align: top; background-color: rgb(249, 110, 87); "></section>
									<section style="box-sizing: border-box !important; display: inline-block;height:36px; vertical-align: top; border-left-width: 9px; border-left-style: solid; border-left-color: rgb(249, 110, 87); border-top-width: 18px !important; border-top-style: solid !important; border-top-color: transparent !important; border-bottom-width: 18px !important; border-bottom-style: solid !important; border-bottom-color: transparent !important;"></section>
								</section>
								<fieldset style="border: 0px; margin: 5px 0px; box-sizing: border-box; padding: 0px;">
									<section style="height: 1em; box-sizing: border-box;">
										<section style="height: 100%; width: 1.5em; float: left; border-top-width: 0.4em; border-top-style: solid; border-color: rgb(249, 110, 87); border-left-width: 0.4em; border-left-style: solid; box-sizing: border-box;"></section>
										<section style="height: 100%; width: 1.5em; float: right; border-top-width: 0.4em; border-top-style: solid; border-color: rgb(249, 110, 87); border-right-width: 0.4em; border-right-style: solid; box-sizing: border-box;"></section>
										<section style="display: inline-block; color: transparent; clear: both; box-sizing: border-box;"></section>
									</section>
									<section style="margin: -0.8em 0.1em -0.8em 0.2em; padding: 0.8em; border: 1px solid rgb(249, 110, 87); border-radius: 0.3em; box-sizing: border-box;">
										<section style="color: rgb(51, 51, 51);line-height: 1.7em; word-break: break-all; word-wrap: break-word;" class="wweibrush">
											<span style="color: rgb(110, 101, 95); font-size: 16px; text-align: justify; text-indent: 32px; background-color: rgb(255, 255, 255);">
												<?php echo ($oneInfo["info"]); ?>
											</span>
										</section>
									</section>
									<section style="height: 1em; box-sizing: border-box;">
										<section style="height: 100%; width: 1.5em; float: left; border-bottom-width: 0.4em; border-bottom-style: solid; border-color: rgb(249, 110, 87); border-left-width: 0.4em; border-left-style: solid; box-sizing: border-box;"></section>
										<section style="height: 100%; width: 1.5em; float: right; border-bottom-width: 0.4em; border-bottom-style: solid; border-color: rgb(249, 110, 87); border-right-width: 0.4em; border-right-style: solid; box-sizing: border-box;"></section>
									</section>
								</fieldset>
							</section>
						</div>
						<div>
							<h1 style="white-space: normal; color: rgb(70, 70, 72); line-height: 22.72px; font-family: Arial;">
							<p style="margin-top: 0px; margin-bottom: 0px;">
								<strong><span style="color: rgb(255, 76, 65);">未完待续……</span></strong>
							</p>
							<p style="margin-top: 0px; margin-bottom: 0px;">
								<strong><span style="color: rgb(255, 76, 65);">微信篇幅有限，后续内容和情节更加精彩！</span></strong>
							</p>
							<p style="margin-top: 0px; margin-bottom: 0px;">
								<strong><span style="color: rgb(255, 76, 65);">点击下方【阅读原文】继续阅读哦~~~</span></strong>
							</p>
							<p style="margin-top: 0px; margin-bottom: 0px;">
								<strong>
									<img src="<?php echo ($yuepics[0]); ?>" width="auto" id="wx-article-footer">
								</strong>
							</p>
							</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<nav id="editor-bar" class="navbar navbar-default navbar-fixed-bottom">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#editor-menu" aria-expanded="false">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="editor-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-header"></i> 
						文案标题 
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php if(is_array($titles)): foreach($titles as $key=>$v): ?><li>
							<a href="javascript:;" class="titles"><?php echo ($v["title"]); ?></a>
						</li><?php endforeach; endif; ?>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-image"></i> 
						文案封面 
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php if(is_array($pics)): foreach($pics as $key=>$v): ?><li>
							<a href="javascript:;" class="imgs">
								<img style="max-width:200px;max-height:40px;" src="<?php echo ($v["pic"]); ?>">
							</a>
						</li><?php endforeach; endif; ?>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">原文引导模板 <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php if(is_array($yuepics)): foreach($yuepics as $key=>$v): ?><li style="border-bottom:#eee 1px solid;">
							<a href="javascript:;" class="foot_imgs">
								<img style="max-height: 40px;" data-bind="<?php echo ($v); ?>" src="<?php echo ($v); ?>">
							</a>
						</li><?php endforeach; endif; ?>
					</ul>
				</li>
				<li class="dropdown chapter" style="">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-header"></i> 
						书籍章节 
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<?php if(is_array($atitles)): foreach($atitles as $key=>$v): ?><li>
								<a href="javascript:;" data-chaps="<?php echo ($v["chaps"]); ?>" class="chapte"><?php echo ($v["title"]); ?></a>
							</li><?php endforeach; endif; ?>
					</ul>
				</li>
				<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-copy"></i> 复制 <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>
					<a href="javascript:void(0);" id="btn-copy-title" data-clipboard-target="#wx-article-title">复制标题</a>
					</li>
					<li>
					<a href="javascript:void(0);" id="btn-copy-content" data-clipboard-target="#wx-copy-content">复制正文</a>
					</li>
				</ul>
				</li>
			</ul>
			<div class="navbar-form navbar-right">
				<span class="btn_change is_details">
					<button type="button" class="btn btn-primary create_link" data-id="<?php echo ($info["id"]); ?>" data-title="<?php echo ($info["title"]); ?>">
						<i class="fa fa-link"></i> 生成原文链接
					</button>
				</span>
			</div>
		</div>
	</div>
</nav>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
				<h5 class="modal-title" id="exampleModalLabel">生成推广链接</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-2">小说名称:</label>
						<input type="hidden">
						<div class="col-sm-10">
							<input class="form-control" id="book_name" value="" disabled="true">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="control-label col-sm-2">小说章节:</label>
						<div class="col-sm-10">
							<input class="form-control" name="chaps" id="chapte_name" value="" disabled="true">
						</div>
					</div>
					<div class="form-group">
						<label for="channel_name" class="control-label col-sm-2">* 推广名称:</label>
						<div class="col-sm-10">
							<input type="text" name="name" id="channel_name" placeholder="请输入推广名称" class="form-control">
							<p class="text-danger"></p>
						</div>
					</div>
					<div class="channel_type_diff">
						<div class="form-group">
							<label class="control-label col-sm-2">强制关注章节:</label>
							<div class="col-sm-10">
								<input type="number" name="attention" id="subchaps" placeholder="强制关注章节数不能大于最大免费章节数" class="form-control col-sm-9" value="">
								<p class="text-danger">
									* 留空或者填0则默认不强制关注，推荐强关章节第7章，建议强制关注章节为第5章~第8章
								</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">备注:</label>
						<div class="col-sm-10">
							<input name="msg" type="text" class="form-control" id="msg" maxlength="100">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="sub" class="btn btn-primary">生成推广链接</button>
			</div>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" data-keyboard="false" data-backdrop="static" data-role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="loading" class="loading">加载中。。。</div>
</div>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<script>
	
    $('.imgs').click(function () {
        $('#wx-article-cover').attr('src', $(this).children('img').attr('src'));
        var speed = 200;//滑动的速度
        $('body,html').animate({scrollTop: 0}, speed);
        return false;
    });
    $('.foot_imgs').click(function () {
        $('#wx-article-footer').attr('src', $(this).children('img').attr('src'));
        var bodyHeight = $(document).height();
        $("body,html").animate({"scrollTop": bodyHeight + "px"}, 500);
    });
    $('.titles').click(function () {
        $('#wx-article-title').text($(this).text());
        var speed = 200;//滑动的速度
        $('body,html').animate({scrollTop: 0}, speed);
        return false;
    });

    new Clipboard('#btn-copy-title').on('success', function (e) {
        e.clearSelection();
		toastr.success('标题复制成功');
    });
    new Clipboard('#btn-copy-content').on('success', function (e) {
        e.clearSelection();
		toastr.success('正文复制成功');
    });
    
	
    //正文模板
    $('.model_a').click(function () {
        $('body,html').animate({scrollTop: 500}, 200);
        model_num = $(this).parent().index();
        append_content(model_num, data)
    });
	
	$('.chapte').click(function () {
        var chaps = $(this).data('chaps');
		$.ajax({
			type: "post",
			url: "<?php echo U('getChaps');?>",
			data: {chaps: chaps, anid:"<?php echo ($info["id"]); ?>"},
			success: function (data) {
				if (data.status == 1) {
					$('#wx-article-content').empty();
					$('#wx-article-content').append(data.info);
				}else{
					toastr["error"]("请求失败！");
				}
			}
		});
    });
	
	var lastChapter = {};
	 $('.create_link').click(function () {
		var len = $(".ztitle").length;
		lastChapter = {
			"chaps":$('.ztitle').eq(len-1).attr("_chaps"),
			"title":$('.ztitle').eq(len-1).attr("_title"),
		}
        $('#book_name').val("<?php echo ($info["title"]); ?>");
		$('#chapte_name').val(lastChapter.title);
        $('#exampleModal').modal('show');
    });
	
	$('#sub').click(function(){
		var channel_name = $('#channel_name').val();
			subchaps = $('#subchaps').val();
			msg = $('#msg').val();
			anid = "<?php echo ($info['id']); ?>";
        if (channel_name == '') {
            toastr["error"]('请输入推广名称');
            return false;
        }

		$('#myModal').modal('show');
		$.post("<?php echo U('createGuide');?>",{"anid":anid,"chaps":lastChapter.chaps,"name":channel_name,"subchaps":subchaps,"msg":msg},function(d){
			if(d){
				$('#myModal').modal('hide');
				if(d.status){
					$('#exampleModal').modal('hide');
					toastr["success"](d.info);
					setTimeout(function(){
						location.href = d.url;
					},1500);
				}else{
					toastr["error"](d.info);
				}
			}else{
				$('#myModal').modal('hide');
				toastr["error"]("请求失败！");
			}
		});	
	})
	
</script>
<script>
    var clipboard = new Clipboard('.copy');
    clipboard.on('success', function (e) {
        toastr["success"]("复制成功!");
        e.clearSelection();
    });
    clipboard.on('error', function (e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
</script>

<style type="text/css">
    svg {
        margin-left: 390px;
        height: 190px;
        width: 165px
    }
</style>
</body>
</html>