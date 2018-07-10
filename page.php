<?php
/*
    template name: 默认模板
*/
get_header();?>
<div class="container">
<div class="pagewrapper cl">
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
