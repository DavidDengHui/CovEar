<?php
/*
Template Name: 文章归档
*/
?>
<?php get_header(); ?>
<?php 
$args = array(
	'posts_per_page'      => -1,
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1, 
);
$yearpost = new WP_Query( $args );
$i = 1; 
?>
<article class="mod-archive">
	<div class="mod-archive__item">
<?php if($yearpost->have_posts()) : ?>
	<?php while($yearpost->have_posts()) : $yearpost->the_post() ?>
		<?php if( $date != date( 'Y', strtotime($post->post_date) ) ){ ?>
		</ul>
		<div class="mod-archive__year"><?php echo date( 'Y', strtotime($post->post_date) ); ?></div>
		<ul class="mod-archive__list">
		<?php }else{ ?>
			<?php if( $i == 1 ){ ?>
				<div class="mod-archive__year"><?php echo date( 'Y', strtotime($post->post_date) ); ?></div>
				<ul class="mod-archive__list">
			<?php } ?>
		<?php } ?>
			<li id="post-<?php the_ID(); ?>"><time class="mod-archive__time" datetime="<?php the_time('Y-m-d h:i:s'); ?>"><?php the_time('Y-m-d'); ?></time> <span>—</span> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
	<?php $i++; $ul = 0; $date  =  date( 'Y', strtotime($post->post_date) ); endwhile;  ?>
<?php endif; wp_reset_query(); ?> 
	</div>
</article>
<?php get_footer(); ?>