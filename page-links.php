<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>
<article class="mod-post mod-post__type-page">
	<div class="mod-post__entry">
		<div class="linksul"><?php wp_list_bookmarks('show_images=0&show_description=1'); ?></div>	
	</div>
</article>
<?php get_footer(); ?>