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

// ************************************* 从这里开始主题的设置选项 *************************************
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
    'std'=>'WebLiu-前端刘（webliu.com），记录前端刘在学习、工作中的代码问题。',
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
    'std'=>'© 2018 All Rights Reserved | Theme by <a target="_blank" href="http://webliu.com" title="WebLiu-前端刘">webliu.com</a> | 沪ICP备14045138号-1 | <a href="#">站点地图</a><a href="#" title="阿里云"><i class="fa fa-cloud"></i></a><a href="#" title="wordpress"><i class="fa fa-wordpress"></i></a>',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'流量统计代码',
    'desc'=>'请将统计代码放到此处，国内比较常用的统计代码：百度，CNZZ等.不用输入[script]标签',
    'id'=>'foot_tj',
    'std'=>'',
    'type'=>"textarea"
);
// $options[] = array(
// 	'name'=>'首页隐藏分类',
//     'desc'=>'首页不想展示的某些分类，请输入文章分类的ID，多个分类用英文逗号","隔开，比如：-1,-2,-3',
//     'id'=>'hidden_category',
//     'std'=>'-99999',
//     'type'=>"text"
// );
$options[] = array(
	'name' => 'Gravatar 头像获取',
	'id' => 'gravatar_url',
	'std' => "duoshuo",
	'type' => "radio",
	'options' => array(
		'no' =>'原有方式',
		'ssl' =>'从Gravatar官方ssl获取',
));

