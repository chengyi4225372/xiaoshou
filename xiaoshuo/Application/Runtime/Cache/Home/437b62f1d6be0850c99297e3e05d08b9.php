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
		
		<div class="c_list_tab_box_2">
			<a href="javascript:;" class="hover" type="all">全部</a>
			<a href="javascript:;" type="serial">连载</a>
			<a href="javascript:;" type="finish">完本</a>
			<a href="javascript:;" type="free">免费</a>
		</div>
		
		<ul class="r_img_ul"></ul>
	</div>
	<div class="loading_box"></div> 
	
	<div class="content_null_box" style="display: none;">
		<img src="/Public/home/img/icon/search_icon_3.png" style="width: 1.28rem;" />
		<span>暂无该类别图书，换个条件试试看吧！</span>
		<div class="content_null_but_box">
			<a href="/">去首页看看</a>
		</div>
	</div>

</div>
<script type="text/javascript" src="/Public/home/js/zepto.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.cookie.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.picLazyLoad.min.js"></script>		
<script type="text/javascript" src="/Public/home/js/template5_common.js"></script>

<script>
    var issex = "sex1";
	type="all"
    page = 1;
    wait = true;
    $(function () {
		$('img').picLazyLoad({
			effect : "fadeIn"
		});
        getData();
		$(".c_list_tab_box_2 > a").click(function(){
			$(this).addClass("hover");
			$(this).siblings().removeClass("hover");
			$('.r_img_ul').html('').show();
			$('.content_null_box').hide();
			$('.loading_box').html('<span>正在加载中，请稍后......</span>').show();
			type = $(this).attr("type");
			wait = true;
			page = 1;
			getData();
		});
		
        $(window).bind("scroll", function (event) {
            if(!wait) return;
            var top = document.documentElement.scrollTop + document.body.scrollTop;
            var textheight = $(document).height();
            if (textheight - top - $(window).height() <= 50) {
                page++;
                getData();
            }
        });
    });

	

  

    function getData(){
        data = {
            "cateids" : "<?php echo ($_GET['cateids']); ?>",
            "type" : type,
            "issex" : "<?php echo ($_GET['order']); ?>",
            "btype":"<?php echo ($_GET['btype']); ?>",
            "page":page,
        }
        $.post("<?php echo U('Ajax/getBookType5');?>",data,function(d){
            if(d){
                if(d.status){
                    $('.r_img_ul').append(d.info);
					$('.loading_box').html('<span>已显示全部</span>').show();
                }else{
					
					if(page == 1 ){
                        $('.loading_box').hide();
						$('.content_null_box').show();
						
						wait = false;
                    }else{
					 $('.loading_box').html('<span>已显示全部</span>').show();
					wait = false;
					
                   }
                }
            }else{
				$('.loading_box').hide();
				$('.content_null_box').show();
				
				wait = false;
            }
        })
    }
	
</script>

</body>
</html>