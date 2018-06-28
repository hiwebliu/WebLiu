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
			<h1 class="title wow fadeInUp">我们能做的，不止是模板</h1>
			<p class="title-subtitle wow fadeInUp">你要做的，只是提出要求</p>
			<div class="container">
				<article class="col-md-3 col-xs-6 service-item wow fadeIn" data-wow-delay="0.5s">
					<i class="iconfont icon-sheji"></i>
					<h3>UI设计</h3>
					<p>我们有多名具有成熟经验的设计师，可为您打造专属Ui设计。</p>
				</article>
				<article class="col-md-3 col-xs-6 service-item wow fadeIn" data-wow-delay="1s">
					<i class="iconfont icon-vip"></i>
					<h3>主题定制</h3>
					<p>根据您的需求，为您量身定制私人专属的WordPress主题。</p>
				</article>
				<article class="col-md-3 col-xs-6 service-item wow fadeIn" data-wow-delay="1.5s">
					<i class="iconfont icon-fangzhan"></i>
					<h3>完美仿站</h3>
					<p>提供您中意的目标站，我们给您一份1:1完美作品。</p>
				</article>
				<article class="col-md-3 col-xs-6 service-item wow fadeIn" data-wow-delay="2s">
					<i class="iconfont icon-fuwuqi"></i>
					<h3>环境搭建</h3>
					<p>快速帮您搭建你需要的站点服务器环境，解决网站运行错误问题。</p>
				</article>
			</div>
		</div>
		<div class="webliu-afterSale">
			<h1 class="title wow fadeInUp">优质的售后服务</h1>
			<p class="title-subtitle wow fadeInUp">纯人工在线交流服务</p>
			<div class="container">
				<article class="col-md-4 col-xs-12 service-item wow fadeIn" data-wow-delay="0.5s">
					<i class="iconfont icon-zhidao"></i>
					<h3>操作指导</h3>
					<p>后台或主题不知如何使用?</p>
					<p>我们提供详细的后台操作以及主题设置教程</p>
				</article>
				<article class="col-md-4 col-xs-12 service-item wow fadeIn" data-wow-delay="1s">
					<i class="iconfont icon-shengji"></i>
					<h3>版本升级</h3>
					<p>怕WP升级造成主题不兼容？</p>
					<p>所有模板提供为期一年的免费维修服务</p>
				</article>
				<article class="col-md-4 col-xs-12 service-item wow fadeIn" data-wow-delay="1.5s">
					<i class="iconfont icon-kefu"></i>
					<h3>技术支持</h3>
					<p>网站出现故障？</p>
					<p>任何问题可随时联系我们提供技术支持</p>
				</article>
			</div>
		</div>
		<div class="webliu-position">
			<iframe src="<?php echo get_stylesheet_directory_uri() ?>/myposition.html"></iframe>

		</div>
	</div><!--wrapper end-->
<?php get_footer(); ?>
