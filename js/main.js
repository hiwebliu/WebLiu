$(function(){
	var before = $(document).scrollTop();// 滚动前
	$(document.body).scroll(function(){
		var after = $(document.body).scrollTop();// 滚动后
		if (after > 0) {
			$(document.body).addClass('hasscroll');
			$('.logoimg').attr('src','img/logo-dark.png');
		}else {
			$(document.body).removeClass('hasscroll');
			$('.logoimg').attr('src','img/logo.png');
		}
	});
});

