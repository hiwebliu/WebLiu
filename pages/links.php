<?php
/*
	template name: 友情链接
*/
get_header();?>
<div class="container">
<div class="pagewrapper">
	<aside class="pagesidebar">
		<ul class="pagesider-menu">
		<?php
		echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'page-menu', 'echo' => false))));
		?>
		</ul>
	</aside>
	<div class="pagecontent">
	<div class="page_mainbox">
		<header class="pageheader">
			<h1 class="page_title">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
		</header>
		<?php while (have_posts()) : the_post(); ?>
			<article class="article-content">
				<?php the_content(); ?>
			</article>
			<?php
			$bookmarks = get_bookmarks();
			if ( !empty($bookmarks) ){
			    echo '<ul class="link-content">';
			    foreach ($bookmarks as $bookmark) {
			        echo '<li><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><img src="' . $bookmark->link_url . '/favicon.ico"/><span class="sitename">'. $bookmark->link_name .'</span></a></li>';
			    }
			    echo '</ul>';
			}
			?>
		</div>
			<?php comments_template('', true); ?>

		<?php endwhile;  ?>
	</div>
</div>
</div>
<?php get_footer(); ?>
