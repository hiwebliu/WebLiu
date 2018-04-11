<aside class="sidebar wow showlater">
<section class="user_sidebar wow fadeInRight">
	<p class="user_img">
		<a href="#" title="前端刘"><img src="<?php echo webliu_option('social_img'); ?>"></a>
	</p>
	<p class="user_name">
		<a href="#"><?php echo webliu_option('social_name'); ?></a>
		<?php echo webliu_option('social_skill'); ?>
	</p>
	<p class="user_introduce"><?php echo webliu_option('social_word'); ?></p>
	<?php if (webliu_option('social_links_open')) { ?>
		<?php include 'includes/social.php' ?>
	<?php } ?>
	<div class="user_num">
		<div class="postNum"><em>文章数</em><b>
			<?php echo count_user_posts('1','post',false); ?>
		</b></div>
		<div class="comNum"><em>评论数</em><b>
			<?php
			echo get_comments('count=true&user_id=1');
			?>
		</b></div>
	</div>
</section>
<?php
if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sitesidebar')) : endif;

if (is_single()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_postsidebar')) : endif;
}
else if (is_page()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_pagesidebar')) : endif;
}
else if (is_home()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_indexsidebar')) : endif;
}
else {
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_othersidebar')) : endif;
}
?>
</aside>
