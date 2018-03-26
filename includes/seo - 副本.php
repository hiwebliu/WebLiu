<?php 
if ( is_home() || is_page() ) { ?>
<meta name="description" content="<?php echo wpztw_option('description'); ?>" />
<meta name="keywords" content="<?php echo wpztw_option('keywords'); ?>" />
<title><?php bloginfo('name'); ?></title><?php } ?>
<?php if (is_single()) {   
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
?>   
<meta name="description" content="<?php echo $description; ?>" />   
<meta name="keywords" content="<?php echo $keywords; ?>" />  