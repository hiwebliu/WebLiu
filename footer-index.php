	<!-- The FrindsLink -->
	<div class="links wow fadeInUp">
		<div class="container">
			<h3 class="links-title"><i class="fa fa-gg"></i> 友情链接</h3>
			<ul>
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			</ul>
		</div>
	</div>

	<!-- 网站底部 -->
	<footer class="footer wow fadeInUp">
	<div class="container">
		<section class="aboutsite">
			<h3><i class="fa fa-info-circle"></i> 关于本站</h3>
			<p><?php echo webliu_option('foot_about'); ?></p>
		</section>
		<section class="foottags">
			<h3><i class="fa fa-tags"></i> 标签</h3>
			<div class="tags">
				<?php
				wp_tag_cloud('smallest=12&largest=12&unit=px&number='.webliu_option('foot_tags_num').'');
				?>
			<div>
		</section>
		<div class="cl"></div>
	</div>
	</footer>

	<div class="footcopy wow fadeInUp">
		<div class="menu-footer_menu-container">
			<?php wp_nav_menu(array('theme_location'=>'footer-menu','menu' => 'footer-menu')); ?>
		</div>
		<section class="footcopy-word">
			<?php echo webliu_option('foot_seo'); ?>
			<?php foot_tj_code(); ?>
		</section>
</div>

	<div class="gotop">
		<a id="test"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	</div>

	<!-- The Search -->
	<div class="search_wrap">
		<div class="search_content">
			<section class="search_form">
				<form id="NewsSearchForm" name="NewsSearchForm" method="get"  action="<?php echo home_url( '/' ); ?>" target="_blank">
					<input class="searchInput" name="s" type="text" placeholder="请输入关键字" required>
					<button type="submit" class="searchButton"><i class="iconfont icon-search" data-toggle="tooltip" title="搜索"></i></button>
				</form>
			</section>
		</div>
		<div class="search_close"><i class="iconfont icon-close" data-toggle="tooltip" title="关闭"></i></div>
	</div>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/wow.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/main.js"></script>
</body>
</html>
