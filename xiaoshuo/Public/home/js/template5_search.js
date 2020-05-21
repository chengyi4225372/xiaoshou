var searchName='';
var searchNameinput='';
var searchNameopeon=false;
var pageIndex=1;
var nTotalNum=10;
var searchassociatedtime=null;
var searchvariables=1;
var searchstarted=true;
var clearstartedtime=null;
var ntimeout=10000;
var oHotBook=[];
var nHotnum = 0;

$(function(){
	//返回上一页
	$('.new_search_return').click(function(){
		window.history.go(-1);
	});

	//输入搜索关键字
	$('.new_search_input_search').on('input','input',function(e){
		searchName = $.trim($(this).val());
		searchstarted=true;
		searchNameopeon=false;
		$('.nst_list_loading').hide();
		if(searchName.length>0){
			clearTimeout(searchassociatedtime);
			$('.new_search_input a').show();
			searchassociatedtime=setTimeout(function(){
				clearTimeout(searchassociatedtime);
				// 关键字热推
				// searchassociated(searchName);
			},500);
		}else{
            clearTimeout(searchassociatedtime);
            $('.new_search_tips_list,.ns_list_main_search_loading,.new_search_input a,.new_search_tips_body,.ns_list_main_search_loading').hide();
            $('.ns_list_main_box').show();
		}
	});

	//删除input内容
	$('.new_search_input a').on('click',function(){
        $(this).hide();
        $(".new_search_input_search input").val('');
        $('.new_search_tips_list,.new_search_tips_body,.ns_list_main_search_loading').hide();
		$('.ns_list_main_box').show();
		$('.ns_list_recommend').show();
		$('.ns_list_hot').show();
		$('.ns_list_main_local').show();

	});

	//敲回车搜索
	$(".new_search_input_search input").on('keypress',function(e) {
		var keycode = e.keyCode;
		var oThis=$(this);
		pageIndex=1;
		searchName = $.trim(oThis.val());
		if(keycode=='13') {
			if(searchName.length>0){
				if(searchNameopeon){
					return false;
				}
				searchNameopeon=true;
				clearTimeout(searchassociatedtime);
				e.preventDefault();
				searchstarted=true;
				searchtips(searchName,true);
				replacelocalstorage('locallist',searchName);
				cpslog([702,{
					map:{
						keyword:searchName
					}
				},'search_enter']);
			}else{
				oThis.val('');
				consoleMain('请输入要搜索的内容');
			}
		}
	});

	//点击搜索按钮搜索
	// $('.new_search_but').on('click',function(){
	// 	pageIndex=1;
	// 	searchName=$.trim($('.new_search_input_search input').val());
	// 	if(searchName.length>0){
	// 		if(searchNameopeon){
	// 			return false;
	// 		}
	// 		searchNameopeon=true;
	// 		searchstarted=true;
	// 		searchtips(searchName,true);
	// 		replacelocalstorage('locallist',searchName);
	// 		cpslog([702,{
	// 			map:{
	// 				keyword:searchName
	// 			}
	// 		},'search_but']);
	// 	}else{
	// 		$('.new_search_input_search input').val('');
	// 		consoleMain('请输入要搜索的内容');
	// 	}
	// });

	//点击列表搜索点击的词
	$('.ns_list_main_local,.new_search_tips_list_ul').on('click','li',function(){
		var oThis=$(this);
		var skeyword=oThis.text();
		pageIndex=1;
		$('.new_search_input_search input').val(skeyword);
		$('.new_search_input a').show();
		searchstarted=true;
		searchtips(skeyword,true);
		replacelocalstorage('locallist',skeyword);
		cpslog([702,{
			map:{
				keyword:skeyword
			}
		},'search_local']);
	});

	//删除本地数据
	$('.ns_list_main_local a').on('click',function(){
		removelocalstorage('locallist');
		$('.ns_list_main_local ul').html('');
		$('.ns_list_main_local').hide();
	});

	//换一换
	$('.ns_list_hot .ns_list_hot_but').on('click',function(){
		var shot='';
		if(nHotnum < oHotBook.length - 1){
		   nHotnum++;
		}else{
			nHotnum = 0;
		}
		for(var i=0; i<oHotBook[nHotnum].length; i++){
            shot+='<li class="section-block"><a href="/index/book/info?book_id='+ oHotBook[nHotnum][i]['book_id'] +'" class="section-data" data-book_id="'+oHotBook[nHotnum][i]['book_id']+'" data-zone="热门搜索">'+oHotBook[nHotnum][i]['name']+'</a></li>';
		}
		$('.ns_list_hot ul').html(shot);
	});

	//大家都在看
	searcheverybody();

	//最近搜索
	replacelocalstorage('locallist');

	//滚动动加载搜索列表
	$(window).scroll(function(e){
		if($('.new_search_tips_body').css('display') == 'none'){
			return false;
		}
		if($('.new_search_tips_list').css('display') != 'none'){
			e.preventDefault();
			return false;
		}
        var nWinHeight = document.documentElement.clientHeight;
        var nWinTop = $(window).scrollTop() + nWinHeight;
        var nBodyScrollH = document.body.scrollHeight;
        var oNewLoading = $('.read_content_list').last();
        var newTime = Date.parse(new Date());

		if (searchstarted && nBodyScrollH - nWinTop < 300) {
			pageIndex++;
            searchtips(searchName);
		}

	});
});


