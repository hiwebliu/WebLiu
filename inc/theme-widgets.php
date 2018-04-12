<?php
//广告小工具
add_action('widgets_init', 'get_widgetads');
function get_widgetads() {
    register_widget('get_widgetad');
}
class get_widgetad extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'widgetad paddingnone wow fadeInUp',
            'description' => '显示一个广告(包括富媒体)'
        );
        $this->WP_Widget('get_widgetad', 'O-广告', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $code = $instance['code'];
        echo $before_widget;
        echo '' . $code . '';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				广告名称：
				<input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				广告代码：
				<textarea id="<?php
        echo $this->get_field_id('code'); ?>" name="<?php
        echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php
        echo $instance['code']; ?></textarea>
			</label>
		</p>
<?php
    }
}
//最新评论小工具
add_action('widgets_init', 'get_widget_comments');
function get_widget_comments() {
    register_widget('get_widget_comment');
}
class get_widget_comment extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_comment wow fadeInUp',
            'description' => '显示网友最新评论（头像+名称+评论）'
        );
        $this->WP_Widget('get_widget_comment', 'O-最新评论', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $limit = $instance['limit'];
        $outer = $instance['outer'];
        $outpost = $instance['outpost'];
        $mo = '';
        if ($more != '' && $link != '') $mo = '<a class="btn" target="_blank" href="' . $link . '">' . $more . '</a>';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        echo '<ul>';
        echo mod_newcomments($limit, $outpost, $outer);
        echo '</ul>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				标题：
				<input class="widefat" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input class="widefat" id="<?php
        echo $this->get_field_id('limit'); ?>" name="<?php
        echo $this->get_field_name('limit'); ?>" type="number" value="<?php
        echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某用户ID：
				<input class="widefat" id="<?php
        echo $this->get_field_id('outer'); ?>" name="<?php
        echo $this->get_field_name('outer'); ?>" type="number" value="<?php
        echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某文章ID：
				<input class="widefat" id="<?php
        echo $this->get_field_id('outpost'); ?>" name="<?php
        echo $this->get_field_name('outpost'); ?>" type="text" value="<?php
        echo $instance['outpost']; ?>" />
			</label>
		</p>

<?php
    }
}
function mod_newcomments($limit, $outpost, $outer) {
    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='" . $outpost . "' AND user_id!='" . $outer . "' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
    $comments = $wpdb->get_results($sql);
    foreach ($comments as $comment) {
        $output.= '<li><a target="_blank" href="' . get_permalink($comment->ID) . '#comment-' . $comment->comment_ID . '" data-toggle="tooltip" title="' . $comment->post_title . '上的评论">' . str_replace(' src=', ' data-original=', get_avatar($comment->comment_author_email, $size = '36', deel_avatar_default())) . ' <div class="content"><i>' . strip_tags($comment->comment_author) . '</i> 说：<br>' . str_replace(' src=', ' data-original=', convert_smilies(strip_tags($comment->com_excerpt))) . '</div></a></li>';
    }
    echo $output;
};
//最近文章小工具
add_action('widgets_init', 'get_postlists');
function get_postlists() {
    register_widget('get_postlist');
}
class get_postlist extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'postlist wow fadeInUp',
            'description' => '图文展示（最新文章+热门文章+随机文章）'
        );
        $this->WP_Widget('get_postlist', 'O-聚合文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $limit = $instance['limit'];
        $cat = $instance['cat'];
        $orderby = $instance['orderby'];
        $more = $instance['more'];
        $link = $instance['link'];
        $img = $instance['img'];
        $mo = '';
        $style = '';
        if ($more != '' && $link != '') $mo = '<a class="btn" target="_blank" href="' . $link . '">' . $more . '</a>';
        if (!$img) $style = ' class="nopic"';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        echo '<ul' . $style . '>';
        echo githeme_posts_list($orderby, $limit, $cat, $img);
        echo '</ul>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				标题：
				<input style="width:100%;" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排序：
				<select style="width:100%;" id="<?php
        echo $this->get_field_id('orderby'); ?>" name="<?php
        echo $this->get_field_name('orderby'); ?>" style="width:100%;">
					<option value="comment_count" <?php
        selected('comment_count', $instance['orderby']); ?>>评论数</option>
					<option value="date" <?php
        selected('date', $instance['orderby']); ?>>最新文章</option>
					<option value="rand" <?php
        selected('rand', $instance['orderby']); ?>>随机</option>
				</select>
			</label>
		</p>
		<p>
			<label>
				分类限制：
				<a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
				<input style="width:100%;" id="<?php
        echo $this->get_field_id('cat'); ?>" name="<?php
        echo $this->get_field_name('cat'); ?>" type="text" value="<?php
        echo $instance['cat']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input style="width:100%;" id="<?php
        echo $this->get_field_id('limit'); ?>" name="<?php
        echo $this->get_field_name('limit'); ?>" type="number" value="<?php
        echo $instance['limit']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php
        checked($instance['img'], 'on'); ?> id="<?php
        echo $this->get_field_id('img'); ?>" name="<?php
        echo $this->get_field_name('img'); ?>">显示图片
			</label>
		</p>

	<?php
    }
}
function githeme_posts_list($orderby, $limit, $cat, $img) {
    $args = array(
        'order' => DESC,
        'cat' => $cat,
        'orderby' => $orderby,
        'showposts' => $limit,
        'caller_get_posts' => 1
    );
    query_posts($args);
    while (have_posts()):
        the_post();
?>
<li>
<a target="_blank" href="<?php
        the_permalink(); ?>" data-toggle="tooltip" title="<?php
        the_title(); ?>" ><?php
            if ($img) {
                echo '<span class="thumbnail">';
                echo '<img width="100px" height="64px" src="' . get_template_directory_uri() . '/timthumb.php?src=';
                echo post_thumbnail_src();
                echo '&h=100&w=220&q=90&zc=1&ct=1" alt="' . get_the_title() . '" /></span>';
            } else {
                $img = '';
        } ?><span class="text"><?php
        the_title(); ?></span></a>
</li>
<?php
    endwhile;
    wp_reset_query();
}

