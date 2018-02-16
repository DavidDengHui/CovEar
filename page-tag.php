<?php
/*
Template Name: 标签页面
*/
?>
<?php get_header(); ?>
<article class="mod-archive">
<?php 
$tags = get_tags();
foreach ($tags as $key => $value) {
//echo $value->term_taxonomy_id;
$args = array(
'posts_per_page'      => -1,
'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
	'tag_id'              => $value->term_taxonomy_id, 
);
$tagpost = new WP_Query( $args );
?>
	<div class="mod-archive__item"><div class="mod-archive__year"><?php echo $value->name; ?></div>	
		<ul class="mod-archive__list">
		<?php if($tagpost->have_posts()) : ?>
		<?php while($tagpost->have_posts()) : $tagpost->the_post() ?>
			<li><time class="mod-archive__time" datetime="<?php the_time('Y-m-d h:i:s'); ?>"><?php the_time('Y-m-d'); ?></time> <span>—</span> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile;  ?>
		<?php endif; wp_reset_query(); ?>
		</ul>
	</div>
<?php
}
?>
</article>
<?php get_footer(); ?>