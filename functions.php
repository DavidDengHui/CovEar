<?php
//theme info
include( 'info.php' );

//谷歌字体
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

//移除左上角WordPress Logo
function annointed_admin_bar_remove() {
        global $wp_admin_bar;
        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);


//注册导航
register_nav_menus(
      array(
       'main' => __( '主菜单导航' )
      )
   );
   
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

//编辑器增强
 function enable_more_buttons($buttons) {
     $buttons[] = 'hr';
     $buttons[] = 'del';
     $buttons[] = 'sub';
     $buttons[] = 'sup'; 
     $buttons[] = 'fontselect';
     $buttons[] = 'fontsizeselect';
     $buttons[] = 'cleanup';   
     $buttons[] = 'styleselect';
     $buttons[] = 'wp_page';
     $buttons[] = 'anchor';
     $buttons[] = 'backcolor';
     return $buttons;
     }
add_filter("mce_buttons_3", "enable_more_buttons");

//给文章图片自动添加alt和title信息
add_filter('the_content', 'imagesalt');
function imagesalt($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}

/*激活友情链接后台*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//文章字数统计
function count_words ($text) {  
    global $post;
    $sum = 0;
    if ( !isset($text) ) $text = $post->post_content;
    $sum = mb_strlen(preg_replace('/\s/', '', html_entity_decode(strip_tags($text) ) ), 'UTF-8');
    $output = '共写了'.$sum.'个字';
    return $output;  
}

//头像问题
function replace_gravatar($avatar) {
	$avatar = str_replace(array("gravatar.com", "secure.gravatar.com", "www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com", "cn.gravatar.com"), "sdn.geekzu.org", $avatar);
	return $avatar;
}
add_filter( 'get_avatar', 'replace_gravatar' );

//去除分类标志代码
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
    global $wp_rewrite;
    $wp_rewrite -> flush_rules();
}
// register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
// function no_category_base_deactivate() {
//  remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
//  // We don't want to insert our custom rules again
//  no_category_base_refresh_rules();
// }
// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
    global $wp_rewrite, $wp_version;
    if (version_compare($wp_version, '3.4', '<')) {
        // For pre-3.4 support
        $wp_rewrite -> extra_permastructs['category'][0] = '%category%';
    } else {
        $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
    }
}
// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
    //var_dump($category_rewrite); // For Debugging
    $category_rewrite = array();
    $categories = get_categories(array('hide_empty' => false));
    foreach ($categories as $category) {
        $category_nicename = $category -> slug;
        if ($category -> parent == $category -> cat_ID)// recursive recursion
            $category -> parent = 0;
        elseif ($category -> parent != 0)
            $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
        $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
        $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
    }
    // Redirect support from Old Category Base
    global $wp_rewrite;
    $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
    $old_category_base = trim($old_category_base, '/');
    $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
    //var_dump($category_rewrite); // For Debugging
    return $category_rewrite;
}
// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
    $public_query_vars[] = 'category_redirect';
    return $public_query_vars;
}
// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
    //print_r($query_vars); // For Debugging
    if (isset($query_vars['category_redirect'])) {
        $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
        status_header(301);
        header("Location: $catlink");
        exit();
    }
    return $query_vars;
}
/*
//禁json
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
*/
//禁emoj
function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
    // Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    // Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );
/**
 * Removes the 'wpembed' TinyMCE plugin.
 *
 * @since 1.0.0
 *
 * @param array $plugins List of TinyMCE plugins.
 * @return array The modified list.
 */
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}
/**
 * Remove all rewrite rules related to embeds.
 *
 * @since 1.2.0
 *
 * @param array $rules WordPress rewrite rules.
 * @return array Rewrite rules without embeds rules.
 */
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}

/**
 * Remove embeds rewrite rules on plugin activation.
 *
 * @since 1.2.0
 */
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
/**
 * Flush rewrite rules on plugin deactivation.
 *
 * @since 1.2.0
 */
function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

