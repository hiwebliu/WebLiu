<?php
/**
* A unique identifier is defined to store the options in the database and reference them from the theme.
* By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
* If the identifier changes, it'll appear as if the options have been reset.
*/

function optionsframework_option_name() {

// 从样式表获取主题名称
$themename = wp_get_theme();
$themename = preg_replace("/\W/", "_", strtolower($themename) );

$optionsframework_settings = get_option( 'optionsframework' );
$optionsframework_settings['id'] = $themename;
update_option( 'optionsframework', $optionsframework_settings );
}

/**
* Defines an array of options that will be used to generate the settings page and be saved in the database.
* When creating the 'id' fields, make sure to use all lowercase and no spaces.
*
* If you are making your theme translatable, you should replace 'options_framework_theme'
* with the actual text domain for your theme.  请阅读:
* http://codex.wordpress.org/Function_Reference/load_theme_textdomain
*/

function optionsframework_options() {

$avater_style = array(
	'1' => '原有方式',
	'2' => '从多说服务器获取',
	'3' => '从七牛服务器获取',
	'4' => '本地缓存',
);


// 背景默认值
$background_defaults = array(
	'color' => '',
	'image' => '',
	'repeat' => 'repeat',
	'position' => 'top center',
	'attachment'=>'scroll' );

// 版式默认值
$typography_defaults = array(
	'size' => '15px',
	'face' => 'georgia',
	'style' => 'bold',
	'color' => '#bada55' );
	
// 版式设置选项
$typography_options = array(
	'sizes' => array( '6','12','14','16','20' ),
	'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
	'styles' => array( 'normal' => '普通','bold' => '粗体' ),
	'color' => false
);

// 将所有分类（categories）加入数组
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
	$options_categories[$category->cat_ID] = $category->cat_name;
}

// 将所有标签（tags）加入数组
$options_tags = array();
$options_tags_obj = get_tags();
foreach ( $options_tags_obj as $tag ) {
	$options_tags[$tag->term_id] = $tag->name;
}


// 将所有页面（pages）加入数组
$options_pages = array();
$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
$options_pages[''] = 'Select a page:';
foreach ($options_pages_obj as $page) {
	$options_pages[$page->ID] = $page->post_title;
}

// 如果使用图片单选按钮, define a directory path
$imagepath =  get_template_directory_uri() . '/images/';

$options = array();

// ************************************* 从这里开始WPOne主题的设置选项 *************************************
// 常规设置
$options[] = array(
    'name' => '基本设置',
    'type' => 'heading'
);
$options[] = array(
    'name'=>'网站Logo',
    'desc'=>'可以直接替换主题img目录下的logo.png，也可上传。最大尺寸：180px * 32px; 格式：.png',
    'id'=>'site_logo',
    'std'=>'http://s.wpztw.com/wp-content/uploads/2016/11/logo.png',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'网站滚动logo',
    'desc'=>'页面滚动时显示的logo，建议尺寸同上。',
    'id'=>'site_logo1',
    'std'=>'http://s.wpztw.com/wp-content/uploads/2016/11/logo.gif',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'网站favicon.ico图标',
    'desc'=>'网站个性favicon.ico图标，可以直接上传图标到网站根目录，也可以在此上传，建议尺寸16*16',
    'id'=>'site_favicon',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'宣传口号',
    'desc'=>'搜索框上方的宣传口号',
    'id'=>'site_slogan',
    'std'=>'免费 开源 共享',
    'type'=>"text"
);
$options[] = array(
    'name'=>'宣传口号字体颜色',
    'id'=>'site_slogan_color',
    'std'=>'#ffffff',
    'type'=>"color"
);
$options[] = array(
    'name'=>'宣传口号字体大小',
    'desc'=>'最好在24-50之间，太大了不好看',
    'id'=>'site_slogan_size',
    'std'=>'28',
    'type'=>"text"
);
$options[] = array(
    'name'=>'宣传口号背景图',
    'desc'=>'最低尺寸：1366 * 230',
    'id'=>'site_slogan_img',
    'std'=>''.get_template_directory_uri().'/img/sloganbg.jpg',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'首页公告',
    'desc'=>'只在首页展示，支持Html代码，比如[a]链接',
    'id'=>'site_notices',
    'std'=>'输入您的网站公告...',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'关于本站描述',
    'desc'=>'网站底部关于本站的描述',
    'id'=>'foot_about',
    'std'=>'wordpress主题网（wpztw.com）专注于wordpress建站，提供wordpress主题下载,wordpress插件,wordpress代码和wordpress教程等一站式服务,让每个使用wordpress的朋友轻松建站。',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'底部标签数量',
    'desc'=>'为了美观和加载速度，数量不宜过多，最好高度和左侧的关于本站高度相近',
    'id'=>'foot_tags_num',
    'std'=>'40',
    'type'=>"text",
);
$options[] = array(
	'name'=>'网站底部信息',
    'desc'=>'包含网站备案号、版权、站点地图等。站点地图请新建页面，选择"站点地图"模板',
    'id'=>'foot_seo',
    'std'=>'© 2013 - 2016 All Rights Reserved | Theme by wpztw.com. | 沪ICP备14045138号-1 | <a href="#">站点地图</a><a href="#" title="阿里云"><i class="fa fa-cloud"></i></a><a href="#" title="wordpress"><i class="fa fa-wordpress"></i></a>',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'流量统计代码',
    'desc'=>'请将统计代码放到此处，国内比较常用的统计代码：百度，CNZZ等.不用输入[script]标签',
    'id'=>'foot_tj',
    'std'=>'',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'首页隐藏分类',
    'desc'=>'首页不想展示的某些分类，请输入文章分类的ID，多个分类用英文逗号","隔开，比如：-1,-2,-3',
    'id'=>'hidden_category',
    'std'=>'-99999',
    'type'=>"text"
);
$options[] = array(
	'name' => 'Gravatar 头像获取',
	'id' => 'gravatar_url',
	'std' => "duoshuo",
	'type' => "radio",
	'options' => array(
		'no' =>'原有方式',
		'ssl' =>'从Gravatar官方ssl获取',
		'duoshuo' => '从多说服务器获取',
));