//搜索关联词
function searchassociated(keyword){
	if(searchName.length>0){
		clearTimeout(searchassociatedtime);
		$.ajax({
			url:'/asg/portal/h5/searchTips.html?keyword='+keyword,
			type:'get',
			timeout: ntimeout,
			cache: false,
			success: function(data){
				data = jsono(data);
				var reg=new RegExp(keyword,'gm');
				if(data.status == 1){
					var sHtml='';
					//if(data.keys.length>0){
						for(var i=0; i<data.keys.length; i++){
							sHtml+='<li>'+data.keys[i]['key'].replace(reg,'<span>'+keyword+'</span>')+'</li>'
						}
						$('.new_search_tips_list_ul').html(sHtml);
						$('.new_search_tips_list').show();
					//}else{
						//$('.new_search_tips_list').hide();
					//}
					if(searchName.length>0){
						$('.ns_list_main_box,.new_search_tips_body').hide();
					}
				}
			},
			error:function(err){
			}
		});
	}else{
		clearTimeout(searchassociatedtime);
		$('.new_search_tips_list').hide();
	}
}

//大家都在看
function searcheverybody (){
	var sex = $("#sex").val();
	$.ajax({
		url:'/api/index/hotsearchapi?sex='+sex,
		type:'get',
		timeout: ntimeout,
		cache: false,
		success: function(data){
			data = jsono(data);
			//输入框默认值
//			if(data.defSearchKeys.length>0){
//				$('.new_search_input_search input').val(data.defSearchKeys[nrandom(data.defSearchKeys.length)]['tags']);
//				$('.new_search_input a').show();
//			}
			//大家都在看
			var shot=''
			var MAX_NUM = 5;
			if(data.length>0){
				$('.ns_list_hot').show();
				ahotsearchapi = data;
				for(var i=0; i<data.length; i++){
					if(!oHotBook[parseInt(i/MAX_NUM)]){
						oHotBook.push([data[i]]);
					}else{
						oHotBook[parseInt(i/MAX_NUM)].push(data[i]);
					}
					if(i<MAX_NUM){
                        shot+='<li class="section-block"><a href="/index/book/info?book_id='+ data[i]['book_id'] +'" class="section-data" data-book_id="'+data[i]['book_id']+'" data-zone="大家都在看">'+data[i]['name']+'</a></li>';
					}
				}
				if(oHotBook.length > 0){
					if(oHotBook.length > 1){
						$('.ns_list_hot_but').show();
					}
					$('.ns_list_hot ul').html(shot);
					$('.ns_list_hot').show();
				}
			}else{
				$('.ns_list_hot').hide();
			}
		},
		error:function(err){
		}
	});
}


