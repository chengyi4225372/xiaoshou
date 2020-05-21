<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/default.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/bookshelf.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/common.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/sign.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/footer4.css">
	<script type="text/javascript" src="/Public/home/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/highlight.pack.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.lazyload.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.lazyload.img.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/jquery.bigautocomplete.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.zoom.js"></script>
</head>

<link href="/Public/home/css/template3/person.css" rel="stylesheet">

<style>
.l-center-pay{
 font-size: .47rem;
}
.action{margin-top:10px;margin-bottom:10px;}
.person-infoRight {
    height: 95px; 
   
}
</style>
<div class="mui-content person-content">
	<div class="person-top" ></div>
	<div class="person-info">
		<div class="person-Photo">
            <img src="<?php echo ($user["headimg"]); ?>" id="headimg" onclick="headimg();"/>
		</div>
		<div class="person-infoRight">
			<div class="person-userName">
                <span id="nickname"><?php echo ($user["nickname"]); ?></span>  
			</div>
			<?php if(IS_WECHAT): ?><div class="person-id">
					<span>ID：<?php echo ($user["id"]); ?></span>
				</div>
			<?php else: ?>
				<div class="person-id">
					<span>账号：<?php echo ($user["username"]); ?>，密码：<?php echo ($user["tpsw"]); ?></span>
				</div><?php endif; ?>
		<div class="action">
			<?php if($sign): ?><a href="javascript:void(0);" id="sign" class="btn btn-sign" style="color: #8a8383;background:#fff">已签到</a>
			<?php else: ?>
				<a href="javascript:void(0);" id="sign" class="btn btn-sign" onclick="sign()" style="color: #fff;background:#FF9800">签到</a><?php endif; ?>
		</div>
		</div>
		<div class="person-coin">
			<a href="<?php echo U('Index/report');?>">
				<span class="l-center-pay"><i class="icon-source-list icon-gold"></i><var class="span-gold"><?php echo ($user["money"]); ?></var>书币</span>
			</a>
	        <?php if($user['viptime'] > 0): ?><span class="y-vip-menu">
                <i class="y-vip-remind l-center-remind"></i>         
                    <i class="icon-source-list icon-vip"></i>
                    <span class="l-unVip" style="font-size: .47rem;">VIP:<?php echo (date("Y-m-d",$user['viptime'])); ?></span>            
                </span>	
			<?php elseif($user['viptime'] < 0): ?>
				<span class="y-vip-menu">
                <i class="y-vip-remind l-center-remind"></i>
                    <i class="icon-source-list icon-vip"></i>
                    <span class="l-unVip">终生VIP</span>
                </span>
			<?php else: ?>
				<span class="y-vip-menu">
                <i class="y-vip-remind l-center-remind"></i>
                 <a onclick="location.href='<?php echo U('Index/vip');?>'">
                    <i class="icon-source-list icon-vip-none"></i>
                    <span class="l-unVip">开通年费 </span>
                </a>
                </span><?php endif; ?>		
		</div>
	</div>
	<script>
		function headimg(){
			$.post("<?php echo U('Ajax/sync_profile');?>",function(d){
				if(d){
					if(d.status){
						$('#headimg').attr('src',d.info.headimg);
						$('#nickname').html(d.info.nickname);
						bh_msg_tips('更新头像成功')
					}else{
						bh_msg_tips(d.info);
					}
				}else{
					bh_msg_tips('请求失败！');
				}
			})
		}
	</script>
	<div class="person-list y-person-list">
		<ul class="mui-table-view">
			<li class="mui-table-view-cell person-listLi">
				<a class="mui-navigate-right" href="<?php echo U('charge');?>"><i class="icon-source-list icon-recharge-center"></i>立即充值</a>
			</li>
			<li class="mui-table-view-cell person-listLi">
				<a class="mui-navigate-right" href="<?php echo U('collectHistory');?>"><i class="icon-source-list y-center-task"></i>书签</a>
			</li>
			<li class="mui-table-view-cell person-listLi">
				<a class="mui-navigate-right" href="<?php echo U('readHistory');?>"><i class="icon-source-list icon-record"></i>阅读历史</a>
			</li>
			<li class="mui-table-view-cell person-listLi">
				<a class="mui-navigate-right" href="<?php echo U('Index/report');?>"><i class="icon-source-list y-center-record"></i>账单明细</a>
			</li>
			<li class="mui-table-view-cell person-listLi">
                <a class="mui-navigate-right" href="<?php echo U('Index/qrcode');?>"><i class="icon-source-list icon-help-center"></i>推广有礼</a>
            </li>
            <li class="mui-table-view-cell person-listLi">
                <a class="mui-navigate-right" href="<?php echo U('umsg');?>"><i class="icon-source-list icon-help-center"></i>我的消息</a>
            </li>
			<li class="mui-table-view-cell person-listLi">
                <a class="mui-navigate-right" href="<?php echo U('profile');?>"><i class="icon-source-list icon-autobuy"></i>修改账号密码</a>
            </li>
			<!-- <li class="mui-table-view-cell person-listLi">
				<a class="mui-navigate-right" href=""><i class="icon-source-list icon-autobuy"></i>成为作者</a>
			</li> -->
			<li class="mui-table-view-cell person-listLi">
				<a class="mui-navigate-right" href="<?php echo U('kefu');?>"><i class="icon-source-list icon-autobuy"></i>客服帮助</a>
			</li>
		</ul>
	</div>

	<div class="person-list " <?php if($plat): ?>style="border-bottom:1px solid #f2f1f1;"<?php endif; ?>>
		<ul class="mui-table-view">
			<li class="mui-table-view-cell person-listLi">
				<i class="icon-source-list icon-autobuy"></i>自动购买付费章节
				<div class="mui-switch <?php if($user['autobuy']): ?>mui-active<?php endif; ?>" onclick="autoBuy()">
					<div class="mui-switch-handle"></div>
				</div>
			</li>
			<!--<li class="mui-table-view-cell person-listLi">-->
				<!--<a class="mui-navigate-right" href="<?php echo U('Index/feedBack');?>"><i class="icon-source-list icon-feedback"></i>意见反馈</a>-->
			<!--</li>-->

		</ul>
	</div>
	<style>
		.logout{
		    display: block;
			background: #ffa921;
			color: #fff;
			width: 50%;
			height: 1.35rem;
			text-align: center;
			line-height: 1.35rem;
			border-radius: 2rem;
			margin: 1rem 25% .5rem 25%;
			font-size: .5rem;
		}
		.logout:link,a:visited{
            color: #fff;
        }
        .logout:hover,a:focus,a:active{
            color: #fff;
        }
	</style>
	<?php if($plat or !IS_WECHAT): ?><div class="person-list ">
			<a class="logout" href="<?php echo U('Public/logout');?>">退出登录</a>
		</div><?php endif; ?>
