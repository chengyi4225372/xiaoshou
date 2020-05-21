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


<link rel="stylesheet" type="text/css" href="/Public/layer/skin/default/layer.css">
<link href="/Public/home/css/template5_book_details.css" rel="stylesheet" type="text/css">

<div class="body_sytle">
	<div class="bd_head_box">
	 <?php if($user['viptime'] == 0): ?><div class="bd_head_open_vip" style="background-color:#fdf6e3;height:40px;"><a href="<?php echo U('Index/vip');?>" style="background-color:#fdf6e3;height:40px;line-height:40px;">开通 VIP，万本好书免费看</a></div><?php endif; ?>
		<div class="bd_head_info">
			<div class="bd_head_info_img"><img src="<?php echo ($info["infopic"]); ?>" /></div>
			<div class="bd_head_info_txt">
				<h1><?php echo ($info["title"]); ?></h1>
				<div class="i_images_txt_other">
					<strong>
					<?php  $cates = explode(",",$info['cateids']); if($info['btype'] == 1){ $cArr = $_mhStore; }else{ $cArr = $_xsStore; } ?>
					<?php if(($info['iswz']) == "1"): ?><i style="color: #7fdae9;">连载中</i>
												<?php else: ?>
												<i>已完结</i><?php endif; ?>
												<b><?php if(is_array($cates)): foreach($cates as $k=>$v): echo ($cArr[$v]); endforeach; endif; ?></b>
					</strong>
				</div>
				<div class="bd_head_info_other"><span>46.83万字</span></div>
				
				<div class="bd_head_info_other"><em style="fl">19.91万人在追</em></div>
			</div>
			
			
			<div class="bd_description_box bd_description_open">
				<p class="j_cutstrtxt"><?php echo ($info["remark"]); ?></p>
				<a href="javascript:;"></a>
			</div>
			<div class="bd_li_renewal_box">
				<strong>更新</strong>
				<a href="/index.php?m=&c=Index&a=readAnime&anid=<?php echo ($inchapter['anid']); ?>&chaps=<?php echo ($inchapter['chaps']); ?>">最新章节：<?php echo ($inchapter['title']); ?></a>
			</div>
			<div class="bd_directory_tit">目录<span>（共<?php echo ($info["allchapter"]); ?>章）</span></div>
		</div>

		<ul class="bd_list_ul">
			<?php if(is_array($info_chapter)): $i = 0; $__LIST__ = $info_chapter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li><a href="/index.php?m=&c=Index&a=readAnime&anid=<?php echo ($vv['anid']); ?>&chaps=<?php echo ($vv['chaps']); ?>"><?php echo ($vv["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<a href="<?php echo U('mInfo',array('anid'=>$info['id']));?>" class="bd_list_more"><span>全部目录</span></a>
	</div>
	<div class="main_recommend">
    <div class="main_recommend_tit">
        <a href="javascript:;" class="main_recommend_but j_recommend_refresh" id="guess_btn" onclick="loadRecommend()">换一换</a>
        <h2>主编推荐</h2>
    </div>
    <div class="i_images_list">
        <ul class="i_images_ul">

		 <?php if(is_array($guess)): foreach($guess as $key=>$vo): ?><li class="section-block">
                <a href="<?php echo U('info',array('id'=>$vo['id']));?>" class="section-data"  data-zone="主编推荐">
                    <div class="i_images_img"><img alt="" src="<?php echo ($vo["selectpic"]); ?>" data-original="<?php echo ($vo["selectpic"]); ?>" /></div>
                    <h3><?php echo ($vo["title"]); ?></h3>
                </a>
            </li><?php endforeach; endif; ?>         
         </ul>
    </div>
</div>
</div>
 </div>
<style>
.bd_but_box .buts_2{background-color:#fe7271;}
.bd_but_box .disabled{background-color:#fad2d3;}
</style>
<div class="bd_but_box">
<?php if($collect): ?><a href="javascript:;" class="disabled" style="width:50%;float:left;">已在书架</a>
	<?php else: ?>
	<a href="javascript:;" id="joinSc" class="buts_2" style="width:50%;float:left;">加入书架</a><?php endif; ?>
<?php
 $read = M('readhistory')->where(array('user_id'=>$user['id'],'anid'=>$info['id']))->order('chaps desc')->find(); ?>
<?php if($read): ?><a href="<?php echo U('readAnime',array('anid'=>$info['id'],'chaps'=>$read['chaps']));?>" class="buts_1" style="width:50%;float:left;">继续阅读</a>
	<?php else: ?>
	<a href="<?php echo U('readAnime',array('anid'=>$info['id'],'chaps'=>1));?>" class="buts_1" style="width:50%;float:left;">开始阅读</a><?php endif; ?>
	
</div>

<script type="text/javascript" src="/Public/home/js/zepto.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.cookie.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.picLazyLoad.min.js"></script>			
<script type="text/javascript" src="/Public/home/js/template5_common.js"></script>
<script type="text/javascript">
    $(function(){
        $('.bd_description_box a').click(function(){
            $(this).parent().removeClass('bd_description_open');
        });
    
    });
	$('#joinSc').click(function () {
		if($(".bd_but_box a").hasClass('disabled')) return;
		$("#joinSc").addClass('disabled');
		$(this).html('已在书架');
		$.post("<?php echo U('Ajax/collect');?>", { id: "<?php echo ($info["id"]); ?>" },function(d){
			
			if(d){
				bh_msg_tips(d.info);
			}
			
			
		});
	});
	 function loadRecommend() {
        location.reload();
        /*  $.post("/search/ewq", {recommend_ids : 0,category_id : '8,15', book_id : 230  },function (r) {
              $('#guess_list').html(r);
          },'html') */
    }
	 function bh_msg_tips(msg) {
        var oMask = document.createElement("div");
        oMask.id = "bh_msg_lay";
        oMask.style.position = "fixed";
        oMask.style.left = "0";
        oMask.style.top = "50%";
        oMask.style.zIndex = "100";
        oMask.style.textAlign = "center";
        oMask.style.width = "100%";
        oMask.innerHTML = "<span style='background: rgba(0, 0, 0, 0.65);color: #fff;padding: 10px 15px;border-radius: 3px; font-size: 14px;'>" + msg
            + "</span>";
        document.body.appendChild(oMask);
        setTimeout(function () {
            $("#bh_msg_lay").remove();
        }, 2000);
    }
</script>