// 首页设置：个人模板
$options[] = array(
    'name' => '首页设置',
    'type' => 'heading',
);
$options[] = array(
    'name'=>'首页背景大图设置',
    'desc'=>'背景图，尺寸：1920*600以上，建议图片优化，防止首页打开速度过慢.',
    'id'=>'visualbg',
		'std'=>''.get_template_directory_uri().'/img/visualbg.jpg',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'描述1',
    'desc'=>'请输入一段文字',
    'id'=>'zbword1',
    'std'=>'想制定更为装逼的Wordpress主题?',
    'type'=>"text"
);
$options[] = array(
    'name'=>'描述2',
    'desc'=>'同上',
    'id'=>'zbword2',
    'std'=>'请Email Me：HiWebLiu@163.com',
    'type'=>"text"
);
$options[] = array(
    'name'=>'署名',
    'desc'=>'大侠尊称',
    'id'=>'zbword3',
    'std'=>'--前端刘',
    'type'=>"text"
);
$options[] = array(
    'name'=>'焦点图按钮',
    'desc'=>'默认2个按钮，若想再添加按钮复制代码即可，图标请自行百度Font Awesome',
    'id'=>'visualbts',
    'std'=>'<a href="http://www.webliu.net" type="button"><i class="fa fa-cloud-download"></i>下载本主题</a>
<a href="http://www.webliu.net/aboutme" type="button"><i class="fa fa-street-view"></i>关于前端刘</a>',
    'type'=>"textarea"
);
$options[] = array(
    'name'  => '首页最新主题推荐设置（暂设定三篇）',
    'desc'  => '启用(填写链接之后才显示，默认不显示)',
    'id'    => "index_paythemes",
    'type'  => 'checkbox'
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'paythemes_title',
    'std'=>'最新主题',
    'type'=>"text"
);
$options[] = array(
    'name'=>'推荐1图片',
    'desc'=>'图片尺寸：390 * 340以上',
    'id'=>'paythemes1_img',
    'std'=>''.get_template_directory_uri().'/img/webliu.png',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'paythemes1_link',
    'std'=>'http://www.webliu.net',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'paythemes1_title',
    'std'=>'WebLiu主题',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'文章标签',
    'id'=>'paythemes1_tag',
    'std'=>'原创主题',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'描述',
    'id'=>'paythemes1_info',
    'std'=>'WebLiu主题是由WebLiu.net开发的一款原创wordpress博客主题，此款主题免费共享，后台功能强大，能满足绝大多数的博客站长需求',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'属性1',
    'id'=>'paythemes1_attr1',
    'std'=>'售价',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'值1',
    'id'=>'paythemes1_data1',
    'std'=>'免费',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'属性2',
    'id'=>'paythemes1_attr2',
    'std'=>'版本',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'值1',
    'id'=>'paythemes1_data2',
    'std'=>'V1.0',
    'type'=>"text"
);
$options[] = array(
    'name'=>'推荐2图片',
    'desc'=>'图片尺寸：390 * 340以上',
    'id'=>'paythemes2_img',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'paythemes2_link',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'paythemes2_title',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'文章标签',
    'id'=>'paythemes2_tag',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'描述',
    'id'=>'paythemes2_info',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'属性1',
    'id'=>'paythemes2_attr1',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'值1',
    'id'=>'paythemes2_data1',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'属性2',
    'id'=>'paythemes2_attr2',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'值2',
    'id'=>'paythemes2_data2',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'name'=>'推荐3图片',
    'desc'=>'图片尺寸：390 * 340以上',
    'id'=>'paythemes3_img',
    'std'=>'',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'链接',
    'id'=>'paythemes3_link',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'标题',
    'id'=>'paythemes3_title',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'文章标签',
    'id'=>'paythemes3_tag',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'描述',
    'id'=>'paythemes3_info',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'属性1',
    'id'=>'paythemes3_attr1',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'值1',
    'id'=>'paythemes3_data1',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'属性2',
    'id'=>'paythemes3_attr2',
    'std'=>'',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'值2',
    'id'=>'paythemes3_data2',
    'std'=>'',
    'type'=>"text"
);
// 首页两列文章列表设置
$options[] = array(
    'name'=>'首页两列文章列表设置,分类ID请参照顶部【您网站所有分类及ID】',
    'desc'=>'左侧列表分类ID，若为空则显示最新文章',
    'id'=>'course_catleft',
    'std'=>'1',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'右侧列表分类ID',
    'id'=>'course_catright',
    'std'=>'2',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'要显示的文章数量',
    'id'=>'course_catnum',
    'std'=>'10',
    'type'=>"text"
);
// 首页底部slogan
$options[] = array(
    'name'=>'首页底部slogan设置',
    'desc'=>'背景图，尺寸：1920 * 400 以上',
    'id'=>'sloganbg',
    'std'=>''.get_template_directory_uri().'/img/thinkbg.jpg',
    'type'=>"upload"
);
$options[] = array(
    'desc'=>'标题：能展现你比较文(Z)艺(B)气质的标题',
    'id'=>'slogantitle',
    'std'=>'wordpress主题专属定制，请联系前端刘:hiwebliu@163.com',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'内容',
    'id'=>'slogantxt',
    'std'=>'6年前端开发经验，响应式可视化网站模板，最新的前端js技术，全手动html5+css3布局，清晰的主题后台设置，集成大多数插件功能。',
    'type'=>"textarea"
);
$options[] = array(
    'desc'=>'字体颜色',
    'id'=>'slogancolor',
    'std'=>'#cacaca',
    'type'=>"color"
);
$options[] = array(
    'desc'=>'按钮链接',
    'id'=>'sloganlink',
    'std'=>'http://www.webliu.net',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'按钮内容',
    'id'=>'sloganlinktxt',
    'std'=>'QQ在线咨询',
    'type'=>"text"
);
$options[] = array(
    'desc'=>'备注',
    'id'=>'sloganremark',
    'std'=>'周一至周六，8:30-22:00',
    'type'=>"text"
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
    'std'=>'前端刘,webliu.net,webliu主题',
    'type'=>"textarea"
);
$options[] = array(
	'name'=>'网站描述',
    'desc'=>'描述有利于SEO优化，建议字数在30-70之间',
    'id'=>'description',
    'std'=>'webliu.net-前端刘的代码人生',
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
    'name'  => '外链自动nofollow',
    'desc'  => '启用（启用后文章内容及评论的外链自动nofolow,利于本站权重集中,建议开启!）',
    'id'    => "post_auto_nofollow",
    'type'  => 'checkbox'
);
$options[] = array(
    'name'  => '外链自动转GO跳转',
    'desc'  => '启用（启用后本站所有外链自动转为http://本站go/?url=跳转链接格式,此功能需本站开启伪静态,并且固定连接后缀为.html格式。也可后台新建页面-模板选择Go跳转）',
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
    'std'   => '<p>若未注明，本站文章均由 WebLiu-前端刘 原创发布</p>
<p>转载请注明：<a href="{{link}}" target="_blank" title="{{title}}">{{title}}</a>！</p>
<p>若有版权问题，请留言或联系站长！</p>'
);
// 评论设置
$options[] = array(
    'name' => '评论设置',
    'type' => 'heading'
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

// 站长信息设置开始
$options[] = array(
    'name' => '站长信息',
    'type' => 'heading'
);
$options[] = array(
    'name'=>'站长昵称',
    'desc'=>'站长在页面中显示的昵称',
    'id'=>'social_name',
    'std'=>'前端刘',
    'type'=>"text"
);
$options[] = array(
    'name'=>'站长头像',
    'desc'=>'图片用于：1.首页大图头像;2.侧边栏站长头像;3.关于站长页面',
    'id'=>'social_img',
    'std'=>''.get_template_directory_uri().'/img/slides/tx.png',
    'type'=>"upload"
);
$options[] = array(
    'name'=>'站长技能',
    'desc'=>'按格式添加font图标及title信息',
    'id'=>'social_skill',
    'std'=>'<i class="fa fa-vimeo-square" title="站长"></i>
<i class="fa fa-html5" title="前端工程师"></i>
<i class="fa fa-lastfm-square" title="C#后端开发"></i>',
    'type'=>"textarea"
);
$options[] = array(
    'name'=>'站长描述',
    'desc'=>'一段简短的自我描述',
    'id'=>'social_word',
    'std'=>'前端工程师，C#后端研发',
    'type'=>"textarea"
);
$options[] = array(
    'name'=>'社交媒体',
    'desc'=>'启用(内容为空则不显示相应的图标)',
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
    'desc'=>'GitHub',
    'id'=>'social_github',
    'std'=>'https://github.com/hiwebliu',
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
    'desc'=>'说明：<em>此选项默认不用修改</em>主题集成timthumb和七牛自动缩略图功能,若安装了七牛cdn插件并开启自动缩略图功能,则首选七牛;若未安装插件,则启用timthumb功能并将图片自动裁剪',
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
// 关于主题
$options[] =  array(
	'name'=>'关于主题',
	'type'=>'heading',
);
$options[] = array(
	'type'=>'title',
	'desc'=>'此主题是由 <b>前端刘(webliu.net)</b> 设计开发，本主题为免费共享博客主题，源码已托管到GitHub，使用主题前，请详细阅读本主题的使用说明！若主题出现bug，可以加群一起交流。QQ群：<b>101810056</b>   <a href="https://github.com/hiwebliu/WebLiu" target="_blank">源码下载</a>',
	'id'=>'about-themeWebLiu',
);

return $options;
}
