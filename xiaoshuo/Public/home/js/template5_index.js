

$(function(){
	//轮播图
	var swiper = new Swiper('.swiper-container', {
		loop : true,
		centeredSlides: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});
	
	//点击榜tab
	$('.i_m_tit_tab a').click(function(){
		var $this=$(this);
		var nIndex=$this.index();
		var smoreurl=$this.attr('smoreurl');
		$this.addClass('hover').siblings('a').removeClass('hover');
		$('.j_paihang_tab ul').hide();
		$('.j_paihang_tab ul').eq(nIndex).show().siblings('ul').hide();
		$('.i_m_tit_tab_more').attr('href',smoreurl);
	});
	
	//图片懒加载
			
	$('img').picLazyLoad({
		effect : "fadeIn"
	});
	$(window).scrollTop($(window).scrollTop()+1);
	$(window).scrollTop($(window).scrollTop()-1);

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
	
});

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
