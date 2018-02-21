<?php get_header(); ?>
<article class="mod-archive">
	<div style="font-size: .5em;color: #999;">
		<p>
		现在是北京时间<span id="time"><?php
    date_default_timezone_set("PRC");
    echo '
    <script type="text/javascript">
        var dayNames = new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
            function get_obj(time){
                return document.getElementById(time);
            }
            var ts = '.(round(microtime(true)*1000)).';
            function getTime(){
                var t = new Date(ts);
                with(t) {
                    var _time = ""+getFullYear()+"年" + (getMonth()+1)+"月"+getDate()+"日" + (getHours()<10 ? "0" :"") + getHours() + "时" + (getMinutes()<10 ? "0" :"") + getMinutes() + "分" + (getSeconds()<10 ? "0" :"") + getSeconds() + "秒";
                }
                get_obj("time").innerHTML = _time;
                setTimeout("getTime()", 1000);
                ts += 1000;
            }
            getTime();
    </script>';
		?></span>
		<br />
		博客24小时内更新文章<?php echo get_posts_count_from_last_24h(); ?>篇
		</p>
	</div>
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