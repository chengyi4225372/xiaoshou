<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="height: auto;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ($_site['name']); ?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="/Public/admin/css/bootstrap.min.css">
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/admin/css/ionicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/admin/css/AdminLTE.min.css">
<link rel="stylesheet" href="/Public/admin/css/_all-skins.min.css">
<link rel="stylesheet" href="/Public/admin/css/blue.css">
<link rel="stylesheet" href="/Public/admin/css/bootstrap-datetimepicker.min.css">
<link href="https://novel.youshuge.com/img/favicon.ico" rel="icon" type="image/x-icon">
<link rel="stylesheet" href="/Public/layer/skin/default/layer.css">
<script src="/Public/admin/js/jquery-2.2.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/admin/js/bootstrap-datetimepicker.min.js"></script>
<script src="/Public/admin/js/app.min.js"></script>
<script src="/Public/layer/layer.js"></script>
<style type="text/css">
	.skin-purple-light .wrapper, .skin-purple-light .main-sidebar, .skin-purple-light .left-side {
		background-color: #f9f9f9;
	}

	.skin-purple-light .sidebar-menu > li > .treeview-menu {
		background-color: #e8e8e8;
	}

	.skin-purple-light .sidebar-menu > li > a {
		font-weight: unset;
	}

	.skin-purple-light .treeview-menu > li.active > a, .skin-purple-light .sidebar-menu > li.active > a, .skin-purple-light .treeview-menu > li.active > a {
		background-color: #e6f7ff;
		border-right: 2px solid #168fff;
		color: #57b6ff;
		font-weight: unset;
	}

	.skin-purple-light .sidebar-menu > li:hover > a, .skin-purple-light .sidebar-menu > li:hover > a, .skin-purple-light .treeview-menu > li > a:hover, .skin-purple-light .sidebar-menu > li > a:hover {
		color: #57b6ff;
	}

	.sidebar-menu .treeview-menu > li > a {
		padding-left: 40px;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.sidebar-menu .treeview-menu {
		padding-left: 0;
	}

	.skin-purple-light .sidebar a {
		color: #666;
	}

	.wysiwyg-color-black {
		color: black !important;
	}

	.wysiwyg-color-silver {
		color: silver !important;
	}

	.wysiwyg-color-gray {
		color: gray !important;
	}

	.wysiwyg-color-maroon {
		color: maroon !important;
	}

	.wysiwyg-color-red {
		color: red !important;
	}

	.wysiwyg-color-purple {
		color: purple !important;
	}

	.wysiwyg-color-green {
		color: green !important;
	}

	.wysiwyg-color-olive {
		color: olive !important;
	}

	.wysiwyg-color-navy {
		color: navy !important;
	}

	.wysiwyg-color-blue {
		color: blue !important;
	}

	.wysiwyg-color-orange {
		color: orange !important;
	}
	.glyphicon {
		margin-right: 6px;
	}
	.wechat{
		line-height: 50px;
		width: 100%;
		display: block;
		text-align: center;
		font-size: 24px;
		color: #ecfd02;
	}
</style>
<link rel="stylesheet" href="/Public/admin/css/laydate.css" id="layuicss-laydate">
<style type="text/css">
	.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
</style>
</head>
<body class="sidebar-mini skin-purple-light" style="height: auto;">
<div class="wrapper" style="height: auto;">
    <header class="main-header">
        <a href="<?php echo U('Index/index');?>" class="logo">
            <span class="logo-mini"><b><?php echo substr($_site['name'],0,3);?></b><?php echo substr($_site['name'],3,3);?></span>
            <span class="logo-lg">
				<img src="/Public/admin/images/logo.png">
				<b><?php echo ($_site['name']); ?></b>
			</span>
			
        </a>
        <nav class="navbar navbar-static-top">
            <a href="<?php echo U('Index/index');?>" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="<?php echo U('Index/index');?>" class="user-panel dropdown-toggle" data-toggle="dropdown" style="height: 50px; display: flex;">
                            <img src="/Public/admin/images/avatar2.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo session('admin.name');?></span>
                            <span>
                               <i class="fa fa-angle-down"></i>
                               <i class="fa fa-angle-up hidden"></i>
                           </span>
                        </a>
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close" style="width: 150px;">
                            <li>
                                <a href="<?php echo U('Config/site');?>"><i class="fa fa-fw fa-user"></i> 站点设置</a>
                            </li>
                            <li>
                                <a href="<?php echo U('Config/user');?>"><i class="fa fa-fw fa-key"></i> 修改密码</a>
                            </li>
                            <li class="divider"></li>
							<li>
                                <a href="<?php echo U('Config/camera');?>"><i class="fa fa-fw fa-camera"></i> 视频教程</a>
                            </li>
							<li class="divider"></li>
                            <li>
                                <a href="<?php echo U('Pub/logout');?>">
                                    <i class="fa fa-fw fa-power-off"></i> 安全退出
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
			<b class="wechat">管理后台</b>
        </nav>
    </header>
   
    <aside class="main-sidebar">
        <section class="sidebar" style="height: auto;">
            <ul class="sidebar-menu">
				<li>
                    <a href="<?php echo U('Index/index');?>">
                        <i class="fa fa-tasks"></i> <span>首页</span>
                    </a>
                </li>
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-sun-o"></i> 
						<span>站点设置</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Config/site');?>">
								<i class="fa fa-angle-right"></i> 
								站点设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/charge');?>">
								<i class="fa fa-angle-right"></i>
								充值设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/navindex');?>">
								<i class="fa fa-angle-right"></i>
								底部导航
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/middleindex');?>">
								<i class="fa fa-angle-right"></i>
								中间导航
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/ads');?>">
								<i class="fa fa-angle-right"></i> 
								广告设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/tpl');?>">
								<i class="fa fa-angle-right"></i> 
								模版设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/logo');?>">
								<i class="fa fa-angle-right"></i>
								首页logo
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/user');?>">
								<i class="fa fa-angle-right"></i> 
								修改密码
							</a>
						</li>
                    </ul>
				</li>
                
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-bar-chart"></i> 
						<span>数据统计</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Center/orders');?>">
								<i class="fa fa-angle-right"></i> 
								订单统计
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Center/users');?>">
								<i class="fa fa-angle-right"></i> 
								用户统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/charge');?>">
								<i class="fa fa-angle-right"></i> 
								充值统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/separate');?>">
								<i class="fa fa-angle-right"></i> 
								分成统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/chapter');?>">
								<i class="fa fa-angle-right"></i> 
								外推统计
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/lodge');?>">
								<i class="fa fa-angle-right"></i> 
								举报统计
							</a>
						</li>
                    </ul>
				</li>
								
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-bar-chart"></i> 
						<span>财务统计</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Center/corder');?>">
								<i class="fa fa-angle-right"></i> 
								订单信息
							</a>
						</li>
						<li>
							<a href="<?php echo U('Charge/index');?>">
								<i class="fa fa-angle-right"></i> 
								充值记录
							</a>
						</li>
						<li>
							<a href="<?php echo U('Center/withdraw');?>">
								<i class="fa fa-angle-right"></i> 
								代理结算
							</a>
						</li>
                    </ul>
				</li> 
                <!-- <li class="treeview">
                    <a href="#">
						<i class=" fa fa-image"></i> 
						<span>漫画管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Config/mhArea');?>">
								<i class="fa fa-angle-right"></i> 
								发布区域
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Config/mhStore');?>">
								<i class="fa fa-angle-right"></i> 
								漫画分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/mhBanner');?>">
								<i class="fa fa-angle-right"></i> 
								漫画轮播
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/caric');?>">
								<i class="fa fa-angle-right"></i> 
								漫画列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/caricRecover');?>">
								<i class="fa fa-angle-right"></i> 
								漫画仓库
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/caricComments');?>">
								<i class="fa fa-angle-right"></i> 
								评论管理
							</a>
						</li>
                    </ul>
				</li>
				 -->
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-book"></i> 
						<span>小说管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Config/xsArea');?>">
								<i class="fa fa-angle-right"></i> 
								发布区域
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Config/xsStore');?>">
								<i class="fa fa-angle-right"></i> 
								小说分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/xsBanner');?>">
								<i class="fa fa-angle-right"></i> 
								小说轮播
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/novel');?>">
								<i class="fa fa-angle-right"></i> 
								小说列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/novelRecover');?>">
								<i class="fa fa-angle-right"></i> 
								小说仓库
							</a>
							<li>
							<a href="<?php echo U('Book/novelComments');?>">
								<i class="fa fa-angle-right"></i> 
								评论管理
							</a>
						</li>
						</li>
                    </ul>
				</li>
				
				<!-- <li class="treeview">
                    <a href="#">
						<i class=" fa fa-podcast"></i> 
						<span>听书管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
						<li>
							<a href="<?php echo U('Config/stArea');?>">
								<i class="fa fa-angle-right"></i> 
								发布区域
							</a>
						</li>
                        <li>
							<a href="<?php echo U('Config/stStore');?>">
								<i class="fa fa-angle-right"></i> 
								听书分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/stBanner');?>">
								<i class="fa fa-angle-right"></i> 
								听书轮播
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/story');?>">
								<i class="fa fa-angle-right"></i> 
								听书列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/storyRecover');?>">
								<i class="fa fa-angle-right"></i> 
								听书仓库
							</a>
						</li>
						<li>
							<a href="<?php echo U('Book/storyComments');?>">
								<i class="fa fa-angle-right"></i> 
								评论管理
							</a>
						</li>
                    </ul>
				</li>
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-file-video-o"></i> 
						<span>视频/电影管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Config/vdBanner');?>">
								<i class="fa fa-angle-right"></i> 
								轮播图设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/vdStore');?>">
								<i class="fa fa-angle-right"></i> 
								影视分类
							</a>
						</li>
						<li>
							<a href="<?php echo U('Config/vdArea');?>">
								<i class="fa fa-angle-right"></i> 
								<span>发布区域</span>
							</a>
						</li>
						<li>
							<a href="<?php echo U('Video/index');?>">
								<i class="fa fa-angle-right"></i> 
								<span>影视列表</span>
							</a>
						</li>
                    </ul>
				</li>
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-file-image-o"></i> 
						<span>漫画文案</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Cartoon/index');?>">
								<i class="fa fa-angle-right"></i> 
								漫画列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Chapter/index');?>">
								<i class="fa fa-angle-right"></i> 
								推广链接
							</a>
						</li>
						<li>
							<a href="<?php echo U('Chapter/delList');?>">
								<i class="fa fa-angle-right"></i> 
								推广回收
							</a>
						</li>
                    </ul>
				</li> -->
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-book"></i> 
						<span>小说文案</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Novel/index');?>">
								<i class="fa fa-angle-right"></i> 
								小说列表
							</a>
						</li>
						<li>
							<a href="<?php echo U('Nhapter/index');?>">
								<i class="fa fa-angle-right"></i> 
								推广链接
							</a>
						</li>
						<li>
							<a href="<?php echo U('Nhapter/delList');?>">
								<i class="fa fa-angle-right"></i> 
								推广回收
							</a>
						</li>
                    </ul>
				</li>
				<li>
                    <a href="<?php echo U('User/index');?>">
                        <i class="fa fa-users"></i><span>粉丝信息</span>
                    </a>
                </li>
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-user-plus"></i> 
						<span>渠道/代理商</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Mch/indes');?>">
								<i class="fa fa-angle-right"></i> 
								代理商管理
							</a>
						</li>
						<li>
							<a href="<?php echo U('Mch/index');?>">
								<i class="fa fa-angle-right"></i> 
								渠道商管理
							</a>
						</li>
                    </ul>
				</li>
				
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-commenting"></i> 
						<span>消息推送</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Custom/index');?>">
								<i class="fa fa-angle-right"></i> 
								群发推送
							</a>
						</li>
						<li>
							<a href="<?php echo U('Autoreply/index');?>">
								<i class="fa fa-angle-right"></i> 
								关键词回复
							</a>
						</li>
						<li>
							<a href="<?php echo U('Activity/index');?>">
								<i class="fa fa-angle-right"></i> 
								促销活动
							</a>
						</li>
                    </ul>
				</li>
				
				<li class="treeview">
                    <a href="#">
						<i class=" fa fa-gears"></i> 
						<span>公众号设置</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Selfmenu/index');?>">
								<i class="fa fa-angle-right"></i> 
								公众号菜单
							</a>
						</li>
						<li>
							<a href="<?php echo U('Index/integrate');?>">
								<i class="fa fa-angle-right"></i> 
								公众号配置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Selfmenu/links');?>">
								<i class="fa fa-angle-right"></i> <span>获取链接菜单</span>
							</a>
						</li>
                    </ul>
				</li>
				
				
				<li>
                    <a href="<?php echo U('Article/index');?>">
                        <i class="fa fa-newspaper-o"></i> <span>文案信息</span>
                    </a>
                </li>
				

				<!-- <li class="treeview">
                    <a href="#">
						<i class=" fa fa-diamond"></i> 
						<span>购物商城</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Seller/index');?>">
								<i class="fa fa-angle-right"></i> 
								商品管理
							</a>
						</li>
						<li>
							<a href="<?php echo U('Seller/record');?>">
								<i class="fa fa-angle-right"></i> 
								购买记录
							</a>
						</li>
                    </ul>
				</li> -->
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-bullhorn"></i> 
						<span>公告管理</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Notice/index');?>">
								<i class="fa fa-angle-right"></i> 
								代理公告
							</a>
						</li>
						<li>
							<a href="<?php echo U('Umsg/index');?>">
								<i class="fa fa-angle-right"></i> 
								个人公告
							</a>
						</li>
                    </ul>
				</li>
				<li>
                    <a href="<?php echo U('Feed/index');?>">
                        <i class="fa fa-comment"></i> <span>用户反馈</span>
                    </a>
                </li>
				
				<li class="treeview">
                    <a href="#">
						<i class="fa fa-cny"></i> 
						<span>打赏信息</span>
                        <span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
							<a href="<?php echo U('Config/prize');?>">
								<i class="fa fa-angle-right"></i> 
								打赏金额设置
							</a>
						</li>
						<li>
							<a href="<?php echo U('Prize/index');?>">
								<i class="fa fa-angle-right"></i> 
								打赏列表
							</a>
						</li>
                    </ul>
				</li>
				<li>
                    <a href="<?php echo U('Joinus/index');?>">
                        <i class="fa fa-address-card"></i><span>加盟代理记录</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper" style="min-height: 848px;">
       <link rel="stylesheet" href="/Public/admin/css/switch.css">
<section class="content-header">
<div>
	<ol class="breadcrumb" style="background: none; margin-bottom: 0px;">
		<li><a href="<?php echo U('Index/index');?>" style="color: #333;"><i class=" fa fa-home"></i>&nbsp;Home</a></li>
		<li class="active">分集信息</li>
	</ol>
</div>
</section>
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table class="table table-bordered table-hover table-striped text-center">
					<tbody>
						<tr>
							<th>章节名称</th>
							<th>第几章节</th>
							<th>操作</th>
						</tr>
						<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
								<td><?php echo ($v["title"]); ?></td>
								<td><?php echo ($v["chaps"]); ?></td>
								<td>
									<?php if($info['btype'] == 3): ?><a href="javascript:;" data-info="<?php echo ($v['info']); ?>" class="btn btn-info listing">
											<i class="fa fa-bell"></i>试听
										</a>
									<?php else: ?>
										<a href="javascript:;" data-title="<?php echo ($v["title"]); ?>" data-info="<?php echo ($v["info"]); ?>" data-btype="<?php echo ($info["btype"]); ?>" class="btn btn-info looks">
											<i class="fa fa-search"></i>查看
										</a><?php endif; ?>
									<?php if($info['btype'] == 1): ?><a href="javascript:;" onclick="showModal(<?php echo ($v["id"]); ?>,'<?php echo ($v["title"]); ?>','<?php echo ($v["coverpic"]); ?>','<?php echo ($info['btype']); ?>')" class="btn btn-info">
											<i class="fa fa-edit"></i>编辑
										</a>
									<?php elseif($info['btype'] == 2): ?>
										<a href="javascript:;" onclick="showModal(<?php echo ($v["id"]); ?>,'<?php echo ($v["title"]); ?>','<?php echo ($v["info"]); ?>','<?php echo ($info['btype']); ?>')" class="btn btn-info">
											<i class="fa fa-edit"></i>编辑
										</a>
									<?php else: ?>
										<a href="javascript:;" onclick="showModal(<?php echo ($v["id"]); ?>,'<?php echo ($v["title"]); ?>','<?php echo ($v["info"]); ?>','<?php echo ($info['btype']); ?>')" class="btn btn-info">
											<i class="fa fa-edit"></i>编辑
										</a><?php endif; ?>
								</td>
							</tr><?php endforeach; endif; ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="page"><?php echo ((isset($page) && ($page !== ""))?($page):"<p style='text-align:center'>暂时没有数据</p>"); ?></div>
		</div>
	</div>
</div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="modal-title"></h4>
			</div>
			<div class="modal-body" id="modal-content">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h5 class="modal-title">编辑分集信息</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="<?php echo U('setChapter');?>">
					<div class="form-group">
						<label class="control-label col-sm-2">分集标题:</label>
						<div class="col-sm-10">
							<input class="form-control" id="title" name="title" value="" />
						</div>
					</div>
					<?php if($info['btype'] == 1): ?><div class="form-group">
						<label class="control-label col-sm-2">分级封面:</label>
						<div class="col-sm-10">
							<iframe id="frame" src="<?php echo U('Index/upload', 'event=setPic&url');?>" scrolling="no" style="width:200px;height:200px;border: none;display:block;"></iframe>
							<input type="hidden" name="coverpic" id="coverpic" value="" class="smallinput" />
							<script>
							function setPic(url){
								document.getElementById('coverpic').value = url;
							}
							</script>
						</div>
					</div>
					<?php elseif($info['btype'] == 2): ?>
						<div class="form-group">
							<label class="control-label col-sm-2">分级内容:</label>
							<div class="col-sm-10">
								<textarea name="info" id="chapter-info" style="width: 100%;height: 500px;"></textarea>
							</div>
						</div>
					<?php else: ?>
						<div class="form-group">
							<label class="control-label col-sm-2">分级内容:</label>
							<div class="col-sm-10">
								<textarea name="info" id="mp3" style="width: 100%;height: 100px;"></textarea>
							</div>
						</div><?php endif; ?>
					<input class="form-control" type="hidden" id="id" name="id" value="" />
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="ajaxBtn" class="btn btn-primary">保存</button>
			</div>
		</div>
	</div>
</div>


<audio id="player" autoplay="false">  
	<source src="" type="audio/mpeg">  
</audio>

<script src="/Public/plugins/ueditor1.4.3/ueditor.config.js"></script>
<script src="/Public/plugins/ueditor1.4.3/ueditor.all.min.js"></script>
<script>
	var btype = "<?php echo ($info['btype']); ?>";
	if(btype == "1" || btype == "2"){
		var ue = UE.getEditor('chapter-info');
	}
	
	$('.looks').click(function(){
		var title = $(this).data('title');
			info = $(this).data('info');
			btype = $(this).data('btype');
		$('#modal-title').html(title);	
		if(btype == 2){
			$('#modal-content').html(info);
		}else{
			var arr = info.split(",");
			var html = "";
			$(arr).each(function(i,v){
				html+='<img src="'+v+'" style="width:100%;">';
			})
			$('#modal-content').html(html);
		}
		$('#myModal').modal('show');
	});
	
	
	$('.listing').click(function(){
		var player = document.getElementById("player");
		var src = $(this).data('info');
		if( ($('#player').attr('src') == "" || $('#player').attr('src') == undefined)){
			$('#player').attr('src',src);
			player.play();
			$(this).html('<i class="fa fa-bell"></i>暂停');
		}else if($('#player').attr('src') != "" && $('#player').attr('src') != "" && src != $('#player').attr('src')){
			$('#player').attr('src',src);
			player.play();
			$(this).html('<i class="fa fa-bell"></i>暂停');
			$(this).parent().parent().siblings().find('.listing').html('<i class="fa fa-bell"></i>试听');
		}else{
			if(player.paused){ 
				player.play();
				$(this).html('<i class="fa fa-bell"></i>暂停');
			}else{  
				player.pause();
				$(this).html('<i class="fa fa-bell"></i>试听');			
			};  
		
		}
	})
	
	

	//显示
	function showModal(id,title,info,btype){
		$('#id').val(id);
		$('#title').val(title);
		
		if(btype == '1'){
			$('#coverpic').val(info);
			var url = $('#frame').attr('src');
			url = changeURLArg(url,'url',info);
			$('#frame').attr('src',url);
		}else if(btype == "2"){
			ue.setContent(info);
			//$('#chapter-info').val(info);
		}else{
			$('#mp3').val(info);
		}
		
		$('#Modal').modal('show');
	}
	
	
	
	
	//修改url参数
	function changeURLArg(url,arg,arg_val){ 
       var pattern=arg+'=([^&]*)'; 
       var replaceText=arg+'='+arg_val; 
       if(url.match(pattern)){ 
           var tmp='/('+ arg+'=)([^&]*)/gi'; 
           tmp=url.replace(eval(tmp),replaceText); 
           return tmp; 
       }else{ 
           if(url.match('[\?]')){ 
               return url+'&'+replaceText; 
           }else{ 
               return url+'?'+replaceText; 
           } 
      } 
       return url+'\n'+arg+'\n'+arg_val; 
   }
</script>

    </div>
  
    <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<script src="/Public/admin/js/common.js"></script>
<script>
	var route = "<?php echo ($CAname); ?>";
    var href = '';
    $('.sidebar-menu').find('a').each(function () {
        $(this).parent('li').removeClass('active');
        href = $(this).attr('href');
        if ((href.indexOf(route) != -1) && (route != '/')) {
            $(this).parent('li').addClass('active');
            $(this).parents('.treeview').addClass('active');
		}
    });

    $('.dropdown-toggle').click(function (ev) {
        $(this).find('.fa-angle-down').toggleClass('hidden');
        $(this).find('.fa-angle-up').toggleClass('hidden');
    });
	
	// 调整默认选择内容
	$("select").each(function(index, element) {
		$(element).find("option[value='"+$(this).attr('default')+"']").attr('selected','selected');
	});
</script>
</body>
</html>