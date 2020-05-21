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

<link rel="stylesheet" type="text/css" href="/Public/home/css/mui.min.css">
<style>
.r_img_edit_box{ display:table; margin: 0px auto;width:100%; vertical-align: middle;}
.top {
 font-size:15px;
 font-weight:400;
 display: table-cell;
 overflow:hidden;
 width:50%;
float:left;
 margin: 0px auto;
 table-layout:fixed;
 border:1px solid #FFB473;
 border-radius:3px;
 background-color:transparent;
 -webkit-touch-callout:none;

}
.top .toptab {
 line-height:.4rem;
 display:table-cell;
 overflow:hidden;
 width:1%;
 clear: both;
 -webkit-transition:background-color .1s linear;
 transition:background-color .1s linear;
 text-align:center;
 white-space:nowrap;
 text-overflow:ellipsis;
 color:#FFB473;
 border-color:#FFB473;
 border-left:1px solid #FFB473;
}
.top .toptab:first-child {
 border-left-width:0
}
.top .toptab.active {
 color:#fff;
 background-color:#FFB473;
}
.r_img_edit_but_box,.r_book_num{table-cell;width:25%}
</style>
<div class="body_sytle" style="min-height: 600px">
	<!--i_nav_box 顶部导航-->
	<div class="r_img_list_box" >
		<div class="r_img_edit_box">
			<div class="r_book_num">
				<strong totalnum="<?php echo ($totalnum); ?>"><?php if(($totalnum) != "0"): ?>共<?php echo ($totalnum); ?>本<?php endif; ?></strong>
				<em>选中0本</em>
			</div>
			<div class="top">
				<a class="toptab" href="<?php echo U('Index/collectHistory',array('btype'=>$btype));?>">我的书架</a>
				<a href="#" class="toptab active">阅读记录</a>
			</div>
			<div class="r_img_edit_but_box" style="display:none;">
				<a href="javascript:;" class="r_img_edit_open">管理</a>
				<a href="javascript:;" class="r_img_edit_close">取消</a>
				<a href="javascript:;" class="r_img_edit_remove">确定删除</a>
			</div>
		</div>

		<ul class="r_img_ul" id="recent_ul" >
						
					</ul>
		<!--r_img_ul 最近阅读列表 r_img_remove_select-->
		<div class="loading_box" style="display:none;"></div>
	</div>
		<!--r_img_list 编辑最近阅读列表 r_img_list_edit_remove r_img_list_edit -->

	<div class="content_null_box"  style="display:none;">
		<img src="/Public/home/img/icon/icon_5.png" style="width: 1.05rem;" />
		<span>你还没有<i>阅读</i>记录</span>
	</div>

	<div class="r_img_list_other"  style="display:none;">
				<ul class="r_img_ul">
					</ul>
	</div>
</div>
<script type="text/javascript" src="/Public/home/js/zepto.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.cookie.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.picLazyLoad.min.js"></script>			
<script type="text/javascript" src="/Public/home/js/template5_common.js"></script>
<script type="text/javascript" src="/Public/home/js/template5_recently.js"></script>
<script type="text/javascript" src="/Public/home/js/template3/mui.js"></script>
<script type="text/javascript" src="/Public/home/js/template3/mui.lazyload.js"></script>

<script type="text/javascript">
    var page = 1;
    var wait = true;
    $(function () {
		$('img').picLazyLoad({
		effect : "fadeIn"
		});
        getData();
        $(window).bind("scroll", function (event) {
            var top = document.documentElement.scrollTop + document.body.scrollTop;
            var textheight = $(document).height();
            if (textheight - top - $(window).height() <= 50) {
                page++;
                getData();
            }
        });
		
	});

	
    //获取数据
    function getData(){
        $.post("<?php echo U('Ajax/getReadHistory5');?>",{page:page,btype:"<?php echo ($btype); ?>"},function(d){
		   //  console.log(d);
            if(d){
                if(d.status){
                    $('#recent_ul').append(d.info);
					$('.r_img_edit_but_box').show();
					$('.loading_box').html('<span>已显示全部</span>').show();
					
					
                }else{
                    if(page == 1 && $('#nolist').length == 0){
                        $('.content_null_box').show();	
                    }
                    wait = false;
                }
            }else{
				$('.loading_box').html('<span>已显示全部</span>').show();
                 wait = false;
            }
        })
    }
</script>
</body>
</html>