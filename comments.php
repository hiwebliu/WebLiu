<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>

<div class="post-comments article_item wow fadeInUp">
	<h3>评论：<span><?php $id=$post->ID; echo get_post($id)->comment_count;?>条</span></h3>
	<ol class="commentlist">
	<?php
		if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
	?>
<li class="decmt-box">
    <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
</li>
<?php
    } else if ( !comments_open() ) {
?>
<li class="decmt-box">
    <p><a href="#addcomment">评论功能已经关闭!</a></p>
</li>
<?php
    } else if ( !have_comments() ) {
?>
    <p>还没有任何评论，你来说两句吧！</p>
<?php
    } else {
        $num = webliu_option('comments-floor');
        wp_list_comments('type=comment');
    }
?>
	</ol>
	<div class="cl"></div>
</div>


<div class="post-comments article_item submit-comment wow fadeInUp">
<?php comment_form($defaults = array(
        'fields'               => apply_filters( 'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author comment_item">' . '<label for="author">' . __( '昵称(必填)' ) . '</label> ' . ( $req ? '<span class="required"></span>' : '' ) .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
				'email'  => '<p class="comment-form-email comment_item"><label for="email">' . __( '邮箱(必填)' ) . '</label> ' . ( $req ? '<span class="required"></span>' : '' ) .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
				'url'    => '<p class="comment-form-url comment_item"><label for="url">' . __( '你的网址' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
				)),
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="说有用的话，做有用的人"></textarea></p>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( '需 <a href="%s">登录</a> 才能评论.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Hi,你好 <a href="%1$s">%2$s</a>. <a href="%3$s" title="退出当前用户">退出?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
    )); ?>
</div>
