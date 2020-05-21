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


<link href="/Public/home/css/template5_pay.css" rel="stylesheet" type="text/css">
<div class="body_sytle">
    <div class="re_head_box">
        <div class="re_user_info_box">
            <div class="re_user_info">
                <em>ID：<span>hx<?php echo ($user["id"]); ?></span></em><span class="line-css">|</span>
                <strong>您的当前余额：<span><?php echo ($user["money"]); ?>书币</span></strong>
            </div>
        </div>
    </div>
    <div class="re_main_box">
                <div class="re_list_box">
            <div class="re_list_tit">
                <h2>请选择充值金额<span>（1元=100书币）</span></h2>
            </div>
            <ul class="re_list_ul">
			<?php if(is_array($_charge)): foreach($_charge as $k=>$v): if($v['isopen']): if($v['isover'] == 1): ?><li class="">
                <a href="javascript:;" data-goods-money="<?php echo ($v["money"]); ?>元" data-id="<?php echo ($k); ?>">
                    <strong>终生VIP会员</strong>
                    <em>￥<?php echo ($v["money"]); ?>元</em>
                 
					<b>终生免费看！</b>
                </a>
                </li>
			<?php elseif($v['isyear'] == 1): ?>
				
				<li class="" style="width:100%;text-align: center;">
                <a href="javascript:;" data-goods-money="<?php echo ($v["money"]); ?>元" data-id="<?php echo ($k); ?>">
                    <img src="/Public/home/img/year.png" style="width: 150px;margin: 0 auto;">
					<i>VIP充值</i>  
					<b>一年内全站书籍免费看</b>
                </a>
                </li>
			<?php elseif($v['ishalf'] == 1): ?>
				
			
				<li class="">
                <a href="javascript:;" data-goods-money="<?php echo ($v["money"]); ?>元" data-id="<?php echo ($k); ?>">
                    <strong>半年VIP会员</strong>
                    <em>￥<?php echo ($v["money"]); ?>元</em>
                 
					<b>半年时间免费看！</b>
                </a>
                </li>
             <?php else: ?>
				<li class="<?php if($v['ischoose']): ?>hover<?php endif; ?>" >
                <a href="javascript:;" data-goods-money="<?php echo ($v["money"]); ?>元" data-id="<?php echo ($k); ?>">
                    <strong><?php echo ($v["money"]); ?>元</strong>
                    <em><?php echo ($v['money']*$v['lv']); ?>
								<?php if($v['smoney'] > 0): ?>+<?php echo ($v['smoney']*$v['lv']); endif; ?>书币</em>
                    <?php if($v['ischoose']): ?><i>新人专享</i><?php endif; ?>
					<b>多送<?php if($v['smoney'] > 0): echo ($v['smoney']); endif; ?>元</b>
                </a>
                </li><?php endif; endif; endforeach; endif; ?>
                            </ul>
            <div class="re_but_box">
                <a href="javascript:;" id="pay_btn"  data-money="50" data-cid="2" >立即充值：50元</a>
            </div>
        </div>
    </div>
    <div class="js_loading"><strong></strong></div>
    <div class="re_rule_box">
        <p>温馨提示：</p>
        <p>1. 充值获得的书币仅限在本公司书城使用。</p>
        <p>2. 若是发现充值未到账，请先确认你登录的账号与充值的账号是否一致。</p>
        <p>3. 充阅读币属于虚拟商品，一经购买不得退换。</p>
    </div>
</div>
<script type="text/javascript" src="/Public/home/js/zepto.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.cookie.min.js"></script>
<script type="text/javascript" src="/Public/home/js/zepto.picLazyLoad.min.js"></script>			
<script type="text/javascript" src="/Public/home/js/template5_common.js"></script>
<script>
 $('.re_list_ul a').click(function () {
        var $this = $(this),
		cid = $this.data('id'),
        goodsMoney = $this.data('goods-money');
        $this.parent().addClass('hover').siblings('li').removeClass('hover');
        var but = $('#pay_btn');
		but.data('cid', cid);
        but.data('money', goodsMoney);
        but.text('立即充值：' + goodsMoney);
    });
	
$('.re_but_box a').click(function () {

		
        var $this = $(this),
        cid = $this.data('cid'),
        smoney = $this.data('money');
		if(cid == 0 || !cid){
			return false;
		}
        $('.js_loading').show();
		$.post("<?php echo U('Ajax/charge');?>",{cid:cid,anid:"<?php echo ($_GET['anid']); ?>"},function(d){
			if(d){
				if(d.status){
					location.href = d.url;
				}else{
					 $('.js_loading').hide();
				}
			}else{
				 $('.js_loading').hide();
			}
		});
})
</script>
</body>
</html>