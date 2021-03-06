<?php
/*
    template name: 空页面(带有左侧菜单)
*/
get_header();?>
<div class="container">
<div class="pagewrapper cl">
    <aside class="pagesidebar">
        <ul class="pagesider-menu">
        <?php
        echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'page-menu', 'echo' => false))));
        ?>
        </ul>
    </aside>
    <div class="pagecontent">
    <div class="page_mainbox">
        <header class="pageheader cl">
            <h1 class="page_title">
                <?php the_title(); ?>
            </h1>
        </header>
        <?php while (have_posts()) : the_post(); ?>
            <article class="article-content">
                <?php the_content(); ?>
            </article>
        </div>
        <?php endwhile;  ?>
    </div>
</div>
<div class="cl"></div>
</div>
<?php get_footer(); ?>
