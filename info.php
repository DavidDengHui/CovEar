<?php

//Login Page
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css" />'."\n";
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
}
add_action('login_head', 'custom_login');

//Login Page Title
function custom_headertitle ( $title ) {
	return get_bloginfo('name')." - ".get_bloginfo('description')." - David Deng's Blog";
}
add_filter('login_headertitle','custom_headertitle');

//Login Page Link
function custom_loginlogo_url($url) {
	return esc_url( home_url('/') );
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

//Login Page Footer
function custom_html() {
	echo '<div class="footer">'."\n";
	echo '<p>Copyright &copy; '.date('Y').' <a  title="掩耳观常 - David Deng\'s Blog" href="/" target="_blank"><b><i>'.get_bloginfo("name").'</i></b></a> All Rights Reserved.'."\n";
	echo '</div>'."\n";
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/resizeBg.js"></script>'."\n";
	echo '<script type="text/javascript">'."\n";
	echo 'jQuery("body").prepend("<div class=\"loading\"><img src=\"'.get_bloginfo('template_directory').'/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");'."\n";
	echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.get_bloginfo('template_directory').'/images/login_bg.jpg\').load(function(){'."\n";
	echo '	resizeImage(\'bg\');'."\n";
	echo '	jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
	echo '	jQuery(\'.loading\').fadeOut();'."\n";
	echo '});';
	echo '</script>'."\n";
}
add_action('login_footer', 'custom_html');

//移除顶部多余信息
//remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
//remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
remove_action('wp_head', 'rsd_link');
//移除离线编辑器开放接口
remove_action('wp_head', 'wlwmanifest_link');
//移除离线编辑器开放接口
remove_action('wp_head', 'index_rel_link');
//去除本页唯一链接信息
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
//清除前后文信息
remove_action('wp_head', 'start_post_rel_link', 10, 0);
//清除前后文信息
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'locale_stylesheet');
remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'wp_print_styles', 8);
//载入css
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator');
//移除WordPress版本
remove_action('wp_head', 'rel_canonical');
remove_action('wp_footer', 'wp_print_footer_scripts');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
//删除仪表盘模块
function example_remove_dashboard_widgets()
{
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
    global $wp_meta_boxes;
    // 以下这一行代码将删除 "快速发布" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    // 以下这一行代码将删除 "引入链接" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    // 以下这一行代码将删除 "近期评论" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    // 以下这一行代码将删除 "近期草稿" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    // 以下这一行代码将删除 "概况" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');
remove_action('welcome_panel', 'wp_welcome_panel');
function remove_dashboard_meta()
{
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    //3.8版开始
}
add_action('admin_init', 'remove_dashboard_meta');

//自定义后台版权
function remove_footer_admin()
{
    echo 'Welcome to <a href="/" target="_blank"><b><i>CovEar</i></b></a> ! Made by <i>David Deng</i>.';
}
add_filter('admin_footer_text', 'remove_footer_admin');
function change_footer_version()
{
    echo 'Power by Wordpress';
}
add_filter('update_footer', 'change_footer_version', 9999);
//custom admin logo
function custom_logo()
{
    echo '<style type="text/css">
    #wp-admin-bar-wp-logo { display: none !important; }
    </style>';
}
add_action('admin_head', 'custom_logo');
/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');
/**
 * Filter function used to remove the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
//禁止头部加载s.w.org
function remove_dns_prefetch($hints, $relation_type)
{
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);