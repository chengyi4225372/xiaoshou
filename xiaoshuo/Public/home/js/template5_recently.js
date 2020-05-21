// JavaScript Document
var removeBook = true;

$(function(){
	//编辑最近阅读
	$('.r_img_edit_open').click(function(){
		$('.r_img_list_box').addClass('r_img_list_edit');
	});
	
	//取消编辑最近阅读
	$('.r_img_edit_close').click(function(){
		$('.r_img_list_box').removeClass('r_img_list_edit');
	});
	
	//选中要删除的book
	$('.r_img_list_box').on('click','.r_img_list_edit .r_img_ul a',function(e){
		var $this=$(this),booknum=0;
		$this.toggleClass('r_img_remove_select');
		booknum=$('.r_img_remove_select').length;
		$('.r_book_num em').text('已选中'+booknum+'本');
		if(booknum<=0){
			$('.r_img_list_box').removeClass('r_img_list_edit_remove');
		}else{
			$('.r_img_list_box').addClass('r_img_list_edit_remove');
		}
		
		//不要删 阻止点击a标签跳转
		e.stopPropagation();
		return false;
	});
	
	//确认删除最近阅读
	$('.r_img_edit_remove').click(function(){
		var orma = $('.r_img_remove_select');
		var armbid = '';
		var ntotalnum = orma.length;
		for(var i=0; i<orma.length; i++){
			armbid+=$('.r_img_remove_select').eq(i).parent().attr('sbid')+',';
		}
		if(armbid.length <= 0){
			return false;
		}
		//armbid=JSON.stringify(armbid);
		if(removeBook){
			 removeBook = false;
			 
			 mui.confirm('确认删除选中' + ntotalnum + '本书？', '删除后将无法恢复', ['是', '否'], function (e) {
            //alert(armbid);
			// 发送请求
                if (armbid != "") {
                    var param = {ids : armbid};
                    $.ajax({
                        type: 'POST',
                        url: '/index.php?m=&c=Ajax&a=deleteReadHistory',
                        data: param,
                        dataType: 'json',
                        success: function (r) {
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
			})
		}

	});

	scroll(function(direction) {
		if(direction=='down'){
			$('body').removeClass('fixednav');
		}else{
			if(afterScrollTop>100) {
				$('body').addClass('fixednav');
			}else{
				$('body').removeClass('fixednav');
			}
		}
	});
	
})


//滚动滚轮
var afterScrollTop=0;
function scroll( fn ) {
	var beforeScrollTop = $(window).scrollTop(),
		fn = fn || function() {};
	$(window).scroll(function() {
		afterScrollTop = $(window).scrollTop();
		var delta = afterScrollTop - beforeScrollTop;
		if( delta === 0 ) return false;
		fn( delta > 0 ? "down" : "up" );
		beforeScrollTop = afterScrollTop;
	});
}