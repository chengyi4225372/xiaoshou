// 搜索 
var p = 1;
key_search_list_s();
// 列表分页获取
var autoready=1;
$(window).bind("scroll", function (event) {
	//滚动条到网页头部的 高度，兼容ie,ff,chrome
	var top = document.documentElement.scrollTop + document.body.scrollTop;
	var textheight = $(document).height();  //网页的高度
	// 网页高度-top-当前窗口高度
	if (textheight - top - $(window).height() <= 60){
		if(autoready==1) {
			autoready=0;
			// 请求分页数据 begin
			var key_v = $('#search_keyword_s').val();
			if(key_v == ''){
				return false;
			}
			p++;
			var url = "/Book/ajax_search";
			var data = {key:key_v,p:p}
//                    $("#bhloading").show();
			AjaxJson(url,data,function(data){
				autoready=1;
				if(data.status*1 == 1){
					$('#page_html').append(data.data);
				}
				$("#bhloading").hide();
			})
			// 请求分页数据 end
		}
	}
});

// 搜索页搜索
function key_search_list_s(){
	var key_v = $('#search_keyword_s').val();
	if(key_v == ''){
		return false;
	}
	var url = "/Book/ajax_search";
	var data = {key:key_v,p:1}
	$("#bhloading").show();
	AjaxJson(url,data,function(data){
		if(data.status*1 == 1){
			$('#page_html').html(data.data);
			$('#show_cleare_btn').show();
			$('#show_sear_btn').hide();
		}else{
			bh_msg_tips(data.info);
		}
		$("#bhloading").hide();
	})
}

$(function () {
	//回车自动提交
	$('.bh_se_box #search_keyword_s').keyup(function(event){
		var key_v = $('#search_keyword_s').val();
		if(key_v == ''){
			bh_msg_tips("请输入搜索内容");
			return false;
		}
		if(event.keyCode===13){
			key_search_list_s();
		}
	});
})
