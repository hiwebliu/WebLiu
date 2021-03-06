<?php get_header();
$description = trim(strip_tags(category_description()));
?>

	<div class="wrapper">
		<section class="article_wrapper">
			<div class="container">
			<div class="article_left">
				<div class="cat-info fadeInUp animated" data-wow-duration="2s" data-wow-delay="5s">
					<h1 class="cat-title">
						<i class="fa fa-folder-open"></i>分类：<?php single_cat_title(); echo $pagedtext; ?>
					</h1>
					<div class="cat-desc"><?php echo $description ? $description : '去分类设置中添加分类描述吧' ?></div>
				</div>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="article fadeInUp wow">
					<div class="article_contentbox">
						<?php if (function_exists('wpjam_has_post_thumbnail') && wpjam_has_post_thumbnail()) { ?>
						<div class="post-img">
							<a <?php echo post_blank(); ?> href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php wpjam_post_thumbnail(array(220,150),$crop=1);?>
							</a>
						</div>
						<?php }else{ ?>
						<div class="post-img">
							<a <?php echo post_blank(); ?> href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=150&w=220&zc=1" alt="<?php the_title(); ?>"/>
							</a>
						</div>
						<?php } ?>
						<div class="post-abstract">
							<h2><a class="post_ttle" <?php echo post_blank(); ?> href="<?php the_permalink(); ?>" rel="bookmark" data-toggle="tooltip" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

							<div class="note">
								<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); ?>
							</div>
						</div>
					</div>
					<p class="post_meta">
						<span><i class="fa fa-clock-o"></i><?php the_time('Y-n-j') ?></span>
						<span class="pv"><i class="fa fa-eye"></i><?php post_views('', '(浏览)'); ?></span>
						<span><i class="fa fa-comments-o"></i><?php if(function_exists('the_views')) { the_views(); } ?><?php comments_number('0(评论)', '1(评论)', '%(评论)' );?></span>
					</p>
				</article>

				<?php endwhile; ?>
				<?php else : ?>
	        		<div class="cat-nopost fadeInUp animated">抱歉，暂无相关文章！</div>
				<?php endif; ?>
				<div class="page_navi animated"><?php par_pagenavi(9); ?></div>
			</div>
			<?php get_sidebar(); ?>
			</div>
		</section>

	</div><!--wrapper end-->
<?php get_footer(); ?>
