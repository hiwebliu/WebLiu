<?php get_header(); ?>

<!-- Show Me -->
<div class="full_screen visual" style="background:url(<?php echo webliu_option('visualbg'); ?>;)">
	<section class="visual_content hide">
		<div class="showme_content wow bounceIn">
			<img class="trans_around1" src="<?php echo get_template_directory_uri() ?>/img/trbg1.png" />
			<img class="trans_around2" src="<?php echo get_template_directory_uri() ?>/img/trbg1.png" />
			<img class="showme_timg" src="<?php echo webliu_option('social_img'); ?>"/>
		</div>
	</section>

	<section class="showme_slogan hide">
		<div class="showme_sloganT wow bounceInLeft" data-wow-duration="3s">
			<h3><?php echo webliu_option('zbword1'); ?></h3>
		</div>
		<div class="showme_sloganT wow bounceInRight" data-wow-duration="4s">
			<h3><?php echo webliu_option('zbword2'); ?></h3>
		</div>
		<div class="showme_sloganName wow bounceInUp" data-wow-duration="5s">
			<?php echo webliu_option('zbword3'); ?>
		</div>
	</section>

	<section class="showme_btns hide">
		<?php echo webliu_option('visualbts'); ?>
	</section>
</div>

<!-- The New Theme -->
<?php include 'includes/newthemes.php' ?>


<!-- The Target -->
<div class="target">
	<div class="container">
		<h1 class="wow bounceInUp">网站制作 / Wordpress主题定制</h1>
		<p class="wow bounceInLeft">我们不做收费主题，因为我们始终贯彻<em>开源、免费、共享</em>的原则。</p>
		<p class="wow bounceInLeft">我们提供主题定制，给您一份只属于您自己的设计。</p>
		<section class="target_one wow bounceIn" data-wow-duration="2s">
			<i class="fa fa-pencil-square-o"></i>
			<h2>Ui设计</h2>
			<p>我们有多名优秀、具有成熟经验的设计师，可为您打造专属Ui设计。</p>
			<p class="target_price">998 + 元/套</p>
			<ul>
				<li>明确您的设计需求(Logo / 页面设计)</li>
				<li>提供多种设计方案</li>

			</ul>
			<button class="btn btn-danger">了解详情</button>
		</section>
		<section class="target_one wow bounceIn"  data-wow-duration="2.5">
			<i class="fa fa-wordpress"></i>
			<h2>主题定制</h2>
			<p>我们有多名优秀、具有成熟经验的设计师，可为您打造专属Ui设计。</p>
			<p class="target_price">3288 + 元/套</p>
			<ul>
				<li>明确您的设计需求(Logo / 页面设计)</li>
				<li>提供多种设计方案</li>
				<li>超长售后期限：1年</li>
			</ul>
			<button class="btn btn-danger">了解详情</button>
		</section>
		<section class="target_one wow bounceIn" data-wow-duration="3s">
			<i class="fa fa-internet-explorer"></i>
			<h2>仿站需求</h2>
			<p>我们有多名优秀、具有成熟经验的设计师，可为您打造专属Ui设计。</p>
			<p class="target_price">2288 元/套</p>
			<ul>
				<li>明确您的设计需求(Logo / 页面设计)</li>
				<li>提供多种设计方案</li>
				<li>超长售后期限：1年</li>
			</ul>
			<button class="btn btn-danger">了解详情</button>
		</section>
	</div>
</div>

<!-- The Course -->
<div class="course_wrap">
		<section class="course_box leftItem">
			<div class="course_content">
				<header class="course_slogan">
					<i class="fa fa-code"></i>
					<?php
						$catleftid = webliu_option('course_catleft');
						$catnum = webliu_option('course_catnum');
						echo get_cat_name( $catleftid );
					?>
				</header>
				<ul>
				<?php
					query_posts( array( 'cat'=>$catleftid, 'posts_per_page'=>$catnum, 'ignore_sticky_posts'=>true ) );
					while( have_posts() ): the_post();
				?>
				<li class="wow fadeInLeft">
				<a <?php echo post_blank(); ?> href="<?php the_permalink() ?>" rel="bookmark"  data-toggle="tooltip" title="<?php the_title_attribute(); ?>">
				<?php if (function_exists('wpjam_has_post_thumbnail') && wpjam_has_post_thumbnail()) { ?>
				<div class="coursePost_img">
					<?php wpjam_post_thumbnail(array(110,80),$crop=1);?>
				</div>
				<?php }else{ ?>
				<div class="coursePost_img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=80&w=110&zc=1"/>
				</div>
				<?php } ?>
				<h1 class="coursePost_title"><?php the_title_attribute(); ?></h1>
				<div class="coursePost_info">
					<span><?php echo the_time('Y.n.j'); ?></span>
					<span><?php echo post_views('', '(view)'); ?></span>
				</div>
				</a>
				</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
			</div>
		</section>
		<section class="course_box rightItem">
			<div class="course_content">
				<header class="course_slogan">
					<i class="fa fa-th-list"></i>
					<?php
						$catrightid = webliu_option('course_catright');
						$catnum = webliu_option('course_catnum');
						echo get_cat_name( $catrightid );
					?>
				</header>
				<ul>
				<?php
					query_posts( array( 'cat'=>$catrightid, 'posts_per_page'=>$catnum, 'ignore_sticky_posts'=>true ) );
					while( have_posts() ): the_post();
				?>
				<li class="wow fadeInRight" data-wow-delay="0.5s">
				<a <?php echo post_blank(); ?> href="<?php the_permalink() ?>" rel="bookmark"  data-toggle="tooltip" title="<?php the_title_attribute(); ?>">
				<?php if (function_exists('wpjam_has_post_thumbnail') && wpjam_has_post_thumbnail()) { ?>
				<div class="coursePost_img">
					<?php wpjam_post_thumbnail(array(110,80),$crop=1);?>
				</div>
				<?php }else{ ?>
				<div class="coursePost_img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=80&w=110&zc=1"/>
				</div>
				<?php } ?>
				<h1 class="coursePost_title"><?php the_title_attribute(); ?></h1>
				<div class="coursePost_info">
					<span><?php echo the_time('Y.n.j'); ?></span>
					<span><?php echo post_views('', '(view)'); ?></span>
				</div>
				</a>
				</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
			</div>
		</section>
		<section class="clear"></section>
</div>

<!-- MyDream -->
<div class="mydream">
	<div class="container">
		<section class="think_left">
			<h1 class="wow fadeInLeft" data-wow-duration="1s">
				<?php echo webliu_option('slogantitle'); ?>
			</h1>
			<p class="wow fadeInUp" data-wow-duration="2s">
				<?php echo webliu_option('slogantxt'); ?>
			</p>
		</section>
		<section class="think_right wow fadeInUp" data-wow-duration="2s">
			<?php if (webliu_option('sloganlink')) { ?>
				<a href="<?php echo webliu_option('sloganlink') ?>" target="_blank">
					<i class="fa fa-qq"></i>
					<?php echo webliu_option('sloganlinktxt') ?>
				</a>
			<?php } ?>
			<p><?php echo webliu_option('sloganremark') ?></p>
		</section>
	</div>
</div>

<?php get_footer(); ?>
