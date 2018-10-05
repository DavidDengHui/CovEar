<title><?php if ( is_home() ) { ?><?php bloginfo('name'); ?><?php } ?><?php if ( is_single() ) { ?><?php the_title(); ?> - <?php bloginfo('name'); ?><?php } ?><?php if ( is_page() ) { ?><?php the_title(); ?> - <?php bloginfo('name'); ?><?php } ?><?php if ( is_category() ) { ?><?php single_cat_title(); ?> - <?php bloginfo('name'); ?><?php } ?><?php if ( is_tag() ) { ?><?php single_cat_title(); ?> - <?php bloginfo('name'); ?><?php } ?></title>
<?php {
$category_info = get_the_category();
$category_id = $category_info[0]->cat_ID;
$cat_keywords = get_option('_category_keywords'.$category_id);
?>
<meta name="keywords" content="<?php if (is_home()) {echo '';} elseif (is_page()) { echo '';} elseif (is_single()) { echo tages();} elseif (is_category()){echo $cat_keywords;} elseif (is_tag()){echo tages();} ?>" />
<?php } ?>
<meta name="description" content="<?php if (is_home()) {echo bloginfo('description');} elseif (is_page()) { echo mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,220);} elseif (is_single()) { echo mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,220);} elseif (is_category()){echo strip_tags(category_description());} elseif (is_tag()){echo strip_tags(category_description());} ?>" />
