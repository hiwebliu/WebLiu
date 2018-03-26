<?php 
if ( is_home() || is_page() || is_search() ) {
    $keywords = webliu_option('keywords');
    $description = webliu_option('description');
}
elseif (is_single()) {   
    $description1 = get_post_meta($post->ID, "description", true);   
    $description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");   
    
    // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述   
    $description = $description1 ? $description1 : $description2;   
      
    // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词   
    $keywords = get_post_meta($post->ID, "keywords", true);   
    if($keywords == '') {   
        $tags = wp_get_post_tags($post->ID);       
        foreach ($tags as $tag ) {           
            $keywords = $keywords . $tag->name . ", ";       
        }   
        $keywords = rtrim($keywords, ', ');   
    }
}
elseif (is_category()) {   
    $description = category_description();   
    $keywords = single_cat_title('', false);   
}   
elseif (is_tag()){   
    $description = tag_description();   
    $keywords = single_tag_title('', false);   
}   
$description = trim(strip_tags($description));   
$keywords = trim(strip_tags($keywords));   
$ljf = webliu_option('title_connector');
?>   
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?><?php echo $ljf; ?><?php echo $description; ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果<?php echo $ljf; ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php echo $ljf; ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php echo $ljf; ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?><?php echo $ljf; ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?><?php echo $ljf; ?><?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php single_tag_title("", true); ?><?php echo $ljf; ?><?php bloginfo('name'); ?></title><?php }?> <?php } ?>

