<?php
	session_start();
	error_reporting(0);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);

	$d->reset();
	$sql_setting = "select * from #_setting limit 0,1";
	$d->query($sql_setting);
	$row_setting= $d->fetch_array();

	if(!isset($_SESSION['lang'])){
		$lang=$row_setting['lang'];
	}else{
		$lang=$_SESSION['lang'];
	}
	include_once _source."lang_$lang.php";	
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	include_once _lib."counter.php"; 
	include_once _lib."Pagination.class.php";
	include_once _source."template.php";

?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?=$http.$config_url?>/">
<link id="favicon" rel="shortcut icon" href="<?=_upload_hinhanh_l.$favicon['thumb_'.$lang]?>" type="image/x-icon" />
<link rel="canonical" href="<?=getCurrentPageURL_CANO()?>" />
<title><?php if(!empty($title_bar)) echo $title_bar; else{ if(!empty($title_detail)) echo mb_convert_case($title_detail, MB_CASE_TITLE, "UTF-8").' | '; echo $row_setting['title']; } ?></title>
<meta name="description" content="<?php if($description_bar!='') echo $description_bar; else echo $row_setting['description']; ?>">
<meta name="keywords" content="<?php if($keywords_bar!='') echo $keywords_bar; else echo $row_setting['keywords']; ?>">
<?=$row_setting['meta']?>
<meta name="format-detection" content="telephone=no">
<meta name="robots" content="noodp,index,follow" />
<meta http-equiv="audience" content="General" />
<meta name="resource-type" content="Document" />
<meta name="distribution" content="Global" />
<meta name="google" content="notranslate" />
<meta name='revisit-after' content='1 days' />
<meta name="author" content="<?=$row_setting['ten_'.$lang]?>">
<meta property="og:site_name" content="<?php if(!empty($fb_tenweb)) echo $fb_tenweb;else echo $row_setting['ten_'.$lang]; ?>" />
<meta property="og:url" content="<?=getCurrentPageURL()?>" />
<meta property="og:type" content="<?php if(!empty($og_type)) echo $og_type;else echo 'website'; ?>" />
<meta property="og:title" content="<?php if(!empty($fb_title)) echo $fb_title;else echo $row_setting['title']; ?>" />
<meta property="og:image" content="<?php if(!empty($fb_link_full_img)) echo $fb_link_full_img;else echo _upload_hinhanh_l.$logo['photo_'.$lang]; ?>" />
<meta property="og:description" content="<?php if(!empty($fb_description)) echo $fb_description;else echo $row_setting['description']; ?>" />
<meta itemprop="name" content="<?php if(!empty($fb_title)) echo $fb_title;else echo $row_setting['title']; ?>">
<meta itemprop="description" content="<?php if(!empty($fb_description)) echo $fb_description;else echo $row_setting['description']; ?>">
<meta itemprop="image" content="<?php if(!empty($fb_link_full_img)) echo $fb_link_full_img;else echo _upload_hinhanh_l.$logo['photo_'.$lang]; ?>">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="<?php if(!empty($fb_tenweb)) echo $fb_tenweb;else echo $row_setting['ten_'.$lang]; ?>" />
<meta name="twitter:title" content="<?php if(!empty($fb_title)) echo $fb_title;else echo $row_setting['title']; ?>" />
<meta name="twitter:description" content="<?php if(!empty($fb_description)) echo $fb_description;else echo $row_setting['description']; ?>" />
<meta name="twitter:image" content="<?php if(!empty($fb_link_full_img)) echo $fb_link_full_img;else echo _upload_hinhanh_l.$logo['photo_'.$lang]; ?>" />
<?php include_once _template.'layout/css.php'; ?>
<?=$row_setting['script_top']?>
<?=$row_setting['analytics']?> 
<style type="text/css">
	#other{background: url(<?=_upload_hinhanh_l.$bg_other['photo_vi']?>) no-repeat center center;}
	#footer{background: url(<?=_upload_hinhanh_l.$bgfooter['photo_vi']?>) no-repeat center center;}