//搜索列表
function searchtips(keyword,boolean){
	if(searchstarted){
		searchStarted();
		if(pageIndex == 1){
			loadingimg();
		}else{
			$('.nst_list_loading').html('玩命加载中~');
			$('.nst_list_loading').show();
		}
		$.ajax({
			url:"/index.php?m=&c=ajax&a=searchapi&btype=2&keyword="+keyword+"&page="+pageIndex,
			type:'get',
			timeout: ntimeout,
			cache: false,
			success: function(data){
				data = jsono(data);
				clearTimeout(clearstartedtime);
				if(boolean){
					$('.nst_list_ul').html('');
				}

				$('.ns_list_main_box').hide();

				if(data['priMap']['searchList']['length'] <= 0 && pageIndex == 1){
					//搜索为null
					loadingnull(keyword);
					
					$('.ns_list_hot').hide();
					$('.ns_list_main_local').hide();
					$('.new_search_tips_list').hide();
					searchvariables=1;
					searchstarted=false;
				}else if(data['priMap']['searchList']['length']>0){
					clearloading();
					var slist='';
					var osearchlist=data['priMap']['searchList'];
					var reg=new RegExp(keyword,'gm');
					for(var i=0; i<osearchlist['length']; i++){
						var sisfinish = '<i style="color: #ffc701;">已完结</i>';
						if(osearchlist[i].iswz == 2){
							sisfinish = '<i style="color: #ffc701;">已完结</i>';
						}else{
							sisfinish = '<i>连载中</i>';
						}
						// sLi=sliformwork.replace(/aHref/, '/index/book/info?book_id='+osearchlist[i]['id']+'&t='+Math.random());
						// sLi=sLi.replace(/dataOriginal/,osearchlist[i]['image']);
						// osearchlist[i]['name']=osearchlist[i]['name'].replace(reg,'<span>'+keyword+'</span>');
						// sLi=sLi.replace(/searchName/,osearchlist[i]['name']);
						// osearchlist[i]['author']=osearchlist[i]['author'].replace(reg,'<span>'+keyword+'</span>');
						// sLi=sLi.replace(/searchAuthor/,osearchlist[i]['author']);
						// if(osearchlist[i]['description'].length>0){
						// 	osearchlist[i]['description']=osearchlist[i]['description'].replace(reg,'<span>'+keyword+'</span>');
						// 	sLi=sLi.replace(/searchIntroduction/,osearchlist[i]['description']);
						// }else{
						// 	sLi=sLi.replace(/searchIntroduction/,'暂无介绍');
						// }
						// slist += sLi;
                        slist += '<li class="section-block">\
							<a href="/index/book/info?book_id=' + osearchlist[i].id + '" class="section-data" data-book_id="' + osearchlist[i].id + '" data-zone="热门搜索">\
								<div class="i_images_img"><img alt="" src="' + osearchlist[i].coverpic + '"></div>\
								<div class="i_images_txt_box">\
									<h3>' + osearchlist[i].title + '</h3>\
									<p>' + osearchlist[i].remark + '</p>\
									<div class="i_images_txt_other">\
										<strong>' + sisfinish +'\
											<b>' + osearchlist[i].author + '</b>\
										</strong>\
										<em>' + osearchlist[i].id + '人在追</em>\
									</div>\
								</div>\
							</a>\
						</li>';
					}
					if(osearchlist['length'] > 0){
						searchvariables=2;
						$('.nst_list_ul').append(slist);
						$('.ns_list_recommend').hide();
						$('.new_search_tips_body').show();
						
						searchstarted=true;
						$('img').picLazyLoad({
							effect : "fadeIn"
						});
					}
					if(osearchlist['length'] < nTotalNum){
						//push之后的数据
						searchstarted=false;
						$('.nst_list_loading').html('全部搜索结果');
						$('.nst_list_loading').show();
					}else{
						$('.nst_list_loading').hide();
					}
					if($('.new_search_tips_body').css('display') == 'none'){
						$('.ns_list_main_box,.new_search_tips_list').hide();
						$('.new_search_tips_body').show();
					}
				}else if(data['priMap']['searchList']['length'] <= 0){
					$('.nst_list_loading').html('全部搜索结果');
					$('.nst_list_loading').show();
					searchstarted=false;
				}
				
				cpslog([703,{
					map:{
						result:1,
						keyword:keyword
					}
				},'ssjg']);
			},
			error:function(err){
				searchstarted=true;
				
				cpslog([703,{
					map:{
						result:4,
						keyword:keyword
					}
				},'ssjg']);
			}
		});
	}
}

