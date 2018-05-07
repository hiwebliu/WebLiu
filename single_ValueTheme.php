<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="wrapper">
		<section class="article_wrapper">
			<div class="container">
				<div class="article_left">

					<section class="article_item article_content">
						<div class="valuetheme-title">
							<h1 class="theme-title"><?php the_title(); ?></h1>
							<p class="meta">
								<span><?php echo the_time('Y-n-j'); ?></span>
								<span><?php echo the_author_nickname(); ?></span>
								<span><?php echo post_views('<i class="fa fa-eye"></i>', '次'); ?></span>
							</p>
						</div>

						<?php the_content(); ?>
						<p class="article_tags">
						<span class="webliuicon"><i class="fa fa-tags"></i>标签：</span>
						<?php
							$category = get_the_category();
							if($category[0]){
							echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
							}
						?>
				</p>
					</section>
				<?php endwhile; ?>
				<?php else : ?>
					<h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
							<p>没有找到任何文章！</p>
				<?php endif; ?>
				</div>
				<aside class="sidebar wow showlater">
					<section class="valuetheme-info widget wow fadeInRight">
						<ul>
							<li><span>最新版本</span><?php echo get_post_meta($post->ID,"latest-version",$single = true); ?></li>
							<li><span>发布日期</span><?php echo get_post_meta($post->ID,"release-date",$single = true); ?></li>
							<li><span>上次更新</span><?php echo get_post_meta($post->ID,"update-date",$single = true); ?></li>
							<li><span>WP版本</span><?php echo get_post_meta($post->ID,"wp-version",$single = true); ?></li>
							<li><span>PHP版本</span><?php echo get_post_meta($post->ID,"php-version",$single = true); ?></li>
							<li><span>兼容说明</span><?php echo get_post_meta($post->ID,"browser-version",$single = true); ?></li>
							<li><span>其他描述</span><?php echo get_post_meta($post->ID,"theme-desc",$single = true); ?></li>
						</ul>
					</section>
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
				</aside>
			</div>
		</section>

	</div><!--wrapper end-->

<?php get_footer(); ?>
