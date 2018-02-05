$(function(){
	
var before = $(document).scrollTop();// 滚动前
if (before > 0) {
	$(document.body).addClass('hasscroll');
}
var pagewidth = $(document).width();
$(document).scroll(function(){
	var after = $(document).scrollTop();// 滚动后
	if (pagewidth > 991) {// pc端才执行特效
		if (after > 0 ) {
		$(document.body).addClass('hasscroll');
		}else {
			$(document.body).removeClass('hasscroll');
		}
	}
});


// 手机端显示隐藏导航菜单
$("#mobile_nav").click(function(){
	if ($('#webliu').hasClass('open')) {
		$('#webliu').removeClass('open');
	}else{
		$('#webliu').addClass('open');
	}
});

// 返回顶部
$(window).scroll(function(){
		if($(window).scrollTop()>100){  //距顶部多少像素时，出现返回顶部按钮
			$(".gotop").fadeIn();	
		}
		else{
			$(".gotop").hide();
		}
	});
	$(".gotop").click(function(){
		$('html,body').animate({'scrollTop':0},500); //返回顶部动画 数值越小时间越短
	});










});