/**最新文章数*/
function get_posts_count_from_last_24h($post_type ='post') {
    global $wpdb;
    $numposts = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(ID) ".
            "FROM {$wpdb->posts} ".
            "WHERE ".
                "post_status='publish' ".
                "AND post_type= %s ".
                "AND post_date> %s",
            $post_type, date('Y-m-d H:i:s', strtotime('-24 hours'))
        )
    );
    return $numposts;
}
//注册状态形式
add_theme_support( 'post-formats', array( 'status' ) );
//添加状态文章模板
//add_action('template_include', 'load_single_template');
//function load_single_template($template) {
//  $new_template = '';
//  if( is_single() ) {
//    global $post;
//    if ( has_post_format( 'status' )) {
//      $new_template = locate_template(array('single-status.php' ));
//    }
//  }
//  return ('' != $new_template) ? $new_template : $template;
//}


//标签去a
function tages(){
	global $post;
	$a = wp_get_post_tags($post->ID);
	$c = '';
	if( $a ){
	foreach($a as $b ){
		$c .= $b->name.', ';
	}
	echo ''.rtrim($c, ' , ').'';
	}
}

//自定义背景
add_custom_background();


//对分类目录描述改写
function ithink_del_tags($str){
return trim(strip_tags($str));
}
add_filter('category_description', 'ithink_del_tags');


//首页文字颜色
function sg_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'sg_style_options[header_bgcolor]', array(
        'default'        => '#535353',
        'type'           => 'option',
        'capability'     => 'edit_theme_options',
        'transport'      => 'postMessage'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bgcolor_html_id', array(
        'label'        => __( '首页文字颜色', 'your_textdomain' ),
        'section'    => 'colors',
        'settings'   => 'sg_style_options[header_bgcolor]',
    ) ) );
}
add_action( 'customize_register', 'sg_customize_register' );
function sg_customize_css()
{
$options = get_option('sg_style_options');
?>
<style type="text/css">.indexcolor,.willerce a{color:<?php echo  $options['header_bgcolor']; ?> !important;}</style>
<?php
}
add_action( 'wp_head', 'sg_customize_css');

//自定义logo
function puma_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_logo',array(
        'title'     => '博主头像',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_logo_image', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo_image', array(
         'label'     => '博主头像',
         'section'   => 'header_logo'
    ) ) );
}
add_action( 'customize_register', 'puma_customize_register' );

//自定义博主描述

function ms_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_bzms',array(
        'title'     => '博主描述',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_bzms', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_bzms', array(
         'label'     => '首页描述',
         'section'   => 'header_bzms'
    ) ) );
}
add_action( 'customize_register', 'ms_customize_register' );

//自定义地址
function dz_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_dzzb',array(
        'title'     => '博主地址',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_dzzb', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_dzzb', array(
         'label'     => '博主地址',
         'section'   => 'header_dzzb'
    ) ) );
}
add_action( 'customize_register', 'dz_customize_register' );

//自定义首页关键词
function gjc_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_guanjianci',array(
        'title'     => '首页关键词',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_guanjianci', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_guanjianci', array(
         'label'     => '首页的关键词，每个词之间用英文逗号隔开',
         'section'   => 'header_guanjianci'
    ) ) );
}
add_action( 'customize_register', 'gjc_customize_register' );

//分类关键词
global $texonomy_slug_keywords;
$texonomy_slug_keywords='category';
add_action($texonomy_slug_keywords.'_add_form_fields','categorykeywords');
function categorykeywords($taxonomy){ ?>
    <div>
    <label for="tag-keywords">分类关键词</label>
    <input type="text" name="tag-keywords" id="tag-keywords" value="" /><br /><span>请在此输入分类关键词。</span>    
</div>
<?php }
add_action($texonomy_slug_keywords.'_edit_form_fields','categorykeywordsedit');
function categorykeywordsedit($taxonomy){ ?>
<tr class="form-field">
    <th scope="row" valign="top"><label for="tag-keywords">关键词</label></th>
    <td><input type="text" name="tag-keywords" id="tag-keywords" value="<?php echo get_option('_category_keywords'.$taxonomy->term_id); ?>" /><br /><span class="description">请在此输入分类关键词。</span></td>
</tr>              
<?php  }
add_action('edit_term','categorykeywordssave');
add_action('create_term','categorykeywordssave');
function categorykeywordssave($term_id){
    if(isset($_POST['tag-keywords'])){
        if(isset($_POST['tag-keywords']))
            update_option('_category_keywords'.$term_id,$_POST['tag-keywords'] );
    }
}