</style>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$site_key?>"></script>
<script>
    grecaptcha.ready(function () {
      <?php if($com=='lien-he'){ ?>
        grecaptcha.execute('<?=$site_key?>', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
      <?php } ?>
        <?php if($source=='index'){ ?>
        grecaptcha.execute('<?=$site_key?>', { action: 'email' }).then(function (token) {
            var recaptchaResponseEmail = document.getElementById('recaptchaResponseEmail');
            recaptchaResponseEmail.value = token;
        }); 
        <?php } ?>
    });
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;js.async=true;
js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
if($source == 'index'){ ?>
	<h1 style="visibility: hidden; height:0px; margin:0px; overflow:hidden;"><?=$row_setting['ten_'.$lang]?></h1>
    <?php
    }
?>
<div class="header-overlay"></div>
<div id="full">
    <div id="wrapper">
		<div id="header">
			<div class="container">
				<?php
				$d->reset();
			    $sql_banner_top= "select thumb_$lang from #_photo where type='logo'";
			    $d->query($sql_banner_top);
			    $logo_top = $d->fetch_array();
			    ?>
				<div class="logo"><a href=""><img class="img-responsive" src="<?=_upload_hinhanh_l.$logo_top['thumb_'.$lang]?>" alt="<?=$row_setting['ten_'.$lang]?>"></a></div>
				<div class="hotline">
					<?php $arr_hl = explode('-', $row_setting['hotline']); ?>
					<?php for($i=0;$i<count($arr_hl);$i++){ ?>
						<p><?=trim($arr_hl[$i]);?></p>
					<?php } ?>
				</div>
				<div class="search_tool">
					<div class="khung_timkiem">
					    <div class="timkiem">
							<input class="tu_khoa" name="timkiem" id="name_tk" type="text" placeholder="Tìm sản phẩm..." value="<?=$_GET['keywords']?>" onkeypress="return doEnter(event)">
							<input type="button" onclick="return do_search();" value="TÌM KIẾM">
							<div class="clearfix"></div>
					    </div>
					</div>
				</div>
				<div class="shopping_cart"><a href="gio-hang"><span class="qty_cart"><?=count_total_item_cart()?></span></a></div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div id="menu">
			<div class="container">
				<div class="menu_desk">
					<?php include _template."layout/menu.php";?>
				</div>
				<div id="menu_mobi">
					<div class="menu_mobile">
						<?php include _template."layout/menu_mobile.php";?>
					</div>
				</div>
			</div>
		</div>

		<?php if($source=='index') { ?>
			<div id="slider">
				<?php include _template."layout/slider.php";?>
			</div>

			<?php include_once _template.$template."_tpl.php"; ?>

    	<?php }else{ ?>
    		<div id="container" class="container">
    			<?php include _template."layout/breadcrumb.php";?>
    			<?php include_once _template.$template."_tpl.php"; ?>
	        </div>
    	<?php } ?>

        <?php include_once _template.'layout/footer.php'; ?>
        <div id="map_home"><?=$row_setting['googlemap']?></div>
    </div>
</div>
<?=$row_setting['vchat']?>
<?=$row_setting['script_bottom']?>
<ul class="vcard" style="display:none;">
   <li class="fn"><?=$row_setting['ten_'.$lang]?></li>
   <li class="org"><?=$row_setting['ten_'.$lang]?></li>
   <li class="adr"><?=$row_setting['diachi_'.$lang]?></li>
   <li class="tel"><?=$row_setting['dienthoai']?></li>
   <li><a class="email" href="mailto:<?=$row_setting['email']?>"></a></li>
   <li><img class="photo" src="<?=$http.$config_url?>/thumb/120x120/1/<?=_upload_hinhanh_l.$logo['photo_'.$lang]?>"></li>
   <li><a class="url" href="<?=$row_setting['website']?>"><?=$row_setting['website']?></a></li>
 </ul>
 <div id="back-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
<?php 
	include_once _template.'layout/js.php'; 
	include_once _template.'layout/json_strucdata.php';
	include_once _template.'layout/support_mb.php';
?>
</body>
</html>
