<?php
// 新文章同步到新浪微博
function post_to_sina_weibo($post_ID) {
    /* 此处修改为通过文章自定义栏目来判断是否同步 */
    if (get_post_meta($post_ID, 'git_weibo_sync', true) == 1) return;
    $get_post_info = get_post($post_ID);
    $get_post_centent = get_post($post_ID)->post_content;
    $get_post_title = get_post($post_ID)->post_title;
    if ($get_post_info->post_status == 'publish' && $_POST['original_post_status'] != 'publish') {
        $appkey = wpztw_option('postto_sina_appkey'); /* 此处是你的新浪微博appkey */
        $username = wpztw_option('postto_sina_name');
        $userpassword = wpztw_option('postto_sina_psd');
        $request = new WP_Http;
        $keywords = "";
        /* 获取文章标签关键词 */
        $tags = wp_get_post_tags($post_ID);
        foreach ($tags as $tag) {
            $keywords = $keywords . '#' . $tag->name . "#";
        }
        /* 修改了下风格，并添加文章关键词作为微博话题，提高与其他相关微博的关联率 */
        $string1 = '【' . strip_tags($get_post_title) . '】：';
        $string2 = $keywords . ' [阅读全文]：' . get_permalink($post_ID);
        /* 微博字数控制，避免超标同步失败 */
        $wb_num = (138 - WeiboLength($string1 . $string2)) * 2;
        $status = $string1 . mb_strimwidth(strip_tags(apply_filters('the_content', $get_post_centent)) , 0, $wb_num, '...') . $string2;
        $api_url = 'https://api.weibo.com/2/statuses/update.json';
        $body = array(
            'status' => $status,
            'source' => $appkey
        );
        $headers = array(
            'Authorization' => 'Basic ' . base64_encode("$username:$userpassword")
        );
        $result = $request->post($api_url, array(
            'body' => $body,
            'headers' => $headers
        ));
        /* 若同步成功，则给新增自定义栏目git_weibo_sync，避免以后更新文章重复同步 */
        add_post_meta($post_ID, 'git_weibo_sync', 1, true);
    }
}
    add_action('publish_post', 'post_to_sina_weibo', 0);
/*
获取微博字符长度函数
*/
function WeiboLength($str) {
    $arr = arr_split_zh($str); //先将字符串分割到数组中
    foreach ($arr as $v) {
        $temp = ord($v); //转换为ASCII码
        if ($temp > 0 && $temp < 127) {
            $len = $len + 0.5;
        } else {
            $len++;
        }
    }
    return ceil($len); //加一取整
}
/*
//拆分字符串函数,只支持 gb2312编码
//参考：http://u-czh.iteye.com/blog/1565858
*/
function arr_split_zh($tempaddtext) {
    $tempaddtext = iconv("UTF-8", "GBK//IGNORE", $tempaddtext);
    $cind = 0;
    $arr_cont = array();
    for ($i = 0; $i < strlen($tempaddtext); $i++) {
        if (strlen(substr($tempaddtext, $cind, 1)) > 0) {
            if (ord(substr($tempaddtext, $cind, 1)) < 0xA1) { //如果为英文则取1个字节
                array_push($arr_cont, substr($tempaddtext, $cind, 1));
                $cind++;
            } else {
                array_push($arr_cont, substr($tempaddtext, $cind, 2));
                $cind+= 2;
            }
        }
    }
    foreach ($arr_cont as & $row) {
        $row = iconv("gb2312", "UTF-8", $row);
    }
    return $arr_cont;
}