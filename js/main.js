var logo1 = $('.logo a').css('background-image');
var logo2 = $('.logoscrool').attr('data-url');

// 页面滚动切换logo效果
var changeLogo = function() {
	$('.logopng').addClass('hide');
	$('.logogif').removeClass('hide');
};
var returnLogo = function() {
	$('.logopng').removeClass('hide');
	$('.logogif').addClass('hide');
};
// 首页滚动效果
var scrollEffect = function() {
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
			changeLogo();
			}else {
				$(document.body).removeClass('hasscroll');
				returnLogo();
			}
			// 文章页头部滚动
			if($(window).scrollTop()>0){
				$(".header").addClass('shasscroll');
				changeLogo();
			}else {
				$(".header").removeClass('shasscroll');
				returnLogo();
			}
		}else {
			changeLogo();
		}
	});
};
// 社交信息填色
var soicalColor = function() {
	$('.user_sidebar .user_name .fa:eq(0)').addClass('red');
	$('.user_sidebar .user_name .fa:eq(1)').addClass('black');
	$('.user_sidebar .user_name .fa:eq(2)').addClass('blue');
	$('.user_sidebar .user_name .fa:eq(3)').addClass('green');
	$('.user_sidebar .user_name .fa').attr('data-toggle','tooltip');
};
// 文章高度一致
var setCourseHeight = function() {
	var _heightL = $('.leftItem').height();
	var _heightR = $('.rightItem').height();
	if (_heightL > _heightR) {
		$('.rightItem .course_content').css('height',_heightL);
	}else {
		$('.leftItem .course_content').css('height',_heightR);
	}
};

$(function(){
	$('.wow').removeClass('showlater');
	$('.wow').css('display','block');
	scrollEffect();
	soicalColor();
	setCourseHeight();
	// 手机端显示隐藏导航菜单
	$("#mobile_nav").click(function(){
		if ($('#webliu').hasClass('open')) {
			$('#webliu').removeClass('open');
		}else{
			$('#webliu').addClass('open');
		}
	});
	// 搜索功能显示、隐藏
	$('.search_show').click(function(){
		var scrollTop = $(window).scrollTop();
		$('.search_wrap').css('top',scrollTop);
		$('.search_wrap').show(500,function(){
			$('body').css('overflow-y','hidden');
		});
	});
	$('.search_close').click(function(){
		$('.search_wrap').hide(300);
		$('body').css('overflow-y','auto');

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
	// 激活Tips效果
	$('[data-toggle="tooltip"]').tooltip();

	// wow效果
	var wow = new WOW({
	boxClass: 'wow',
	animateClass: 'animated',
	offset: 0,
	mobile: true,
	live: true
	});
	wow.init();

	// 文章归档列表收起展开
	$('.al_mon').click(function(){
		let shows = $('+' + '.al_post_list',this).css('display');
		if (shows == 'none') {
			$('+' + '.al_post_list',this).show(500);
		}else {
			$('+' + '.al_post_list',this).hide(500);
		}
	});

	$('#al_expand_collapse').click(function(){
		$('#archives .al_post_list').hide(500);
	});
});
