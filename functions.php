<?php

// 加载主题框架 
if ( !function_exists( 'optionsframework_init' ) ) {
  define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
  require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
add_action('optionsframework_custom_scripts', 'foot_tj_code');
function foot_tj_code(){ 
  if (webliu_option('foot_tj')) {
    echo '<script>';
    echo webliu_option('foot_tj');
    echo '</script>';
  }
}

// 自定义主题设置及路径
function prefix_options_menu_filter( $menu ) {
  $menu['mode'] = 'menu';
  $menu['page_title'] = 'WPOne 主题设置';
  $menu['menu_title'] = 'WPOne 主题设置';
  $menu['menu_slug'] = 'wpone-options';
  return $menu;
}
add_filter( 'optionsframework_menu', 'prefix_options_menu_filter' );




// ***************************************** 以下是WPOne主题添加的功能 *****************************************
include ('inc/theme-widgets.php');
// 注册小工具
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '全站侧栏',
        'id' => 'widget_sitesidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h2>',
        'after_title' => '</h2></div>'
    ));
    register_sidebar(array(
        'name' => '首页侧栏',
        'id' => 'widget_indexsidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h2>',
        'after_title' => '</h2></div>'
    ));
    register_sidebar(array(
        'name' => '分类/标签/搜索页侧栏',
        'id' => 'widget_othersidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h2>',
        'after_title' => '</h2></div>'
    ));
    register_sidebar(array(
        'name' => '文章页侧栏',
        'id' => 'widget_postsidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h2>',
        'after_title' => '</h2></div>'
    ));
    register_sidebar(array(
        'name' => '页面侧栏',
        'id' => 'widget_pagesidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h2>',
        'after_title' => '</h2></div>'
    ));
}








//激活友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
//添加后台左下角文字
function git_admin_footer_text($text) {
    $text = '感谢使用<a target="_blank" href=http://wpztw.com/ >WPOne主题</a>，更多wordpress主题请关注<a target="_blank" href=http://wpztw.com/ >WP主题网</a>';
    return $text;
}
// 禁止自动保存和修订版本
if (webliu_option('post_autosave')) {
    add_action('wp_print_scripts', 'deel_disable_autosave');
    remove_action('pre_post_update', 'wp_save_post_revision');
}
add_filter('admin_footer_text', 'git_admin_footer_text');

//注册菜单
if(function_exists('register_nav_menus')){  
register_nav_menus(  
  array(  
  'header-menu' => __( '顶部导航' ),  
  'footer-menu' => __( '底部导航' ),
  'page-menu' => __( 'Page页面导航' ),  
  )  
);  
}  

//移除菜单li多余class
add_filter('nav_menu_css_class', 'delete_menu_more_class', 100, 1);
add_filter('nav_menu_item_id', 'delete_menu_more_class', 100, 1);
add_filter('page_css_class', 'delete_menu_more_class', 100, 1);
function delete_menu_more_class($var) {
   return is_array($var) ? array_intersect($var, array('menu-item','current-menu-item','current-post-parent','menu-item-has-children')) : '';
}


/* 访问计数 */
function record_visitors()
{
  if (is_singular())
  {
    global $post;
    $post_ID = $post->ID;
    if($post_ID)
    {
      $post_views = (int)get_post_meta($post_ID, 'views', true);
      if(!update_post_meta($post_ID, 'views', ($post_views+1)))
      {
      add_post_meta($post_ID, 'views', 1, true);
      }
    }
  }
}
add_action('wp_head', 'record_visitors');
 
/// 函数名称：post_views
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}