/*
 * 读者墙
 * githeme_readers( $outer='name', $timer='3', $limit='14' );
 * $outer 不显示某人
 * $timer 几个月时间内
 * $limit 显示条数
*/
function githeme_readers($out, $tim, $lim, $addlink) {
    global $wpdb;
    $counts = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $tim day ) and user_id='0' and comment_author != '" . $out . "' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $lim");
    foreach ($counts as $count) {
        $c_url = $count->comment_author_url;
        if ($c_url == '') $c_url = 'javascript:;';
        if ($addlink == 'on') {
            $c_urllink = ' href="' . $c_url . '"';
        } else {
            $c_urllink = '';
        }
        $type.= '<li><a title="[' . $count->comment_author . '] 近期点评' . $count->cnt . '次" target="_blank"' . $c_urllink . '>' . get_avatar($count->comment_author_email, $size = '48', deel_avatar_default()) . '</a></li>';
    }
    echo $type;
}
//彩色推荐模块
add_action('widgets_init', 'get_recs');
function get_recs() {
    register_widget('get_rec');
}
class get_rec extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'recommend paddingnone wow fadeInUp',
            'description' => '五个推荐块',
        );
        $this->WP_Widget('get_rec', 'O-多彩模块推荐', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $atitle1 = $instance['atitle1'];
        $alink1 = $instance['alink1'];
        $aclass01 = $instance['aclass1'];
        $atitle2 = $instance['atitle2'];
        $alink2 = $instance['alink2'];
        $aclass02 = $instance['aclass2'];
        $atitle3 = $instance['atitle3'];
        $alink3 = $instance['alink3'];
        $aclass03 = $instance['aclass3'];
        $atitle4 = $instance['atitle4'];
        $alink4 = $instance['alink4'];
        $aclass04 = $instance['aclass4'];
        $atitle5 = $instance['atitle5'];
        $alink5 = $instance['alink5'];
        $aclass05 = $instance['aclass5'];
        echo $before_widget;
        echo '<a target="_blank" class="' . $aclass01 . '" href="' . $alink1 . '" title="' . $atitle1 . '" >' . $atitle1 . '</a>';
        echo '<a target="_blank" class="' . $aclass02 . '" href="' . $alink2 . '" title="' . $atitle2 . '" >' . $atitle2 . '</a>';
        echo '<a target="_blank" class="' . $aclass03 . '" href="' . $alink3 . '" title="' . $atitle3 . '" >' . $atitle3 . '</a>';
        echo '<a target="_blank" class="' . $aclass04 . '" href="' . $alink4 . '" title="' . $atitle4 . '" >' . $atitle4 . '</a>';
        echo '<a target="_blank" class="' . $aclass05 . '" href="' . $alink5 . '" title="' . $atitle5 . '" >' . $atitle5 . '</a>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				第一文字：<input style="width:200px;" id="<?php
        echo $this->get_field_id('atitle1'); ?>" name="<?php
        echo $this->get_field_name('atitle1'); ?>" type="text" value="<?php
        echo $instance['atitle1']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第一链接：<input style="width:200px;" id="<?php
        echo $this->get_field_id('alink1'); ?>" name="<?php
        echo $this->get_field_name('alink1'); ?>" type="url" value="<?php
        echo $instance['alink1']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第一样式：<select style="width:200px;" id="<?php
        echo $this->get_field_id('aclass1'); ?>" name="<?php
        echo $this->get_field_name('aclass1'); ?>" >
					<option value="aclass01" <?php
        selected('aclass01', $instance['aclass1']); ?>>黑色</option>
					<option value="aclass02" <?php
        selected('aclass02', $instance['aclass1']); ?>>紫色</option>
					<option value="aclass03" <?php
        selected('aclass03', $instance['aclass1']); ?>>红色</option>
					<option value="aclass04" <?php
        selected('aclass04', $instance['aclass1']); ?>>黄色</option>
					<option value="aclass05" <?php
        selected('aclass05', $instance['aclass1']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第二文字：<input style="width:200px;" id="<?php
        echo $this->get_field_id('atitle2'); ?>" name="<?php
        echo $this->get_field_name('atitle2'); ?>" type="text" value="<?php
        echo $instance['atitle2']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第二链接：<input style="width:200px;" id="<?php
        echo $this->get_field_id('alink2'); ?>" name="<?php
        echo $this->get_field_name('alink2'); ?>" type="url" value="<?php
        echo $instance['alink2']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第二样式：<select style="width:200px;" id="<?php
        echo $this->get_field_id('aclass2'); ?>" name="<?php
        echo $this->get_field_name('aclass2'); ?>" >
					<option value="aclass01" <?php
        selected('aclass01', $instance['aclass2']); ?>>黑色</option>
					<option value="aclass02" <?php
        selected('aclass02', $instance['aclass2']); ?>>蓝色</option>
					<option value="aclass03" <?php
        selected('aclass03', $instance['aclass2']); ?>>红色</option>
					<option value="aclass04" <?php
        selected('aclass04', $instance['aclass2']); ?>>黄色</option>
					<option value="aclass05" <?php
        selected('aclass05', $instance['aclass2']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第三文字：<input style="width:200px;" id="<?php
        echo $this->get_field_id('atitle3'); ?>" name="<?php
        echo $this->get_field_name('atitle3'); ?>" type="text" value="<?php
        echo $instance['atitle3']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第三链接：<input style="width:200px;" id="<?php
        echo $this->get_field_id('alink3'); ?>" name="<?php
        echo $this->get_field_name('alink3'); ?>" type="url" value="<?php
        echo $instance['alink3']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第三样式：<select style="width:200px;" id="<?php
        echo $this->get_field_id('aclass3'); ?>" name="<?php
        echo $this->get_field_name('aclass3'); ?>" >
					<option value="aclass01" <?php
        selected('aclass01', $instance['aclass3']); ?>>黑色</option>
					<option value="aclass02" <?php
        selected('aclass02', $instance['aclass3']); ?>>蓝色</option>
					<option value="aclass03" <?php
        selected('aclass03', $instance['aclass3']); ?>>红色</option>
					<option value="aclass04" <?php
        selected('aclass04', $instance['aclass3']); ?>>黄色</option>
					<option value="aclass05" <?php
        selected('aclass05', $instance['aclass3']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第四文字：<input style="width:200px;" id="<?php
        echo $this->get_field_id('atitle4'); ?>" name="<?php
        echo $this->get_field_name('atitle4'); ?>" type="text" value="<?php
        echo $instance['atitle4']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第四链接：<input style="width:200px;" id="<?php
        echo $this->get_field_id('alink4'); ?>" name="<?php
        echo $this->get_field_name('alink4'); ?>" type="url" value="<?php
        echo $instance['alink4']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第四样式：<select style="width:200px;" id="<?php
        echo $this->get_field_id('aclass4'); ?>" name="<?php
        echo $this->get_field_name('aclass4'); ?>" >
					<option value="aclass01" <?php
        selected('aclass01', $instance['aclass4']); ?>>黑色</option>
					<option value="aclass02" <?php
        selected('aclass02', $instance['aclass4']); ?>>蓝色</option>
					<option value="aclass03" <?php
        selected('aclass03', $instance['aclass4']); ?>>红色</option>
					<option value="aclass04" <?php
        selected('aclass04', $instance['aclass4']); ?>>黄色</option>
					<option value="aclass05" <?php
        selected('aclass05', $instance['aclass4']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第五文字：<input style="width:200px;" id="<?php
        echo $this->get_field_id('atitle5'); ?>" name="<?php
        echo $this->get_field_name('atitle5'); ?>" type="text" value="<?php
        echo $instance['atitle5']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第五链接：<input style="width:200px;" id="<?php
        echo $this->get_field_id('alink5'); ?>" name="<?php
        echo $this->get_field_name('alink5'); ?>" type="url" value="<?php
        echo $instance['alink5']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第五样式：<select style="width:200px;" id="<?php
        echo $this->get_field_id('aclass5'); ?>" name="<?php
        echo $this->get_field_name('aclass5'); ?>" >
					<option value="aclass01" <?php
        selected('aclass01', $instance['aclass5']); ?>>黑色</option>
					<option value="aclass02" <?php
        selected('aclass02', $instance['aclass5']); ?>>蓝色</option>
					<option value="aclass03" <?php
        selected('aclass03', $instance['aclass5']); ?>>红色</option>
					<option value="aclass04" <?php
        selected('aclass04', $instance['aclass5']); ?>>黄色</option>
					<option value="aclass05" <?php
        selected('aclass05', $instance['aclass5']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />
<?php
    }
}


//邮箱订阅小工具
add_action('widgets_init', 'get_subscribes');
function get_subscribes() {
    register_widget('get_subscribe');
}
class get_subscribe extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'subscribe wow fadeInUp',
            'description' => '显示邮箱订阅组件'
        );
        $this->WP_Widget('get_subscribe', 'O-邮箱订阅', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = (!empty($instance['title'])) ? $instance['title'] : '邮箱订阅';
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $nid = empty($instance['nid']) ? '' : $instance['nid'];
        // $info = empty($instance['info']) ? '订阅精彩内容' : $instance['info'];
        $placeholder = empty($instance['placeholder']) ? 'your@email.com' : $instance['placeholder'];
        $output.= $before_widget;
        if ($title) $output.= $before_title . $title . $after_title;
        $output.= '<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">' . '<p>' . $info . '</p>' . '<input type="hidden" name="t" value="qf_booked_feedback" /><input type="hidden" name="id" value="' . $nid . '" />' . '<input type="email" name="to" class="rsstxt" placeholder="' . $placeholder . '" value="" required /><input type="submit" class="btn" value="订阅" />' . '</form>';
        $output.= $after_widget;
        echo $output;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['nid'] = strip_tags($new_instance['nid']);
        $instance['info'] = strip_tags($new_instance['info']);
        $instance['placeholder'] = strip_tags($new_instance['placeholder']);
        return $instance;
    }
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $nid = esc_attr($instance['nid']);
        $info = esc_attr($instance['info']);
        $placeholder = esc_attr($instance['placeholder']);
?>
		<p><label for="<?php
        echo $this->get_field_id('title'); ?>"><?php
        _e('Title:'); ?></label>
		<input class="widefat" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $title; ?>" /></p>

		<p><label for="<?php
        echo $this->get_field_id('nid'); ?>">QQ邮件列表订阅嵌入代码的ID</label>
		<input class="widefat" id="<?php
        echo $this->get_field_id('nid'); ?>" name="<?php
        echo $this->get_field_name('nid'); ?>" type="text" value="<?php
        echo $nid; ?>" /></p>

		<p><label for="<?php
        echo $this->get_field_id('info'); ?>">提示文字：</label>
		<input class="widefat" id="<?php
        echo $this->get_field_id('info'); ?>" name="<?php
        echo $this->get_field_name('info'); ?>" type="text" value="<?php
        echo $info; ?>" /></p>

		<p><label for="<?php
        echo $this->get_field_id('placeholder'); ?>">默认文字：</label>
		<input class="widefat" id="<?php
        echo $this->get_field_id('placeholder'); ?>" name="<?php
        echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php
        echo $placeholder; ?>" /></p>

		<p class="description">请到 <a href="http://list.qq.com/" target="_blank">QQ邮件列表</a> 申请订阅服务。</p>
<?php
    }
}
//彩色标签云小工具
add_action('widgets_init', 'wpone_tags');
function wpone_tags() {
    register_widget('wpone_tag');
}
class wpone_tag extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'weget-tags wow fadeInUp',
            'description' => '显示热门标签'
        );
        $this->WP_Widget('wpone_tag', 'O-标签云', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $count = $instance['count'];
        $offset = $instance['offset'];
        $mo = '';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        $tags_list = get_tags('orderby=count&order=DESC&number=' . $count . '&offset=' . $offset);
        if ($tags_list) {
            foreach ($tags_list as $tag) {
                echo '<a title="' . $tag->count . '个话题" target="_blank" href="' . get_tag_link($tag) . '">' . $tag->name . ' (' . $tag->count . ')</a>';
            }
        } else {
            echo '暂无标签！';
        }
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				名称：
				<input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				显示数量：
				<input id="<?php
        echo $this->get_field_id('count'); ?>" name="<?php
        echo $this->get_field_name('count'); ?>" type="number" value="<?php
        echo $instance['count']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				去除前几个：
				<input id="<?php
        echo $this->get_field_id('offset'); ?>" name="<?php
        echo $this->get_field_name('offset'); ?>" type="number" value="<?php
        echo $instance['offset']; ?>" class="widefat" />
			</label>
		</p>
<?php
    }
}
//特别推荐小工具
add_action('widgets_init', 'get_textbanners');
function get_textbanners() {
    register_widget('get_textbanner');
}
class get_textbanner extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'textbanner wow fadeInUp',
            'description' => '显示一个文本特别推荐'
        );
        $this->WP_Widget('get_textbanner', 'O-特别推荐', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $tag = $instance['tag'];
        $content = $instance['content'];
        $link = $instance['link'];
        $style = $instance['style'];
        $blank = $instance['blank'];
        $lank = '';
        if ($blank) $lank = ' target="_blank"';
        echo $before_widget;
        echo '<a class="' . $style . '" href="' . $link . '"' . $lank . '>';
        echo '<div class="title"><h2>' . $tag . '</h2></div>';
        echo '<h3 class="name">' . $title . '</h3>';
        echo '<p>' . $content . '</p>';
        echo '</a>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				名称：
				<input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				描述：
				<textarea id="<?php
        echo $this->get_field_id('content'); ?>" name="<?php
        echo $this->get_field_name('content'); ?>" class="widefat" rows="3"><?php
        echo $instance['content']; ?></textarea>
			</label>
		</p>
		<p>
			<label>
				标签：
				<input id="<?php
        echo $this->get_field_id('tag'); ?>" name="<?php
        echo $this->get_field_name('tag'); ?>" type="text" value="<?php
        echo $instance['tag']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				链接：
				<input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php
        checked($instance['blank'], 'on'); ?> id="<?php
        echo $this->get_field_id('blank'); ?>" name="<?php
        echo $this->get_field_name('blank'); ?>">新打开浏览器窗口
			</label>
		</p>
<?php
    }
}
//网站统计小工具
function get_tongji() {
    register_widget('get_tongji');
}
add_action('widgets_init', 'get_tongji');
class get_tongji extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_tongji wow fadeInUp',
            'description' => '显示网站的统计信息'
        );
        $this->WP_Widget(false, 'O-网站统计', $widget_ops);
    }
    function form($instance) {
        $instance = wp_parse_args((array)$instance, array(
            'title' => '网站统计',
            'establish_time' => '2016-01-01'
        ));
        $title = htmlspecialchars($instance['title']);
        $establish_time = htmlspecialchars($instance['establish_time']);
        $output = '<table>';
        $output.= '<tr><td>标题</td><td>';
        $output.= '<input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $instance['title'] . '" />';
        $output.= '</td></tr><tr><td>建站日期：</td><td>';
        $output.= '<input id="' . $this->get_field_id('establish_time') . '" name="' . $this->get_field_name('establish_time') . '" type="text" value="' . $instance['establish_time'] . '" />';
        $output.= '</td></tr></table>';
        echo $output;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['establish_time'] = strip_tags(stripslashes($new_instance['establish_time']));
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $establish_time = empty($instance['establish_time']) ? '2013-01-27' : $instance['establish_time'];
        echo $before_widget;
        echo $before_title . $title . $after_title;
        echo '<ul>';
        $this->efan_get_blogstat($establish_time);
        echo '</ul>';
        echo $after_widget;
    }
    function efan_get_blogstat($establish_time /*, $instance */) {
        global $wpdb;
        $count_posts = wp_count_posts();
        $published_posts = $count_posts->publish;
        $draft_posts = $count_posts->draft;
        $comments_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");
        $time = floor((time() - strtotime($establish_time)) / 86400);
        $count_tags = wp_count_terms('post_tag');
        $count_pages = wp_count_posts('page');
        $page_posts = $count_pages->publish;
        $count_categories = wp_count_terms('category');
        $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'");
        $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
        $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
        $last = date('Y-n-j', strtotime($last[0]->MAX_m));
        $output = '<li>日志总数：';
        $output.= $published_posts;
        $output.= ' 篇</li>';
        $output.= '<li>评论数目：';
        $output.= $comments_count;
        $output.= ' 条</li>';
        $output.= '<li>建站日期：';
        $output.= $establish_time;
        $output.= '</li>';
        $output.= '<li>运行天数：';
        $output.= $time;
        $output.= ' 天</li>';
        $output.= '<li>标签总数：';
        $output.= $count_tags;
        $output.= ' 个</li>';
        if (is_user_logged_in()) {
            $output.= '<li>草稿数目：';
            $output.= $draft_posts;
            $output.= ' 篇</li>';
            $output.= '<li>页面总数：';
            $output.= $page_posts;
            $output.= ' 个</li>';
            $output.= '<li>分类总数：';
            $output.= $count_categories;
            $output.= ' 个</li>';
            $output.= '<li>友链总数：';
            $output.= $link;
            $output.= ' 个</li>';
        }
        if (get_option("users_can_register") == 1) {
            $output.= '<li>用户总数：';
            $output.= $users;
            $output.= ' 个</li>';
        }
        $output.= '<li>最后更新：';
        $output.= $last;
        $output.= '</li>';
        echo $output;
    }
}

?>
