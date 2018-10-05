<?php get_header(); ?>
<article class="mod-post mod-post__type-page">
	<header>
		<h1 class="mod-post__title"><?php the_title(); ?></h1>
	</header>
	<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
		<div class="mod-post__entry">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</article>
<section class="mod-comment">
	<?php comments_template(); ?>
</section>
<?php get_footer(); ?>