// 文章分页导航
function par_pagenavi($range = 9){
  global $paged, $wp_query;
  if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
  if($max_page > 1){if(!$paged){$paged = 1;}
  if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
  previous_posts_link(' 上一页 ');
    if($max_page > $range){
    if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
    for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
  elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
    for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
  next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
}


//文章翻页
function pagination($query_string){   
global $posts_per_page, $paged;   
$my_query = new WP_Query($query_string ."&posts_per_page=-1");   
$total_posts = $my_query->post_count;   
if(empty($paged))$paged = 1;   
$prev = $paged - 1;   
$next = $paged + 1;   
$range = 2; // only edit this if you want to show more page-links   
$showitems = ($range * 2)+1;   
  
$pages = ceil($total_posts/$posts_per_page);   
if(1 != $pages){   
echo "<div class='pagination'>";   
echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>第一页</a>":"";   
echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>上一页</a>":"";   
  
for ($i=1; $i <= $pages; $i++){   
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){   
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";   
}   
}   
  
echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>下一页</a>" :"";   
echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>最后一页</a>":"";   
echo "</div>\n";   
}   
} 


//添加自定义高亮代码按钮
add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');
function bolo_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
QTags.addButton( 'mycode', '插入高亮代码', ''+
'<pre class="line-numbers language-php">'+
'<code class="language-php">'+
'这里输入你的代码'+
'</code></pre>\n', "" );
</script>
<?php
}

// 文章目录功能
if(webliu_option('postcat_open')):
function article_index($content) {
   $matches = array();
   $ul_li = '';
   $r = "/<h3>([^<]+)<\/h3>/im";
   if(is_singular() && preg_match_all($r, $content, $matches)) {
      foreach($matches[1] as $num => $title) {
         $title = trim(strip_tags($title));
         $content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
         $ul_li .= '<li><a target="_self" href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
      }
      $content = "\n<div id=\"article-index\">
                     <strong>文章目录</strong>
                     <ul id=\"index-ul\">\n" . $ul_li . "</ul>
                  </div>\n" . $content;
   }
   return $content;
}
add_filter( 'the_content', 'article_index' );
endif;







