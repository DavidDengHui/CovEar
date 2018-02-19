<?php
/*
Template Name: 博客首页
*/
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
<meta name="keywords" content="<?php echo get_option('header_guanjianci'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon"/>
<?php wp_head();?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style>
@font-face {
  font-family: "iconfont";
  src: url('<?php bloginfo('template_directory'); ?>/font/iconfont.eot?t=1490325857091'); /* IE9*/
  src: url('<?php bloginfo('template_directory'); ?>/font/iconfont.eot?t=1490325857091#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('<?php bloginfo('template_directory'); ?>/font/iconfont.woff?t=1490325857091') format('woff'), /* chrome, firefox */
  url('<?php bloginfo('template_directory'); ?>/font/iconfont.ttf?t=1490325857091') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
  url('<?php bloginfo('template_directory'); ?>/font/iconfont.svg?t=1490325857091#iconfont') format('svg'); /* iOS 4.1- */
}
.iconfont {
  font-family:"iconfont" !important;
  font-style:normal;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.icon-guanbi:before { content: "\e600"; }
.icon-shang:before { content: "\e751"; }
.icon-fenlei:before { content: "\e611"; }
.icon-quotes-down:before { content: "\e60e"; }
.icon-quotes-up:before { content: "\e60f"; }
.icon-zuobiao:before { content: "\e61b"; }
.icon-zuobiao{margin-right: 10px;font-weight: 600;}
*{margin:0;padding:0}body{font:400 16px/1.62 "Microsoft JhengHei", sans-serif;color:#535353;overflow:auto}.willerce{text-align:center;margin:4.5rem auto  auto;max-width:500px;padding:0 20px}.willerce a{color:#535353;text-decoration:underline}.willerce a:link,.willerce a:visited{text-decoration:underline}h1{font-size:26px;color:#424242;margin-bottom:20px}.avatar{border-radius:64px;}.weather{border-radius:10px;}.nav a{padding:0 6px 0 6px}@keyframes fade-in{0%{opacity:0}40%{opacity:0}100%{opacity:1}}@-webkit-keyframes fade-in{0%{opacity:0}40%{opacity:0}100%{opacity:1}}.willerce{animation:fade-in;animation-duration:1s;-webkit-animation:fade-in 1s}
.sydlogo{position:relative;width:128px;height:128px;margin:0 auto;margin-bottom:35px;}
.wtlogo{position:relative;width:72px;height:72px;margin:0 auto;margin-bottom:35px;}
.zjgx {position:absolute;background:#f00;font-size:16px;height:40px;width:40px;line-height:40px;text-align:center;top:0px;right:0px;border-radius:20px;color:#fff;}
@font-face {
font-family: 'home-font';
	src: url('<?php bloginfo('template_directory'); ?>/font/home-font.eot');
	src: url('<?php bloginfo('template_directory'); ?>/font/home-font.eot#iefix') format('embedded-opentype'),
	     url('<?php bloginfo('template_directory'); ?>/font/home-font.woff') format('woff'),
	     url('<?php bloginfo('template_directory'); ?>/font/home-font.woff2') format('woff2'),
	     url('<?php bloginfo('template_directory'); ?>/font/home-font.ttf') format('truetype'),
	     url('<?php bloginfo('template_directory'); ?>/font/home-font.svg#home-font') format('svg');
	font-weight: normal;
	font-style: normal;
}
@font-face {
font-family: 'zhcn-font';
    src: url('<?php bloginfo('template_directory'); ?>/font/zhcn-font.otf') format("opentype");
	font-weight: normal;
	font-style: normal;
}
html{background-image:url('<?php bloginfo('template_directory'); ?>/images/bg1.jpg');background-position:center center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;}body{font-family:'home-font';}.ch{font-family:'zhcn-font';}
</style>
</head>
<body class="custom-background">
<div class="willerce">
	<div class="sydlogo">
		<?php 
		if ( !get_option('header_logo_image') ) {
			echo '<img class="avatar" width="128" height="128" src="'.get_stylesheet_directory_uri().'/images/logo.png">'; 
		} 
		else { 
			echo '<img class="avatar" width="128" height="128" src="'.get_option('header_logo_image').'">';
		}
		?>
	</div>
	<h1 class="indexcolor"><?php bloginfo('name'); ?></h1>
	<p class="indexcolor"><?php echo get_option('header_bzms'); ?></p>
	<p class="indexcolor" style="height: 24px; line-height: 24px; margin: 15px 0;">
		<i class="iconfont icon-zuobiao"></i><?php echo get_option('header_dzzb'); ?><br />
		You are here <i class="iconfont icon-zuobiao"></i><span class="ch">
    <?php 
    //$ip = $_SERVER["REMOTE_ADDR"];
    //$ip = "60.205.39.198";
    //$ip = "120.78.131.131"; 
    //$ip = "119.39.133.2";
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } 
        else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } 
        else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } 
    else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } 
        else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } 
        else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    //$realip = "255.255.255.255";
    $host = "https://dm-81.data.aliyun.com";
    $path = "/rest/160601/ip/getIpInfo.json";
    $method = "GET";
    $appcode = "e699bdf46b8d4d48bc5ec6ddd3997b44";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "ip=".$realip;
    $bodys = "";
    $url = $host . $path . "?" . $querys;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $data = json_decode(curl_exec($curl), true);
    if ( $data['code'] == 0 ) {
        if ( $data['data']['city_id'] == "local" ) {
            $city = "深圳";
            echo "中国广东省深圳市阿里云";
        }
        else {
            if ( $data['data']['country_id'] == "IANA" ) {
                $city = "株洲";
                echo "未知地点";
            }
            else {
                $city = $data['data']['city'];
                echo $data['data']['country'].$data['data']['region'].$data['data']['city'].$data['data']['isp'];
            }
        }
    }
    else {
        $city = "株洲";
        echo "未知地点";
    }
    ?> 
	</span></p>
    <br /><br />
	<p class="nav">
	<?php   
	$menuParameters = array(  
	'container' => false,  
	'echo' => false,  
	'items_wrap' => '%3$s',  
	'depth' => 0,  
	'theme_location'=>'main',
	);  
	echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );  
	?> 
	</p>
    <br />
    <h2 class="indexcolor">Weather</h2>
    <p class="indexcolor"><span class="ch">
    <?php
    $host = "http://jisutqybmf.market.alicloudapi.com";
    $path = "/weather/query";
    $method = "GET";
    $appcode = "e699bdf46b8d4d48bc5ec6ddd3997b44";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    if( $city == "" ) $city = "株洲";
    $querys = "city=".$city."&citycode=citycode&cityid=cityid&ip=ip&location=location";
    $bodys = "";
    $url = $host . $path . "?" . $querys;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://")) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $data = json_decode(curl_exec($curl), true);
    echo $data['result']['city']." : ".$data['result']['weather'];
    ?>
    </span></p>
    <div class="wtlogo">
		<?php echo '<img class="weather" width="72" height="72" src="'.get_template_directory_uri().'/images/weather/'.$data['result']['img'].'.png">';?>
	</div>
</div>
<div style="display:none;">
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1272718072'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1272718072' type='text/javascript'%3E%3C/script%3E"));</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?033d0f0f069aa0b757ad3668391b5bc6";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</div>
</body></html>
