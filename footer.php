<footer class="mod-footer" role="contentinfo" id="footer_in">
	<p class="f_bq">
		<?php //if($word_t2!=""){echo $word_t2;}else{echo 'Copyright';} ?>Copyright &copy; 2014-<?php echo date("Y"); echo " <a class='banquan' title='";bloginfo('name');echo '：'; bloginfo('description');echo "' target='_blank' href='//covear.top/'>"; bloginfo('name'); echo '</a><a title="View Information" href="https://icp.chinaz.com/home/info?host=covear.top" target="_blank"> · </a><a href="http://beian.miit.gov.cn/" target="_blank">湘ICP备17019987号</a>'; ?></p>
</footer>
<script>
POWERMODE.colorful = true; // ture 为启用礼花特效
POWERMODE.shake = true; // false 为禁用震动特效
document.body.addEventListener('input', POWERMODE);
var com = document.getElementById('comment');
if ( com != null ) {
  com.setAttribute('placeholder', '有启发？疑问？吐槽？...说点什么吧(^_^)');
}
</script>
<div style="display:none;">

<!-- CNZZ访问统计 -->
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1272718072'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1272718072' type='text/javascript'%3E%3C/script%3E"));</script>

<!-- 百度访问统计 -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?033d0f0f069aa0b757ad3668391b5bc6";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<!-- 百度自动推送工具 -->
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https'){
   bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
  }
  else{
  bp.src = 'http://push.zhanzhang.baidu.com/push.js';
  }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('a[href^="http"]').each(function() {
			$(this).attr('target', '_blank');
		});
	});
</script>

</div>
<?php wp_footer(); ?>
</body></html>