//图片img和a链接自动添加alt，title属性
if(webliu_option('post_img_auto_title')):
function imagesalt($content) {
       global $post;
       $pattern ="/<img(.*?)src=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<img$1src=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
add_filter('the_content', 'imagesalt');
function aimagesalt($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
add_filter('the_content', 'aimagesalt');
endif;

//文章和评论外链自动nofolow
if(webliu_option('post_auto_nofollow')):
function git_auto_nofollow( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {

            $srcUrl = get_option('siteurl');
            for ($i=0; $i < count($matches); $i++)
            {
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
                $noFollow = '';
                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' target="_blank" ';
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' rel="nofollow" ';
                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}
add_filter( 'the_content', 'git_auto_nofollow');
endif;


//百度主动推送
if(!function_exists('Baidu_Submit') && webliu_option('post_sitemap_api_open') ){
    function Baidu_Submit($post_ID) {
        if(get_post_meta($post_ID,'wpztw_baidu_submit',true) == 1) return;
        $url = get_permalink($post_ID);
        $api = webliu_option('post_sitemap_api');
        $request = new WP_Http;
        $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
        $result = json_decode($result['body'],true);
        if (array_key_exists('success',$result)) {
            add_post_meta($post_ID, 'wpztw_baidu_submit', 1, true);
        }
    }
    add_action('publish_post', 'Baidu_Submit', 0);
}

//添加文章版权信息
if(webliu_option('post_copyright_open')):
function wpztw_copyright($content ) {
    if (is_single() || is_feed()) {
    $copyright = str_replace(array('{{title}}', '{{link}}'), array(get_the_title(), get_permalink()), stripslashes(webliu_option('post_copyright')));
        $content.= '<div class="post_copyright">' . $copyright . '</div>';
    }
    return $content;
}
add_filter('the_content', 'wpztw_copyright');
endif;

// 验证百度是否收录功能
function baidu_check($url, $post_id){
    $baidu_record  = get_post_meta($post_id,'baidu_record',true);
    if( $baidu_record != 1){
        $url='http://www.baidu.com/s?wd='.$url;
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $rs=curl_exec($curl);
        curl_close($curl);
        if(!strpos($rs,'没有找到该URL。您可以直接访问') && !strpos($rs,'很抱歉，没有找到与') ){
            update_post_meta($post_id, 'baidu_record', 1) || add_post_meta($post_id, 'baidu_record', 1, true);
            return 1;
        } else {
            return 0;
        }
    } else {
       return 1;
    }
}
// 文章分类 获取第一个分类和链接
function post_cat(){
  $category = get_the_category();
  if($category[0]){
  echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
  }
}

function baidu_record() {
    global $wpdb;
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    if(baidu_check(get_permalink($post_id), $post_id ) == 1) {
        echo '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd='.get_the_title().'">百度已收录</a>';
   } else {
        echo '<a style="color:#FF7200;" rel="external nofollow" title="点击提交，谢谢您！" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename='.get_permalink().'">百度未收录</a>';
   }
}

// 自动缩略图 如果没有输出随机图片
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
 
function post_thumbnail_src(){
  global $post;
  if( $values = get_post_custom_values("thumb") ) { //输出自定义域图片地址
    $values = get_post_custom_values("thumb");
    $post_thumbnail_src = $values [0];
  } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
    $post_thumbnail_src = $thumbnail_src [0];
    } else {
    $post_thumbnail_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
    if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
      $random = mt_rand(1, 10);
      echo get_bloginfo('template_url');
      echo '/img/pic/'.$random.'.jpg';
    }
  };
  echo $post_thumbnail_src;
}

//首页隐藏一些分类
function exclude_category_home($query) {
    if ($query->is_home) {
        $query->set('cat', '' . webliu_option('hidden_category') . ''); //隐藏这两个分类
    }
    return $query;
}
add_filter('pre_get_posts', 'exclude_category_home');


// 搜索结果排除所有页面
function search_filter_page($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'search_filter_page');

//移除自动保存
function deel_disable_autosave() {
    wp_deregister_script('autosave');
}

/*
 * 强制阻止WordPress代码转义，关于代码高亮可以看这里http://googlo.me/2986.html
*/
function git_esc_html($content) {
    $regex = '/(<pre\s+[^>]*?class\s*?=\s*?[",\'].*?prettyprint.*?[",\'].*?>)(.*?)(<\/pre>)/sim';
    return preg_replace_callback($regex, git_esc_callback, $content);
}
function git_esc_callback($matches) {
    $tag_open = $matches[1];
    $content = $matches[2];
    $tag_close = $matches[3];
    //$content = htmlspecialchars($content, ENT_NOQUOTES, get_bloginfo('charset'));
    $content = esc_html($content);
    return $tag_open . $content . $tag_close;
}
add_filter('the_content', 'git_esc_html', 2);
add_filter('comment_text', 'git_esc_html', 2);



//管理后台添加按钮
function git_custom_adminbar_menu($meta = TRUE) {
    global $wp_admin_bar;
    if (!is_user_logged_in()) {
        return;
    }
    if (!is_super_admin() || !is_admin_bar_showing()) {
        return;
    }
    $wp_admin_bar->add_menu(array(
        'id' => 'git_guide',
        'title' => 'WPOne主题使用文档', /* 设置链接名 */
        'href' => '#', /* 设置链接地址 */
        'meta' => array(
            target => '_blank'
        )
    ));
}
add_action('admin_bar_menu', 'git_custom_adminbar_menu', 100);

//保护后台登录
if(webliu_option('admin_login_open')):
function git_login_protection() {
    if ($_GET[''.webliu_option('admin_login_q').''] !== ''.webliu_option('admin_login_a').'')
    header('Location: '.webliu_option('admin_login_j').'');
}
add_action('login_enqueue_scripts', 'git_login_protection');
endif;

// 评论添加@，来自：http://www.ludou.org/wordpress-comment-reply-add-at.html
function git_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }

  return $comment_text;
}
add_filter( 'comment_text' , 'git_comment_add_at', 20, 2);

