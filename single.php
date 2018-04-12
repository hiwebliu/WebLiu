<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="single_TopWrap">
	<div class="singlergba">

	<section class="article_titleWrap">
		<div class="container">
			<div class="article_title">
				<h1><?php the_title(); ?></h1>
				<p class="meta">
					<span class="time">
						<?php
						if(webliu_option('post_meta_date')){
								the_time('Y-n-j');
						} ?>
					</span>
					<span class="author">
						<?php
						if(webliu_option('post_meta_author')){
							echo '作者：' ;
							the_author_nickname();
						} ?>
					</span>
					<span class="view"><?php
					if(webliu_option('post_meta_pv')){
							post_views('浏览：', '次');
					} ?>
					</span>

					<span class="comments">
						<?php
						if(webliu_option('post_meta_com')){
							echo '评论：' ;
							$id=$post->ID; echo get_post($id)->comment_count;
							echo '次';
						} ?>
					</span>
					<span class="post_cat">
						<?php if (webliu_option('post_meta_cat')) {
						echo '分类：';
						post_cat();
					} ?>
					</span>
				</p>
			</div>
		</div>
	</section>
	</div>
	</div>

	<div class="wrapper">
		<section class="article_wrapper">
			<div class="container">
				<div class="ads_articleTop">
						<!-- <img src="images/1200-80.jpg"/> -->
				</div>

				<div class="article_left">

					<!--文章内容-->
					<section class="article_item article_content">
						<div class="breadcrumb">
							<?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
						</div>
						<!-- <a class="ad_postTop" href="#"><img src="img/ad_postTop900.jpg"></a> -->
						<?php the_content(); ?>
						<?php if (webliu_option('post_dashang_open')) { ?>
						<div class="post_function">
							<button class="webliubtn post_dashang"><i class="fa fa-dollar"></i>文章打赏
								<div class="tip_dashang">
									<h1>金额不限,谢谢打赏！</h1>
									<span class="code_dashang">
										<img src="<?php echo webliu_option('post_dashang_z'); ?>">
										<b>支付宝打赏</b>
									</span>
									<span class="code_dashang">
										<img src="<?php echo webliu_option('post_dashang_w'); ?>">
										<b>微信打赏</b>
									</span>
								</div>
							</button>
						</div>
						<?php } ?>
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

					<!--相关文章-->
					<section class="article_item wow fadeInUp article-related">
						<h3><?php echo webliu_option('post_related_title'); ?></h3>
						<ul>
							<?php
							$post_num = webliu_option('post_related_num');
							$exclude_id = $post->ID;
							$posttags = get_the_tags(); $i = 0;
							if ( $posttags ) {
								$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
								$args = array(
									'post_status' => 'publish',
									'tag__in' => explode(',', $tags),
									'post__not_in' => explode(',', $exclude_id),
									'caller_get_posts' => 1,
									'orderby' => 'comment_date',
									'posts_per_page' => $post_num,
								);
								query_posts($args);
								while( have_posts() ) { the_post(); ?>
									<li><a rel="bookmark" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
								<?php
									$exclude_id .= ',' . $post->ID; $i ++;
								} wp_reset_query();
							}
							if ( $i < $post_num ) {
								$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
								$args = array(
									'category__in' => explode(',', $cats),
									'post__not_in' => explode(',', $exclude_id),
									'caller_get_posts' => 1,
									'orderby' => 'comment_date',
									'posts_per_page' => $post_num - $i
								);
								query_posts($args);
								while( have_posts() ) { the_post(); ?>
									<li><a rel="bookmark" href="<?php the_permalink(); ?>"  title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
								<?php $i++;
								} wp_reset_query();
							}
							if ( $i  == 0 )  echo '<li>暂无相关文章!</li>';
							?>
						</ul>
					</section>
					<!-- 文章评论 -->
					<?php comments_template(); ?>
				</div>
				<?php get_sidebar('single'); ?>
			</div>
		</section>

	</div><!--wrapper end-->

<?php get_footer(); ?>
