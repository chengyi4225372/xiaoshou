<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<!--<meta content="telephone=no" name="format-detection">-->
	<!--<meta http-equiv="Cache-Control" content="no-transform ">-->
	<!--<meta http-equiv="Cache-Control" content="no-siteapp">-->
	<!--<meta name="apple-mobile-web-app-capable" content="yes">-->
	<!--<meta name="applicable-device" content="mobile">-->
	<title><?php echo ($title); ?></title>
	<!-- 这里引入css -->
<link href="/Public/home/css/template5_common.css" rel="stylesheet" type="text/css">
<link href="/Public/home/css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="/Public/home/css/template5_index.css" rel="stylesheet" type="text/css">

<style type="text/css">
.bd_head_open_vip{
	overflow: hidden;
	height: .21rem;
	margin: .12rem .15rem;
	text-align: center;
	font-size: 0;
}

.bd_head_open_vip a{
	padding-right: .2rem;
	display: inline-block;
	*display: inline;
	*zoom:1;
	height: .21rem;
	background: url(/Public/home/img/icon/icon_36.png) no-repeat right center;
	background-size: .14rem auto;
	font-family:'PingFang-SC-Regular';
	font-size: .15rem;
	color: #d48741;
	line-height: .21rem;
}
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
<body><!--header begin-->
<div class="body_sytle">
<div class="i_nav_fixed_box">
	<div class="i_nav_box">
		<div class="i_nav_list">
		
			<a href="<?php echo U('Index/index',array('order'=>'sex1','btype'=>2));?>" class='nav_but <?php if(($_GET["order"]) == "sex1"): ?>hover<?php endif; if(empty($_GET["order"])): ?>hover<?php endif; ?>'><strong>男生</strong><span></span></a>
			<a href="<?php echo U('Index/index',array('order'=>'sex2','btype'=>2));?>" class='nav_but <?php if(($_GET["order"]) == "sex2"): ?>hover<?php endif; ?>'><strong>女生</strong><span></span></a>
		</div>
		<div class="i_search_box"><a href="javascript:;" onclick="location.href=&#39;<?php echo U('iSearch',array('btype'=>2));?>&#39;" class="client-url">搜索你想看的书</a></div>
	</div>	
</div>

<div class="i_slide_box">
	<!-- Swiper -->
	<div class="swiper-container swiper-container-horizontal swiper-container-wp8-horizontal">
		<div class="swiper-wrapper">
			<?php if(is_array($_xsBanner)): foreach($_xsBanner as $key=>$v): ?><div class="swiper-slide" data-swiper-slide-index=""><a href="<?php echo ($v["url"]); ?>" class="client-url section-data" data-zone="轮播" data-book_id=""><img alt="" src="/Public/home/img/icon/banner_bg.png" data-original="<?php echo ($v["pic"]); ?>"></a></div><?php endforeach; endif; ?>		
							
			</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
	</div>
</div>

<div class="i_classify">
	<ul>
		<li><a href="<?php echo U('Index/bookType',array('btype'=>2));?>"><i class="icon-fl"></i>分类</a></li>
		<li><a href="<?php echo U('Index/moreList',array('field'=>'isfw','value'=>2,'btype'=>2));?>"><i class="icon-free"></i>免费</a></li>
		<li><a href="<?php echo U('Index/collectHistory',array('btype'=>2));?>"><i class="icon-ranking"></i>最近阅读</a></li>
		<li><a href="<?php echo U('Index/charge',array('btype'=>2));?>"><i class="icon-vip"></i>充值</a></li>
        <li><a href="<?php echo U('Index/my',array('btype'=>2));?>"><i class="icon-hd"></i>个人中心</a></li>
	</ul>
</div>

<!--主编推荐 begin-->

<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="i_module_box">
	<div class="i_module_tit">
		<h2>
			<a class="i_module_list_more client-url" href="<?php echo U('Index/moreList',array('field'=>'areas','value'=>$v['sid'],'btype'=>2));?>">更多</a>
			<strong><?php echo ($v["name"]); ?></strong>
		</h2>
	</div>
	<?php if($k <= 2): ?><div class="i_images_list">
		<ul class="i_images_ul">
		<?php if(is_array($v['list'])): $i = 0; $__LIST__ = $v['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li class="section-block">
				<a href="<?php echo U('Index/info',array('id'=>$vv['id']));?>" class="client-url section-data">
				<div class="i_images_img"><img alt="<?php echo ($vv["title"]); ?>" src="/Public/home/img/icon/default_img.png" data-original="<?php echo ($vv["coverpic"]); ?>"></div>
				<h3><?php echo ($vv["title"]); ?></h3>
				</a>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>		
		</ul>
	</div>
	<?php else: ?>
	<div class="i_images_text_list">
		<ul class="i_images_text_ul">
			<?php if(is_array($v['list'])): $i = 0; $__LIST__ = $v['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; $cates = explode(",",$vv['cateids']); if($vv['btype'] == 1){ $cArr = $_mhStore; }else{ $cArr = $_xsStore; } ?>
			<li class="section-block">
				<a href="<?php echo U('Index/info',array('id'=>$vv['id']));?>" class="client-url section-data">
					<div class="i_images_img"><img alt="<?php echo ($vv["title"]); ?>" src="/Public/home/img/icon/default_img.png" data-original="<?php echo ($vv["coverpic"]); ?>"></div>
					<div class="i_images_txt_box">
						<h3><?php echo ($vv["title"]); ?></h3>
						<p><?php echo ($vv["remark"]); ?></p>
						<div class="i_images_txt_other">
							<strong><i><?php echo ($vv['status']==1?连载中:已完结); ?></i><?php if(is_array($cates)): foreach($cates as $kk=>$vvv): ?><b><?php if($kk <= 1): echo ($cArr[$vvv]); endif; ?></b><?php endforeach; endif; ?></strong><em>39.69万人在追</em>
						</div>
					</div>
				</a>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>					
		</ul>
	</div><?php endif; ?>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="i_erweima">
	<?php if($mch): ?><img src="<?php echo ($mch['qrcode']); ?>">
		<p>客服公众号：<?php echo ($mch['weixin']); ?><br>客服电话：<?php echo ($mch['qq']); ?><br>工作时间：09:00-21:00</p>
	<?php else: ?>
		<img src="<?php echo ($_site['qrcode']); ?>">
			<p>客服公众号：<?php echo ($_site['weixin']); ?><br>客服电话：<?php echo ($_site['qq']); ?><br>工作时间：09:00-21:00</p><?php endif; ?>
</div>
<script>
    // $(function () {
    //     var fontSize = $(window).width() / 25;
    //     $("html").css("font-size", fontSize);
    //     uid = "0";
    // })

    var ajaxurl = "<?php echo U('iSearch');?>";
	

</script>


<script>


    function get_other_books2(){
        var url = "<?php echo U('get_other_books');?>";
        var data = {type:"1"}
        $.post(url,data,function(data){
            if(data.status == 1){
                $('#other_book').html('');
                $('#other_book').append(data.info);
            }else{
                bh_msg_tips(data.info);
            }
        })
    }

</script>
<script type="text/javascript" src="/Public/home/js/zepto.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.cookie.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.picLazyLoad.min.js"></script>
<script type="text/javascript" src="/Public/home/js/swiper.min.js"></script>
<script type="text/javascript" src="/Public/home/js/slick.js"></script>
<script type="text/javascript" src="/Public/home/js/template5_index.js"></script>

</body>
</html>