//登录失败提醒
function git_login_failed_notify()
{
    date_default_timezone_set('PRC');
    $admin_email = get_bloginfo ('admin_email');
    $to = $admin_email;
  $subject = '您的网站登录错误警告';
  $message = '<p>您好！您的网站(' . get_option("blogname") . ')有登录错误！</p>' .
  '<p>请确定是您自己的登录失误，以防别人攻击！登录信息如下：</p>' .
  '<p>登录名：' . $_POST['log'] . '</p>' .
  '<p>登录密码：' . $_POST['pwd'] .  '</p>' .
  '<p>登录时间：' . date("Y-m-d H:i:s") .  '</p>' .
  '<p>登录IP：' . $_SERVER['REMOTE_ADDR'] . '</p>' .
  '<p style="float:right">————本邮件由WPOne主题发送，无需回复</p>';
  $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
  $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
  $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
  wp_mail( $to, $subject, $message, $headers );
}
add_action('wp_login_failed', 'git_login_failed_notify');

// 移除css及js后面的版本信息
if(webliu_option('delete_jquery_v')):
function _remove_script_version( $src ){
  $parts = explode( '?ver', $src );
        return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
endif;



// 头像获取方式
if( !webliu_option('gravatar_url') || webliu_option('gravatar_url') == 'ssl' ){
    add_filter('get_avatar', '_get_ssl2_avatar');
}else if( webliu_option('gravatar_url') == 'duoshuo' ){
    add_filter('get_avatar', '_duoshuo_get_avatar', 10, 3);
}
//官方Gravatar头像调用ssl头像链接
function _get_ssl2_avatar($avatar) {
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="https://secure.gravatar.com/avatar/$1" class="avatar avatar-$2" height="$2" width="$2">', $avatar);
    return $avatar;
}
//多说官方Gravatar头像调用
function _duoshuo_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "gravatar.duoshuo.com", $avatar);
    return $avatar;
}

// 新窗口打开文章
function post_blank(){
    return webliu_option('post_blank') ? ' target="_blank"' : '';
}

// 外链自动go跳转
if(webliu_option('post_gourl')):
function git_go_url($content){
  preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$content,$matches);
  if($matches && !is_page('about')){
    foreach($matches[2] as $val){
      if(strpos($val,'://')!==false && strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val)){
               $content=str_replace("href=\"$val\"", "href=\"".home_url()."/go/?url=$val\" ",$content);
      }
    }
  }
  return $content;
}
add_filter('the_content','git_go_url',999);
endif;

// 自定义评论默认头像
function deel_avatar_default() {
    return get_template_directory_uri() . '/img/avatar-default.png';
}

// 开启GZip压缩
if (webliu_option('gzip_open')):
function gzippy() {
ob_start('ob_gzhandler');
}
if(!stristr($_SERVER['REQUEST_URI'], 'tinymce') && !ini_get('zlib.output_compression')) {
add_action('init', 'gzippy');
}
endif;

// 评论样式
function aurelius_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
  <li class="comment" id="li-comment-<?php comment_ID(); ?>">
      <div class="comment-gravatar"> <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
      </div>
      <div class="comment-content" id="comment-<?php comment_ID(); ?>">   
        <div class="comment-info">
          <?php printf(__('<span class="comment-author">%s</span>'), get_comment_author_link()); ?>
          <span class="comment-time"><?php echo get_comment_time('Y-m-d H:i'); ?></span>
          <?php if($comment->user_id == 1){ echo '<span class="admin-author">站长</span>'; } ?>
          <div class="comment_reply">
            <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
          </div>
        </div>
        <div class="comment-text">
        <?php if ($comment->comment_approved == '0') : ?>
            <em>你的评论正在审核，稍后会显示出来！</em><br />
        <?php endif; ?>
        <?php comment_text(); ?>
        </div>
      </div>
<?php }
        

//时间显示方式‘xx以前’
function time_ago($type = 'commennt', $day = 7) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    if (time() - $d('U') > 60 * 60 * 24 * $day) return;
    echo ' (', human_time_diff($d('U') , strtotime(current_time('mysql', 0))) , '前)';
}
function timeago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return '刚刚';
    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $ptime) . ')',
        30 * 24 * 60 * 60 => '个月前 (' . date('m-d', $ptime) . ')',
        7 * 24 * 60 * 60 => '周前 (' . date('m-d', $ptime) . ')',
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

