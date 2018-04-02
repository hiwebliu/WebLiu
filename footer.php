
	<footer class="footcopy wow fadeInUp">
		<div class="menu-footer_menu-container">
			<?php wp_nav_menu(array('theme_location'=>'footer-menu','menu' => 'footer-menu')); ?>
		</div>
		<section class="footcopy-word">
			<?php echo webliu_option('foot_seo'); ?>
			<?php foot_tj_code(); ?>
		</section>
</footer>

	<div class="gotop">
		<a id="test"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	</div>

	<!-- The Search -->
	<div class="search_wrap">
		<div class="search_content">
			<section class="search_title">
				<i class="fa fa-search"></i>少说话，多动手
			</section>
			<section class="search_form">
				<form id="NewsSearchForm" name="NewsSearchForm" method="get" action="" target="_blank">
					<input name="q" type="text" placeholder="请输入关键字"> <input type="hidden" name="s">
					<button class="btn btn-default" type="button">搜索</button>
				</form>
			</section>
		</div>
		<div class="search_close"><i class="fa fa-remove"  data-toggle="tooltip" title="关闭"></i></div>
	</div>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/bootstrap.min.js"></script>
<?php if(webliu_option('prism_open')) { ?>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/prism.js"></script>
<?php } ?>
<?php if(webliu_option('fancybox_open')) { ?>
<script src="<?php echo get_stylesheet_directory_uri() ?>/fancybox/fancybox.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>
<?php } ?>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/wow.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/main.js"></script>
</body>
</html>
