<?php
/*
 	template name: 标签云
 	description: template for Git theme
*/
get_header();?>
<div class="container">
	<div class="pagewrapper cl">
		<aside class="pagesidebar">
			<ul class="pagesider-menu">
				<?php
				echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'page-menu', 'echo' => false))));?>
			</ul>
		</aside>
		<div class="pagecontent">
			<div class="page_mainbox">
				<header class="pageheader cl">
					<h1 class="page_title">
						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</h1>
				</header>
				<ul class="tag-clouds">
					<?php $tags_list = get_tags('orderby=count&order=DESC');
					if ($tags_list) {
					foreach($tags_list as $tag) {
						echo '<li><a class="btn btn-mini" href="'.get_tag_link($tag).'">'. $tag->name .'</a><strong>x '. $tag->count .'</strong><br>';
						echo '</li>';
					}
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