// 首页设置：个人模板
$options[] = array(
    'name' => '首页设置',
    'type' => 'heading',
);
$options[] = array(
    'name'=>'焦点图设置',
    'desc'=>'关键字有利于SEO优化，建议个数在5-10之间，用英文逗号隔开',
    'id'=>'keywords',
    'std'=>'wpztw.com,WPOne主题',
    'type'=>"textarea"
);






// SEO设置
$options[] = array(
    'name' => 'SEO设置',
    'type' => 'heading'
);
$options[] = array(
    'name'=>'网站关键字',
    'desc'=>'关键字有利于SEO优化，建议个数在5-10之间，用英文逗号隔开',
    'id'=>'keywords',
    'std'=>'wpztw.com,WPOne主题',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'网站描述',
    'desc'=>'描述有利于SEO优化，建议字数在30-70之间',
    'id'=>'description',
    'std'=>'WPOne主题由WP主题网（wpztw.com）设计开发，更多原创wordpress主题，请关注WP主题网。',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'全站Title连接符',
    'desc'=>'确定后切勿修改，一般为"-"或者"|"或者"_"',
    'id'=>'title_connector',
    'std'=>'-',
    'type'=>"text"
);
$options[] = array(
    'name'  => '图片自动添加alt以及title',
    'desc'  => '启用（启用后图片以及图片链接自动添加alt和title,如果已存在,不会覆盖,建议开启!）',
    'id'    => "post_img_auto_title",
    'type'  => 'checkbox'
);
$options[] = array(
    'name'  => '文章外链自动nofollow',
    'desc'  => '启用（启用后文章及评论外链自动nofolow,利于本站权重集中,建议开启!）',
    'id'    => "post_auto_nofollow",
    'type'  => 'checkbox'
);
$options[] = array(
    'name'  => '外链自动转GO跳转',
    'desc'  => '启用（启用后外链自动转为http://本站go/?url=跳转链接格式,此功能需本站开启伪静态,并且固定连接后缀为.html格式,后台新建页面-模板选择Go跳转）',
    'id'    => "post_gourl",
    'type'  => 'checkbox'
);
$options[] = array(
    'name'  => '百度主动推送',
    'desc'  => '启用（启用后将站点当天新产出链接立即通过此方式推送给百度，以保证新链接可以及时被百度收录）',
    'id'    => "post_sitemap_api_open",
    'type'  => 'checkbox'
);
$options[] = array(
    'desc'  => '<a target="_blank" rel="nofollow" href="http://zhanzhang.baidu.com/linksubmit/index">接口获取地址</a> <a target="_blank" rel="nofollow" href="#">使用教程</a>',
    'id' => "post_sitemap_api",
    'std' => '格式：http://data.zz.baidu.com/urls?site=域名&token=字符串',
    'type'  => 'text',
);

