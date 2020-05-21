<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($title); ?></title>
    <!-- 这里引入css -->
	<link href="/Public/home/css/template5_common.css" rel="stylesheet" type="text/css">
	<link href="/Public/home/css/template5_recently.css" rel="stylesheet" type="text/css">
	<link href="/Public/home/css/template5_classify.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		html,body {background:#fff;}
	</style>
	<script type="text/javascript">
               
        (function (doc) {
            var docEl = doc.documentElement,
                recalc = function () {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    if (clientWidth > 414) {
                        //docEl.style.fontSize = '115px';
						docEl.style.fontSize = '110.4px';
                    } else {
                        //docEl.style.fontSize = 100 * (clientWidth / 360) + 'px';
                        docEl.style.fontSize = 100 * (clientWidth / 375) + 'px';
                    }
                };
            recalc();
        })(document);
      
    </script>
</head>
<body>
<div class="head_tit_box">
    <a href="javascript:;" class="head_return_page_but"></a>
	<div class="head_menu_but_box">
		<a href="javascript:;" class="head_menu_but"></a>
	</div>
    <h1><?php echo ($mtitle); ?></h1>
</div>
<!--head_tit_box 分类 head_menu_but_open-->
<div class="pop_up_menu_box">
	<i></i>
	<div class="pum_box">
		<div class="pum_tit_box">
			<a href="javascript:;"></a>
		</div>
		<div class="pum_nav_list">
			<ul class="pum_nav_list_ul">
				<li>
					<a href="<?php echo U('Index/index',array('order'=>'sex2','btype'=>2));?>">
						<div class="pum_icon"><img alt="" src="/Public/home/img/icon/module_icon_2.png" /></div>
						<strong>女生</strong>
					</a>
				</li>
								<li>
					<a href="<?php echo U('Index/index',array('order'=>'sex1','btype'=>2));?>">
						<div class="pum_icon"><img alt="" src="/Public/home/img/icon/module_icon_1.png" /></div>
						<strong>男生</strong>
					</a>
				</li>
								<li>
					<a href="<?php echo U('Index/moreList',array('field'=>'isfw','value'=>2,'btype'=>2));?>">
						<div class="pum_icon"><img alt="" src="/Public/home/img/icon/module_icon_5.png" /></div>
						<strong>免费</strong>
					</a>
				</li>
				<li>
					<a href="<?php echo U('Index/bookType',array('btype'=>2));?>">
						<div class="pum_icon"><img alt="" src="/Public/home/img/icon/module_icon_3.png" /></div>
						<strong>分类</strong>
					</a>
				</li>
				<li>
					<a href="<?php echo U('Index/rank',array('btype'=>2));?>">
						<div class="pum_icon"><img alt="" src="/Public/home/img/icon/module_icon_7.png" /></div>
						<strong>排行</strong>
					</a>
				</li>
				<li>
					<a href="<?php echo U('Index/my',array('btype'=>2));?>">
						<div class="pum_icon"><img alt="" src="/Public/home/img/icon/module_icon_6.png" /></div>
						<strong>个人中心</strong>
					</a>
				</li>
			</ul>
			<div class="pum_but_box">
				<a href="<?php echo U('Index/readHistory',array('btype'=>2));?>">最近阅读</a>
			</div>
		</div>
	</div>
</div>
<!--pop_up_menu_box 菜单弹框-->


<!-- 这是正文 -->

<div class="body_sytle">
	
	<div class="c_list_box">
		
		<div class="c_list_tab_box">
			<a href="javascript:;"  class="hover"  sex="1">男生</a>
			<a href="javascript:;"  sex="2">女生</a>
		</div>
		
		<ul class="c_list_ul">
		 <?php if(is_array($store)): $i = 0; $__LIST__ = array_slice($store,6,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="sex_1"><a href="<?php echo U('Index/BookTypeinfo',array('order'=>'sex1','btype'=>2,'cateids'=>$key));?>"><span><?php echo ($v); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			
		<?php if(is_array($store)): $i = 0; $__LIST__ = array_slice($store,0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li class="sex_2"><a href="<?php echo U('Index/BookTypeinfo',array('order'=>'sex1','btype'=>2,'cateids'=>$key));?>"><span><?php echo ($vv); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			
			
		</ul>
	</div>
	
</div>
<script type="text/javascript" src="/Public/home/js/zepto.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.cookie.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.picLazyLoad.min.js"></script>			
<script type="text/javascript" src="/Public/home/js/template5_common.js"></script>
<!-- 这里引入js -->
<script type="text/javascript">
	$(function(){
		var sex  = 1;
		loadCategories(sex);
		$(".c_list_tab_box > a").click(function(){
			$(this).addClass("hover");
			$(this).siblings().removeClass("hover");
			var sex = $(this).attr("sex");
			loadCategories(sex);
		});
	})

	function loadCategories(sex){
		var opposite = (sex==1) ? 2 : 1;
		$(".sex_"+opposite).hide();
		
		$(".sex_"+sex).show();
	}


</script>

</body>
</html>