//评论回应邮件通知
add_action('comment_post', 'comment_mail_notify');
function comment_mail_notify($comment_id) {
    $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
    $admin_email = get_bloginfo('admin_email'); // $admin_email 可改为你指定的 e-mail.
    $comment = get_comment($comment_id);
    $comment_author_email = trim($comment->comment_author_email);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $blogname = get_option("blogname");
    global $wpdb;
    if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '') $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
    if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1')) $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
    $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
    $spam_confirmed = $comment->comment_approved;
    if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = 'Hi，您在 [' . get_option("blogname") . '] 的留言有人回复啦！';
    $message = '<div style="color:#555;font:12px/1.5 微软雅黑,Tahoma,Helvetica,Arial,sans-serif;width:650px;margin:50px auto;border-top: none;box-shadow:0 0px 3px #aaaaaa;" ><table border="0" cellspacing="0" cellpadding="0"><tbody><tr valign="top" height="2"><td valign="top"><div style="background-color:white;border-top:2px solid #12ADDB;line-padding:0 15px 12px;width:650px;color:#555555;font-family:微软雅黑, Arial;;font-size:12px;"><h2 style="border-bottom:1px solid #DDD;font-size:14px;font-weight:normal;padding:8px 0 10px 8px;"><span style="color: #12ADDB;font-weight: bold;">&gt; </span>您在 <a style="text-decoration:none; color:#58B5F5;font-weight:600;" target="_blank" href="' . home_url() . '">' . $blogname . '</a> 网站上的留言有回复啦！</h2><div style="padding:0 12px 0 12px;margin-top:18px"><p>您好, ' . trim(get_comment($parent_id)->comment_author) . '! 您发表在文章 <a style="text-decoration:none;" target="_blank" href="' . get_the_permalink($comment->comment_post_ID) . '">《' . get_the_title($comment->comment_post_ID) . '》</a> 的评论:</p><p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;margin: 15px 0;">' . nl2br(strip_tags(get_comment($parent_id)->comment_content)) . '</p><p>' . trim($comment->comment_author) . ' 给您的回复如下:</p><p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;margin: 15px 0;">' . nl2br(strip_tags($comment->comment_content)) . '</p><p>您可以点击 <a style="text-decoration:none; color:#5692BC" target="_blank" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">这里查看回复的完整內容</a>，也欢迎再次光临 <a style="text-decoration:none; color:#5692BC" target="_blank" href="' . home_url() . '">' . $blogname . '</a>。祝您天天开心，欢迎下次访问 <a style="text-decoration:none; color:#5692BC" target="_blank" href="' . home_url() . '">' . $blogname . '</a>！谢谢。</p><p style="float:right;">(此邮件由系统自动发出, 请勿回复)</p></div></div></td></tr></tbody></table><div style="color:#fff;background-color: #12ADDB;text-align : center;height:35px;padding-top:15px">Copyright © 2014-2016 ' . $blogname . '</div></div>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
        //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
    }
}
//自动勾选
function deel_add_checkbox() {
    echo '<label for="comment_mail_notify" class="comment_mail_notify"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked"/><span>有人回复时通知我</span></label>';
}
add_action('comment_form', 'deel_add_checkbox');

//自定义表情路径
function custom_smilies_src($src, $img){return get_bloginfo('template_directory').'/img/smilies/' . $img;}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);

// 评论头像缓存
if (webliu_option('cache_avater')):
function fa_cache_avatar($avatar, $id_or_email, $size, $default, $alt)
{
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    $tmp = strpos($avatar, 'http');
    $url = get_avatar_url( $id_or_email, $size ) ;
    $url = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $url);
    $avatar2x = get_avatar_url( $id_or_email, ( $size * 2 ) ) ;
    $avatar2x = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar2x);
    $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
    $tmp = strpos($g, 'avatar/') + 7;
    $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
    $w = home_url();
    $e = ABSPATH .'avatar/'. $size . '*'. $f .'.jpg';
    $e2x = ABSPATH .'avatar/'. ( $size * 2 ) . '*'. $f .'.jpg';
    $t = 1209600; 
    if ( (!is_file($e) || (time() - filemtime($e)) > $t) && (!is_file($e2x) || (time() - filemtime($e2x)) > $t ) ) { 
        copy(htmlspecialchars_decode($g), $e);
        copy(htmlspecialchars_decode($avatar2x), $e2x);
    } else { $avatar = $w.'/avatar/'. $size . '*'.$f.'.jpg';
        $avatar2x = $w.'/avatar/'. ( $size * 2) . '*'.$f.'.jpg';
        if (filesize($e) < 1000) copy($w.'/avatar/default.jpg', $e);
        if (filesize($e2x) < 1000) copy($w.'/avatar/default.jpg', $e2x);
        $avatar = "<img alt='{$alt}' src='{$avatar}' srcset='{$avatar2x}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    }
    return $avatar;
}
add_filter('get_avatar', 'fa_cache_avatar',1,5);
endif;

