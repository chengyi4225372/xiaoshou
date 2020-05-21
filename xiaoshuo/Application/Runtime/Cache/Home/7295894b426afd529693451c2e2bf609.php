<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/default.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/bookshelf5.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/template3/common5.css" />
	 <link rel="stylesheet" type="text/css" href="/Public/home/css/template5_classify.css" />
	<script type="text/javascript" src="/Public/home/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/highlight.pack.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.lazyload.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.lazyload.img.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/jquery.bigautocomplete.js"></script>
    <script type="text/javascript" src="/Public/home/js/template3/mui.zoom.js"></script>
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
<style>
.w-shelfCleanUp a {
    float: right;
    padding-left: .2rem;
    height: .4rem;
    font-size: .15rem;
    line-height: .4rem;
    background-position: 0 center;
    background-repeat: no-repeat;
}
.r_img_edit_close {
    background-image: url(/Public/home/img/icon/icon-del2.png);
    background-size: .16rem auto;
    color: #FFB473;
}
.r_img_edit_open {
    background-image: url(/Public/home/img/icon/icon-setting.png);
    background-size: .16rem auto;
    color: #FFB473;
}
.content_null_box {
    overflow: hidden;
	text-align: center;
    background-color: #fff;
}
.content_null_box span {
    display: block;
    overflow: hidden;
    font-size: .15rem;
    color: #513d3d;
    text-align: center;
    line-height: .21rem;
}

	.mui-popup-in {
		position: fixed !important;
	}

	.mui-popup-out {
		position: fixed !important;
	}
	img{object-fit: cover;}
	.w-operation1{background: #faebc3 ;}
	.w-Select {color: #be9f5d;}
	.w-delete {color: #e40101;}
	.top {
 font-size:15px;
 font-weight:400;
 display: table;
 overflow:hidden;
 width:50%;
 margin: 0px auto;
 table-layout:fixed;
 border:1px solid #FFB473;
 border-radius:3px;
 background-color:transparent;
 -webkit-touch-callout:none;

}
.top .toptab {
 line-height:0.4rem;
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
</style>

<body>

<div class="head_tit_box">
    <a href="javascript:;" class="head_return_page_but"></a>
	<div class="head_menu_but_box">
		<a href="javascript:;" class="head_menu_but"></a>
	</div>
    <h1><?php echo ($mtitle); ?></h1>
</div>

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

<div class="w-shelfTab ">
	<div id="segmentedControl" class="top">
		<a class="toptab active">我的书架</a>
		<a class="toptab" href="<?php echo U('Index/readHistory',array('btype'=>$btype));?>">阅读记录</a>
		
	</div>
	<?php if(($totalnum) != "0"): ?><div class="w-shelfCleanUp">
		<span class="w-cleanUp"><a href="javascript:;" class="r_img_edit_open">管理</a></span>
		<span class="w-achieve"><a href="javascript:;" class="r_img_edit_close">完成</a></span>
	</div><?php endif; ?>
</div>
<div class="mui-content taphref">
	<div class="w-shelfContent">

		<!--收藏-->
		<div id="item1" class="mui-control-content mui-active">
<!-- 
			<div class="w-shelfUpdate" style="display: none;">
				<div class="w-userPhoto">
					<img src="/Public/home/js/template3/scpic.jpg"/>
				</div>
				<div class="w-shelfNum">您收藏的漫画有<span class="updateCount">0</span>部更新啦！</div>
			</div> -->

			<div class="w-shelfBooklist">
				<ul id="shelf-container">

				</ul>
			</div>
			<div class="content_null_box"  style="display:none;">
				<img src="/Public/home/img/icon/icon_5.png" style="width: 1.05rem;" />
				<span>你还没有<i>收藏</i>书本</span>
			</div>
			<div class="w-operation1">
				<div class="w-Select">
					<div class="w-SelectAll">全选</div>
					<div class="w-SelectNone">取消</div>
				</div>
				<div class="w-delete">删除</div>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
    var page = 1;
    var wait = true;
$(function () {
    //菜单
    $('.pop_up_menu_box > i, .head_menu_but, .pum_tit_box a').click(function () {
        $('.pop_up_menu_box').toggleClass('pop_up_menu_show');
    });

});
    $(function () {
        getData();
        $('.bs-box').bind("scroll", function (event) {
            if(!wait) return;
            var top = document.documentElement.scrollTop + document.body.scrollTop;
            var textheight = $(document).height();
            if (textheight - top - $(window).height() <= 100) {
                page++;
                getData();
            }
        });
    });

    //获取数据
    function getData(){
       
        $.post("<?php echo U('Ajax/getCollectHistory3');?>",{page:page,btype:"<?php echo ($btype); ?>"},function(d){
            if(d){
                if(d.status){
                    $('#shelf-container').append(d.info);
                }else{
                    if(page == 1 && $('#nolist').length == 0){
                        $('.content_null_box').show();	
                    }
                    wait = false;
                }
            }else{
                bh_msg_tips('加载失败！');
            }
        })
    }

    $('#edit_shelf_btn').click(function(){
        if($("#shelf-container").hasClass('editable')){
            $("#shelf-container").removeClass('editable');
            $('#niubi').show();
            $('#bibibi').hide();
            $('#d_layer').hide();
            $('#myfooter').show();

            //去掉勾选中的样式
            $("#select_all").prop("checked",false);
            //去掉item中swtich的check
            $('.item').find('.swtich').removeClass('check');
            //清除删除数量
            $('#delete_count').html(0);
        }else{
            $("#shelf-container").addClass('editable');
            $('#niubi').hide();
            $('#bibibi').show();
            $('#d_layer').show();
            $('#myfooter').hide();
        }
    });
    function choose(ob){
        if($(ob).parents('.editable').length>0){
            if($(ob).find('.swtich').hasClass('check')){
                $(ob).find('.swtich').removeClass('check');
                var len = $('.check').length;
                //如果数量小于item的数量
                if($('#shelf-container .item').length > len){
                    $("#select_all").prop("checked",false);
                }

            }else{
                $(ob).find('.swtich').addClass('check');
                var len = $('.check').length;
                //如果数量等于item的数量
                if($('#shelf-container .item').length == len){
                    $("#select_all").prop("checked",true);
                }
            }
            $('#delete_count').html(len);
        }
    }

    $('#select_all').click(function(){
        if($("#select_all").prop("checked")){
            $('.row-list').find('.swtich').addClass('check');
            $('#delete_count').html($('#shelf-container .item').length)
        }else{
            $("#select_all").prop("checked",false);
            $('.row-list').find('.swtich').removeClass('check');
            $('#delete_count').html(0);
        }
    })
	/*

    //确定删除
    var ids = [];
    function deleteCollect(){
        ids = [];
        $('.row-list .swtich').each(function(){
            if($(this).hasClass('check')){
                ids.push($(this).attr("_id"));
            }
        });

        $('.mask-box').show();
        $('#confirm-delete-count').html(ids.length);
        $('.modal').show();
    }

    //提交删除
    function confirmDelete(){
        if(ids.length == 0){
            bh_msg_tips('您没有选中任何记录！');
            return false;
        }
        $('.row-list .swtich').each(function(){
            if($.inArray($(this).attr("_id") ,ids)>=0 && $(this).hasClass('check')){
                $(this).parents('.item').remove();
            }
        });
        $('.mask-box').hide();
        $('#confirm-delete-count').html(0);
        $('.modal').hide();

        $("#shelf-container").removeClass('editable');
        $('#niubi').show();
        $('#bibibi').hide();
        $('#d_layer').hide();
        $('#myfooter').show();

        //去掉勾选中的样式
        $("#select_all").prop("checked",false);
        //去掉item中swtich的check
        $('.item').find('.swtich').removeClass('check');
        //清除删除数量
        $('#delete_count').html(0);

        if($('#shelf-container .item').length == 0){
            $('.common-ne').show();
        }

        $.post("<?php echo U('Ajax/deleteCollect');?>",{ids:ids.join(",")});
    }*/
	$(".w-operation1 .w-delete").click(function () {
        var checked = $(".w-checkbox1 input[name='checked']:checked");
        var ids = '';
        var len = 0;
        $.each(checked, function (i, e) {
            ids += e.value + ',';
            len += 1;
        });
        mui.confirm('确认删除选中' + len + '本书？', '删除后将无法恢复', ['是', '否'], function (e) {
            // 发送请求
            if (e.index == 0) {
                if (ids != "") {
                    var param = { ids: ids};
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo U('Ajax/deleteCollect');?>",
                        data: param,
                        dataType: 'json',
                        success: function (r) {
						     console.log(r);
                            if (r.status == 1) {
                                mui.toast('删除成功！');
                                // $.each(checked, function (i, e) {
                                //     $('#shelf' + e.value).remove();
                                // });
                                window.location.reload();
                            }
                        }
                    });
                } else {
                    mui.toast('请选择书籍！');
                }
            } else {
                mui.toast('已取消！');
            }
        })
    });
    mui('.mui-segmented-control').on('tap','a',function(){document.location.href=this.href;});
</script>
<script type="text/javascript" src="/Public/home/js/template3/common.js"></script> 

</body>
</html>