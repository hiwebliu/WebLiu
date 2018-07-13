<?php ?>


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
			<section class="search_form">
				<form id="NewsSearchForm" name="NewsSearchForm" method="get"  action="<?php echo home_url( '/' ); ?>" target="_blank">
					<input class="searchInput" name="s" type="text" placeholder="请输入关键字">
					<input class="searchButton" type="submit" value="搜索" />
				</form>
			</section>
			<section>
				<ul>
					<?php
					$args = array( 'numberposts' => 10, 'orderby' => 'rand', 'post_status' => 'publish' );
					$rand_posts = get_posts( $args );
					foreach( $rand_posts as $post ) : ?>
					    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; ?>
					</ul>
			</section>
		</div>
		<div class="search_close"><i class="iconfont icon-close" data-toggle="tooltip" title="关闭"></i></div>
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



<?php wp_footer(); ?>
</body>
</html>