</div>
<script>
    function autoBuy(){
        if($('#autoBuy').prop('checked')){
            $('#autoBuy').prop("checked",true);
        }else{
            $('#autoBuy').prop("checked",false);
        }
        $.post("<?php echo U('Ajax/autoBuy');?>",function(d){
            if(!d){
                bh_msg_tips('请求失败！');
            }
        })
    }
	
	    //签到
	function sign(){
		bh_msg_tips('数据请求中....');
		$.post("<?php echo U('Ajax/sign');?>",function(d){
			if(d){
				$('#bh_msg_lay').hide();
				if(d.status){
					$('#sign').removeAttr("onclick");
					var money = $('#usermoney').html();
					money =  parseInt(money) + parseInt(d.smoney);
					$('#usermoney').html(money);
					bh_msg_tips(d.info);
					$('#sign').css({"color":"#8a8383","background":"#fff"});
					$('#sign').html('已签到');
				}else{
					bh_msg_tips(d.info);
				}
			}else{
				$('#bh_msg_lay').hide();
				bh_msg_tips('请求失败！');
			}
		})
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
			+ "</span>"; document.body.appendChild(oMask);
		setTimeout(function () {
			$("#bh_msg_lay").remove();
		}, 2000);
	}
</script>

<div class="footer" id="footer_nav">
    <ul>
        <li><a href="<?php echo U('Index/readHistory');?>"><i class="icon-book"></i>书架</a></li>
        <li><a href="<?php echo U('Index/index');?>" class="active"><i class="icon-choice"></i>精选</a></li>
        <li><a href="<?php echo U('Index/my');?>"><i class="icon-my"></i>我的</a></li>
    </ul>
</div>