// 文章设置
$options[] = array(
    'name' => '文章设置',
    'type' => 'heading'
);
$options[] = array(
	'name' => '新窗口打开文章',
	'desc' =>'启用',
	'id' => 'post_blank',
	'std' => '0',
	'type' => 'checkbox',
);
$options[] = array(
	'name' => '禁止自动保存和修订版本',
	'desc' =>'启用(启用后编辑文章时不再自动保存，可有效地减小数据库体积，但如果你经常手残，还是别禁止了)',
	'id' => 'post_autosave',
	'type' => 'checkbox',
);
$options[] = array(
	'name' => '文章meta信息',
	'desc' =>'文章时间',
	'id' => 'post_meta_date',
	'std' => '0',
	'type' => 'checkbox',
);
$options[] = array(
	'desc' =>'文章作者',
	'id' => 'post_meta_author',
	'std' => '0',
	'type' => 'checkbox',
);
$options[] = array(
	'desc' =>'浏览次数',
	'id' => 'post_meta_pv',
	'std' => '0',
	'type' => 'checkbox',
);
$options[] = array(
    'desc' =>'文章评论数',
    'id' => 'post_meta_com',
    'std' => '0',
    'type' => 'checkbox',
);
$options[] = array(
    'desc' =>'文章所属分类',
    'id' => 'post_meta_cat',
    'std' => '0',
    'type' => 'checkbox',
);
$options[] = array(
	'desc' =>'文章百度收录查询(开启此功能，<em>未收录的页面加载时间增加0.5s-1s左右</em>)',
	'id' => 'baidu_record',
	'std' => '0',
	'type' => 'checkbox',
);
$options[] = array(
    'name' => '文章点赞功能',
    'id' => 'post_linke_open',
    'desc' => '启用(不想用的话去掉，还能加快加载速度)',
    'std' => '1',
    'type' => 'checkbox',
);
$options[] = array(
    'name'=>'百度口碑(或自定义链接)',
    'type'=>"subtitle"
);
$options[] = array(
    'id' => 'post_koubei_open',
    'desc' => '启用',
    'std' => '1',
    'type' => 'checkbox',
);
$options[] = array(
    'id' => 'post_koubei_t',
    'desc' => '自定义链接标题',
    'std' => '百度口碑',
    'type' => 'text',
);
$options[] = array(
    'id' => 'post_koubei_l',
    'desc' => '自定义链接',
    'std' => 'https://koubei.baidu.com/',
    'type' => 'text',
);
$options[] = array(
    'name'=>'文章打赏功能',
    'type'=>"subtitle"
);
$options[] = array(
    'id' => 'post_dashang_open',
    'desc' => '启用',
    'std' => '1',
    'type' => 'checkbox',
);
$options[] = array(
    'id' => 'post_dashang_z',
    'desc' => '支付宝收款：请去自己的支付宝找到支付宝收款二维码',
    'std' => '111111',
    'type' => 'upload',
);
$options[] = array(
    'id' => 'post_dashang_w',
    'desc' => '微信收款：请去自己的微信找到微信收款二维码',
    'std' => '111111',
    'type' => 'upload',
);
$options[] = array(
    'name' => '相关文章设置',
    'id' => 'post_related_title',
    'desc' => '相关文章的标题',
    'std' => '相关文章',
    'type' => 'text',
    'class' => 'mini',
);
$options[] = array(
	'id' => 'post_related_num',
	'desc' => '相关文章的数量',
	'std' => '8',
	'type' => 'text',
	'class' => 'mini',
);
$options[] = array(
	'name'  => '文章版权声明',
	'id' => 'post_copyright_open',
	'desc' => '启用',
	'type' => 'checkbox',
);
$options[] = array(
    'desc'  => '文章底部版权声明，{{title}}表示此篇文章标题，{{link}}表示此篇文章链接',
    'id'    => "post_copyright",
    'type'  => 'textarea',
    'std'   => '本文由WP主题网出品,如未注明,均为原创,转载请注明<a href="{{link}}" target="_blank" title="{{title}}">{{title}}</a>！'
);
// 评论设置  
$options[] = array(
    'name' => '评论设置',
    'type' => 'heading'
);
$options[] = array(
    'name'  => '最大嵌套评论层数',
    'desc'  => '嵌套评论层数别太多，不然影响美观',
    'id'    => "comments-floor",
    'type'  => 'text',
    'std'   => '5',
    'class' => 'mini'
);
$options[] = array(
    'name'  => '缓存评论头像',
    'desc'  => '启用(<em>启用前</em>，在wp-content的同級目录建立avatar文件夹,设置权限为0755,并上传一张default.jpg头像)',
    'id'    => "cache_avater",
    'type'  => 'checkbox',
    'std'   => '0'
);
$options[] = array(
    'name'  => '移除评论内容中的链接',
    'desc'  => '启用(启用后，将禁止评论里的网址自动转换为可点击的链接)',
    'id'    => "no_comment_link",
    'type'  => 'checkbox',
    'std'   => '1'
);


