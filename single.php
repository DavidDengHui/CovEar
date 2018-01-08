<?php get_header(); ?>
<article class="mod-post mod-post__type-post">
	<header>
		<h1 class="mod-post__title"><?php the_title(); ?></h1>
	</header>
	<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
	<div class="mod-post__entry wzulli"><?php the_content(); ?></div>
	<?php wp_link_pages('before=<div class="posts-nav"><span> — 文章分页：</span>&after=</div>'); ?>
	<?php endwhile; ?>
	<div class="mod-post__meta">
	<div>
	  <div>— 于 <time datetime="<?php the_time('Y年m月d日 h:i:s'); ?>"><?php the_time('Y年m月d日'); ?></time>，<span><?php echo count_words ($text); ?></span>；</div>
	  <div>— 文内使用到的标签：<span class="mod_tag"><?php the_tags('', ' ', ''); ?></span></div>
	</div>
	</div>
	<ul class="sxwk">
		<li><?php previous_post_link( '下一篇：%link', '%title', true );?></li>
		<li><?php next_post_link( '上一篇：%link', '%title', true );?></li>
	</ul>
</article>
<section class="mod-comment">
	<?php comments_template(); ?>
</section>
<?php get_footer(); ?>