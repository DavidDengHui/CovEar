<?php get_header(); ?>
<article class="mod-archive">
	<div class="mod-archive__item"><div class="mod-archive__year"><?php single_cat_title(); ?></div>
		<ul class="mod-archive__list">
		<?php while( have_posts() ): the_post(); ?>	
			<li id="post-<?php the_ID(); ?>"><time class="mod-archive__time" datetime="<?php the_time('Y-m-d h:i:s'); ?>"><?php the_time('Y-m-d'); ?></time> <span>—</span> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ul>
		<div class="posts-nav">
		<?php echo paginate_links(array(
			'prev_next'          => 0,
			'before_page_number' => '',
			'mid_size'           => 2,
		));?>
		</div>
	</div>
</article>
<?php get_footer(); ?>