// 首页轮播  
$options[] = array(
    'name' => '首页轮播',
    'type' => 'heading'
);
$options[] = array(
    'name'=>'图片1',
    'desc'=>'图片尺寸：820 * 260',
    'id'=>'slide_one_img',
    'std'=>''.get_template_directory_uri().'/img/slides/1.jpg',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'slide_one_title',
    'std'=>'标题',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'slide_one_link',
    'std'=>'#',
    'type'=>"text"
);
$options[] = array(
    'name'=>'图片2',
    'desc'=>'图片尺寸：820 * 260',
    'id'=>'slide_two_img',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'slide_two_title',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'slide_two_link',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'name'=>'图片3',
    'desc'=>'图片尺寸：820 * 260',
    'id'=>'slide_three_img',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'slide_three_title',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'slide_three_link',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'name'=>'图片4',
    'desc'=>'图片尺寸：820 * 260',
    'id'=>'slide_four_img',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'slide_four_title',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'slide_four_link',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'name'=>'图片5',
    'desc'=>'图片尺寸：820 * 260',
    'id'=>'slide_five_img',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'slide_five_title',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'slide_five_link',
    'std'=>'',
    'type'=>"text"
);
// 站长信息设置开始  
$options[] = array(
    'name' => '站长信息',
    'type' => 'heading'
);
$options[] = array(
    'name'=>'站长昵称',
    'desc'=>'站长在页面中显示的昵称',
    'id'=>'social_name',
    'std'=>'WP主题',
    'type'=>"text"
);
$options[] = array(
    'name'=>'站长头像',
    'desc'=>'可以直接替换主题img目录下的tx.png，也可上传。建议尺寸：110px * 110px',
    'id'=>'social_img',
    'std'=>''.get_template_directory_uri().'/img/slides/tx.png',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'站长描述',
    'desc'=>'可以直接替换主题img目录下的tx.png，也可上传。建议尺寸：110px * 110px',
    'id'=>'social_word',
    'std'=>'暗淡的黑，爱设计，爱电影，爱折腾代码，爱网络，更爱生活...欢迎关注wp主题网。',
    'type'=>"textarea"
);
$options[] = array(
    'name'=>'社交媒体',
    'desc'=>'启用(内容为空咋不显示相应的图标)',
    'id'=>'social_links_open',
    'std'=>'1',
    'type'=>"checkbox"
);
$options[] = array(
    'desc'=>'QQ',
    'id'=>'social_qq',
    'std'=>'402777838',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'微博',
    'id'=>'social_weibo',
    'std'=>'http://weibo.com/wpztw',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'腾讯微博',
    'id'=>'social_qqweibo',
    'std'=>'http://t.qq.com/andandehei',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'QQ邮箱',
    'id'=>'social_email',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'RSS',
    'id'=>'social_rss',
    'type'=>"text",
    'std'=>''.get_bloginfo('rss2_url').''
);
$options[] = array(
    'desc'=>'微信二维码，建议尺寸：200 * 200',
    'id'=>'social_weixin',
    'std'=>'',
    'type'=>"upload"
);