//移除评论内容中的链接
if (webliu_option('no_comment_link')):
remove_filter( 'comment_text', 'make_clickable',  9 );
endif;


// 点赞功能
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
  global $wpdb,$post;
  $id = $_POST["um_id"];
  $action = $_POST["um_action"];
  if ( $action == 'ding'){
  $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
  $expire = time() + 99999999;
  $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
  setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
  if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
      update_post_meta($id, 'bigfa_ding', 1);
  }
  else {
          update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
      }
  echo get_post_meta($id,'bigfa_ding',true);
  }
  die;
}

// 文章归档功能
function zww_archives_list() {
  if( !$output = get_option('zww_db_cache_archives_list') ){
    $output = '<div id="archives"><p><a id="al_expand_collapse" href="#">全部展开/收缩</a> <em>(注: 点击月份可以展开)</em></p>';
    $args = array(
      'post_type' => array('archives', 'post', 'zsay'),
      'posts_per_page' => -1, //全部 posts
      'ignore_sticky_posts' => 1 //忽略 sticky posts
    );
    $the_query = new WP_Query( $args );
    $posts_rebuild = array();
    $year = $mon = 0;
    while ( $the_query->have_posts() ) : $the_query->the_post();
      $post_year = get_the_time('Y');
      $post_mon = get_the_time('m');
      $post_day = get_the_time('d');
      if ($year != $post_year) $year = $post_year;
      if ($mon != $post_mon) $mon = $post_mon;
      $posts_rebuild[$year][$mon][] = '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>';
    endwhile;
    wp_reset_postdata();
    foreach ($posts_rebuild as $key_y => $y) {
      $y_i = 0; $y_output = '';
      foreach ($y as $key_m => $m) {
        $posts = ''; $i = 0;
        foreach ($m as $p) {
          ++$i; ++$y_i;
          $posts .= $p;
        }
        $y_output .= '<li><span class="al_mon">'. $key_m .' 月 <em>( '. $i .' 篇文章 )</em></span><ul class="al_post_list">'; //输出月份
        $y_output .= $posts; //输出 posts
        $y_output .= '</ul></li>';
      }
      $output .= '<h3 class="al_year">'. $key_y .' 年 <em>( '. $y_i .' 篇文章 )</em></h3><ul class="al_mon_list">'; //输出年份
      $output .= $y_output;
      $output .= '</ul>';
    }

    $output .= '</div>';
    update_option('zww_db_cache_archives_list', $output);
  }
  echo $output;
}
function clear_db_cache_archives_list() {
  update_option('zww_db_cache_archives_list', ''); // 清空 zww_archives_list
}
add_action('save_post', 'clear_db_cache_archives_list'); // 新发表文章/修改文章时







// 去除Category
include 'includes/no-category.php';

// simple-url短链接
include 'includes/simple-url.php';

// fancybox图片暗箱功能
include 'includes/fancybox.php';

// 评论邮件自动通知
// include 'includes/comment-mail.php';

// 压缩html代码
if( webliu_option('compress_html') ){
  require_once get_stylesheet_directory() . '/includes/compress-html.php';
}
// 新文章同步到微博
if( webliu_option('postto_sina_open') ){
  require_once get_stylesheet_directory() . '/includes/postto-weibo.php';
}










?>