//评论者新标签打开
function hu_popuplinks($text) {
	$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
	return $text;
}
add_filter('get_comment_author_link', 'hu_popuplinks', 6);

//冒充评论检验
function CheckEmailAndName(){
	global $wpdb;
	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	if(!$comment_author || !$comment_author_email){
		return;
	}
	$result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
	if ($result_set) {
		if ($result_set[0]->display_name == $comment_author){
			err(__('警告: 您不能使用博主的昵称！'));
		}else{
			err(__('警告: 您不能使用博主的邮箱！'));
		}
		fail($errorMessage);
	}
}
add_action('pre_comment_on_post', 'CheckEmailAndName');

//评论回复邮件通知（所有回复都邮件通知）*（美化版）
function comment_mail_notify($comment_id) {
$comment = get_comment($comment_id);
$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
$spam_confirmed = $comment->comment_approved;
if (($parent_id != '') && ($spam_confirmed != 'spam')) {
$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
$to = trim(get_comment($parent_id)->comment_author_email);
$subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
$message = '
<div style="background-color:#fff; border:1px solid #666666; color:#111;
-moz-border-radius:8px; -webkit-border-radius:8px; -khtml-border-radius:8px;
border-radius:8px; font-size:12px; width:702px; margin:0 auto; margin-top:10px;
font-family:微软雅黑, Arial;">
<div style="background:#666666; width:100%; height:60px; color:white;
-moz-border-radius:6px 6px 0 0; -webkit-border-radius:6px 6px 0 0;
-khtml-border-radius:6px 6px 0 0; border-radius:6px 6px 0 0; ">
<span style="height:60px; line-height:60px; margin-left:30px; font-size:12px;">
您在<a style="text-decoration:none; color:#00bbff;font-weight:600;"
href="' . get_option('home') . '">' . get_option('blogname') . '
</a>博客上的留言有回复啦！</span></div>
<div style="width:90%; margin:0 auto">
<p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
<p>您曾在 [' . get_option("blogname") . '] 的文章
《' . get_the_title($comment->comment_post_ID) . '》 上发表评论:
<p style="background-color: #EEE;border: 1px solid #DDD;
padding: 20px;margin: 15px 0;">' . nl2br(get_comment($parent_id)->comment_content) . '</p>
<p>' . trim($comment->comment_author) . ' 给您的回复如下:
<p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;
margin: 15px 0;">' . nl2br($comment->comment_content) . '</p>
<p>您可以点击 <a style="text-decoration:none; color:#00bbff"
href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复的完整內容</a></p>
<p>欢迎再次光临 <a style="text-decoration:none; color:#00bbff"
href="' . get_option('home') . '">' . get_option('header_bzms') . '</a></p>
<p>(此邮件由系统自动发出, 请勿回复.)</p>
</div>
</div>';
$message = convert_smilies($message);
$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
wp_mail( $to, $subject, $message, $headers );
//echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
}
}
add_action('comment_post', 'comment_mail_notify');

/*
 * 屏蔽 REST API
 *//*
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
// 移除头部wp-json标签与HTTP header中的link
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);
add_filter('rest_authentication_errors', 'demo_disable_rest_api');
function demo_disable_rest_api($access)
{
    return new WP_Error('rest_disabled', __('The REST API on this site has been disabled.'), ['status' => rest_authorization_required_code()]);
}*/