// 插件设置
$options[] =  array(
	'name'=>'插件设置',
	'type'=>'heading',
);
$options[] = array(
	'name'=>'去除category',
    'desc'=>'启用(去掉URL中的Category目录,启用后去设置-固定连接保存即可,<em>请勿安装相同功能的插件</em>)',
    'id'=>'no_category_open',
    'std'=>'1',
    'type'=>"checkbox"
);
$options[] = array(
	'name'=>'simple-url短链接',
    'desc'=>'启用(网站外链转内链,启用后请去添加短链接,<em>请勿同时安装相同功能插件</em>)',
    'id'=>'simple_url_open',
    'std'=>'1',
    'type'=>"checkbox"
);
$options[] = array(
	'name'=>'图片暗箱fancybox功能',
    'desc'=>'启用(图片暗箱功能,启用后文章内插入图片时,编辑图片-连接到媒体文件,<em>请勿同时安装相同功能插件</em>)',
    'id'=>'fancybox_open',
    'std'=>'1',
    'type'=>"checkbox"
);
$options[] = array(
	'name'=>'prism代码高亮功能',
    'desc'=>'启用(集成代码高亮功能,启用后编辑文章-点击插入代码高亮按钮,<em>请勿同时安装相同功能插件</em>)',
    'id'=>'prism_open',
    'std'=>'1',
    'type'=>"checkbox"
);
$options[] = array(
	'name'=>'文章目录功能',
    'desc'=>'启用(启用后编辑文章，插入h3标签的标题,即可实现自动目录功能,<em>请勿同时安装相同功能插件</em>)',
    'id'=>'postcat_open',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] = array(
	'name'=>'文章自动缩略图功能',
    'type'=>"subtitle"
);
$options[] = array(
    'desc'=>'说明：<em>此选项默认不用修改</em>主题集成timthumb和七牛自动缩略图功能,若安装了七牛cdn插件并开启自动缩略图功能,则首选七牛;若未安装插件,则启用timthumb功能并将图片自动裁剪,尺寸220*150 <a>相关教程</a>',
    'id'=>'dadf',
    'std'=>'1',
    'type'=>'checkbox',
);
$options[] = array(
	'name'=>'压缩html代码',
    'desc'=>'启用(将网页源代码进行压缩,提高网页加载速度)',
    'id'=>'compress_html',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] = array(
	'name'=>'新文章同步到微博',
    'type'=>"subtitle"
);
$options[] = array(
    'desc'=>'启用(新发布的文章自动同步到微博)',
    'id'=>'postto_sina_open',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] = array(
    'desc'=>'新浪微博账户',
    'id'=>'postto_sina_name',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'新浪微博密码',
    'id'=>'postto_sina_psd',
    'std'=>'',
    'type'=>"password"
);
$options[] = array(
    'desc'=>'新浪appkey(用于微博文章显示：来自xx网) <a class="ztbtn" href="http://open.weibo.com/index.php">申请appkey</a>',
    'id'=>'postto_sina_appkey',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
	'name'=>'隐藏后台登录地址',
    'type'=>"subtitle"
);
$options[] = array(
    'desc'=>'启用(启用后后台登录地址修改为：http://yoursite/wp-login.php?字符串1=字符串2)',
    'id'=>'admin_login_open',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] = array(
    'desc'=>'字符串1(必须为英文！比如user)',
    'id'=>'admin_login_q',
    'std'=>'user',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'字符串2(必须为英文！比如admin)',
    'id'=>'admin_login_a',
    'std'=>'admin',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'直接访问http://xx.com/wp-admin或输入错错误，跳转到哪个地址，比如跳转到百度',
    'id'=>'admin_login_j',
    'std'=>'http://www.baidu.com',
    'type'=>"text"
);
$options[] = array(
    'name'=>'移除wordpress、css及js的版本号',
    'desc'=>'启用(去除比如xx.css?ver=123后的版本号)',
    'id'=>'delete_jquery_v',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] = array(
    'name'=>'开启GZip压缩',
    'desc'=>'启用(大大提高网站加载速度,开启前请先去百度检测是否已开启GZip)',
    'id'=>'gzip_open',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] =  array(
	'name'=>'侧栏跟随',
	'type'=>'heading',
);
$options[] = array(
	'name'=>'首页',
    'type'=>"subtitle"
);
$options[] = array(
    'desc'=>'启用',
    'id'=>'index_follow_open',
    'std'=>'0',
    'type'=>"checkbox"
);
$options[] = array(
    'desc'=>'设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块',
    'id'=>'index_follow_one',
    'class'=>'mini',
    'type'=>"text"
);
// 关于主题
$options[] =  array(
	'name'=>'关于主题',
	'type'=>'heading',
);
$options[] = array(
	'type'=>'title',
	'desc'=>'使用主题前，请详细阅读本主题的使用说明！',
);


return $options;
}