//搜索loading
function loadingimg(){
	$('.ns_list_main_search_loading,.ns_list_main_search_loading_img,.ns_list_main_box').show();
	$('.ns_list_main_search_loading_null').hide();
}

//搜索null
function loadingnull(keyword){
	searchvariables=1;
	$('.ns_list_main_search_loading,.ns_list_main_search_loading_null,.ns_list_main_box').show();
	$('.ns_list_main_search_loading_img').hide();
	$('.j_keyword').text(keyword);
}

//关闭搜索loading
function clearloading(){
	if($('.ns_list_main_box').css('display') != 'none'){
		$('.ns_list_main_box').hide();
	}
	if(!$('.new_search_tips_list').css('display') != 'none'){
		$('.new_search_tips_list').hide();
	}
	if(!$('.ns_list_main_search_loading').css('display') != 'none'){
		$('.ns_list_main_search_loading').hide();
	}
}




//获取随机数
function nrandom(num,nummin){
	var nrandom=Math.random();
	if(nummin){
		nrandom= parseInt( nrandom * num + nummin );
	}else{
		nrandom= parseInt( nrandom * num);
	}
	return nrandom;
}


//json串转换为json对象
function jsono(jstr) {
	if (typeof jstr == 'string') {
		try{
			return JSON.parse(jstr);
		} catch(e) {
			return jstr;
		}
	}
	return jstr;
}

//json对象转换为json串
function jsons(jobj) {
	if (typeof jobj == 'object') {
		try{
			return JSON.stringify(jobj);
		} catch(e) {
			return jobj;
		}
	}
	return jobj;
}



//获取本地数据
function getlocalstorage(key){
	if(window.localStorage){
		var oWinSt=window.localStorage;
		var localstoragecontent=$.trim(oWinSt.getItem(key));
		if(localstoragecontent){
			if(typeof localstoragecontent=='string'){
				try{
					localstoragecontent = JSON.parse(localstoragecontent);
				}catch(e){
					return '';
				}
			}
			return localstoragecontent;
		}else{
			return '';
		}
	}
}

//修改本地数据
function setlocalstorage(key,arr){
	if(window.localStorage){
		var oWinSt=window.localStorage;
		if(typeof arr=='object'){
			arr = JSON.stringify(arr);
		}
		oWinSt.setItem(key,arr);
	}
}

//删除为 key 的本地数据
function removelocalstorage(key){
	if(window.localStorage){
		var oWinSt=window.localStorage;
		oWinSt.removeItem(key);
	}
}

//更新本地搜索数据
function replacelocalstorage(key,str){
	var getlarr=getlocalstorage(key);
	if(str){
		if(!getlarr){
			getlarr=[str];
		}
		if(typeof getlarr == 'object'){
			if(getlarr.indexOf(str) > -1){
				getlarr.splice(getlarr.indexOf(str),1);
			}
			getlarr.unshift(str);
			if(getlarr.length>5){
				getlarr.splice(5,getlarr.length);
			}
		}else if(typeof getlarr == 'string'){
		}
		setlocalstorage(key,getlarr);
	}

	//最近搜索
	var nslistlocal=''
	if(getlarr.length>0){
		$('.ns_list_main_local').show();
		for(var i=0; i<getlarr.length; i++){
			nslistlocal+='<li><span>'+getlarr[i]+'</span></li>';
		}
		$('.ns_list_main_local ul').html(nslistlocal);
	}else{
		$('.ns_list_main_local').hide();
	}
};


function searchStarted(){
	clearTimeout(clearstartedtime);
	searchstarted=false;
	clearstartedtime=setTimeout(function(){
		searchstarted=true;
	},ntimeout);
}
