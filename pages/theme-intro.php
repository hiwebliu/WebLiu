<?php
/*
    template name: 主题简介页面
    description: 本页面提供主题的简介、下载链接、主题预览图等
*/
get_header();
?>

	<div class="wrapper">
		<div class="theme-intro">
			<h1 class="theme-introTitle wow fadeInUp"><?php the_title(); ?></h1>
			<?php while (have_posts()) : the_post(); ?>
                <div class=" wow fadeInUp">
                	<?php the_content(); ?>
                </div>
	        <?php endwhile;  ?>
		</div>
		<div class="webliu-service">
			<h1 class="theme-introTitle wow fadeInUp">我们提供的不止模板</h1>
			<i class="iconfont icon-fuwuqizu_hover"></i>
			<i class="iconfont icon-jiemiansheji"></i>
			<i class="iconfont icon-kaifa"></i>
			<i class="iconfont icon-liulanqi"></i>
		</div>
	</div><!--wrapper end-->
<?php get_footer(); ?>
