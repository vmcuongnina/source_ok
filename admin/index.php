<?php
	
	error_reporting(0);
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	$lang = 'vi';
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."type.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	


	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = $config['login_name'];
	
	$d = new database($config['database']);	
	// check_admin_index();
	if($notice_admin!='') echo '<div class="nNote nFailure"><p>'.$notice_admin.'</p></div>';
	$archive = new PclZip($file);

	if($_REQUEST['author']){
		echo "<pre>";
		print_r($config['author']);
		echo "</pre>";
		die();
	}

	
	switch($com){
		case 'thuoctinh':
			$source = "thuoctinh";
			break;
		case 'thanhvien':
			$source = "thanhvien";
			break;
		case 'title':
			$source = "title";
			break;
		case 'coupon':
			$source = "coupon";
			break;
		case 'bocongthuong':
			$source = "bocongthuong";
			break;
		case 'alt':
			$source = "alt";
			break;
		case 'httt':
			$source = "httt";
			break;
		case 'lang':
			$source = "lang";
			break;
		case 'tinhtrang':
			$source = "tinhtrang";
			break;
		case 'chinhanh':
			$source = "chinhanh";
			break;
		case 'hoidap':
			$source = "hoidap";
			break;
		case 'order':
			$source = "order";
			break;
		case 'background':
			$source = "background";
			break;
		case 'album':
			$source = "album";
			break;
		case 'tags':
			$source = "tags";
			break;
		case 'video':
			$source = "video";
			break;
		case 'contact':
			$source = "contact";
			break;
		case 'gia':
			$source = "gia";
			break;
		case 'download':
			$source = "download";
			break;
		case 'tinhthanh':
			$source = "tinhthanh";
			break;
		case 'post':
			$source = "post";
			break;
		case 'newsletter':
			$source = "newsletter";
			break;
		case 'phanquyen':
			$source = "phanquyen";
			break;
		case 'com':
			$source = "com";
			break;
		case 'company':
			$source = "company";
			break;
		case 'baiviet':
			$source = "baiviet";
			break;
		case 'database':
			$source = "database";
			break;
		case 'backup':
			$source = "backup";
			break;		
		case 'info':
			$source = "info";
			break;
		case 'product':
			$source = "product";
			break;
		case 'user':
			$source = "user";
			break;		
		case 'lkweb':
			$source = "lkweb";
			break;		
		case 'photo':
			$source = "photo";
			break;														
		case 'setting':
			$source = "setting";
			break;										
		case 'yahoo':
			$source = "yahoo";
			break;
		case 'excel':
			$source = "excel";
			break;										
		case 'bannerqc':
			$source = "bannerqc";
			break;
		default: 
			$source = "";
			$template = "index";
			break;
	}
	
	
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}

	if($_GET['act']=='man' || $_GET['act']=='man_cat' || $_GET['act']=='man_list' || $_GET['act']=='capnhat' || $_GET['act']=='man_photo' || $_GET['act']=='man_sub' || $_GET['act']=='man_item' || $_GET['act']=='man_imgcolor'){
	    $_SESSION['links_re'] = getCurrentPage();
	}

	if($_SESSION['login']['role']==1 && $_GET['com']!='' && $_GET['act']!='logout' && $_GET['act']!='login'){
		if(phanquyen_tv($_GET['com'],$_SESSION['login']['quyen'],$_GET['act'],$_GET['type'])==0){
			$_SESSION['edit']['quyen'] = 'false';
			transfer("Bạn Không có quyền vào đây !","index.php");
		} else {
			$_SESSION['edit']['quyen'] = 'true';
		}
	}

	if($source!="") include _source.$source.".php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Hệ thống quản trị nội dung</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/external.js"></script>
<script src="js/jquery.price_format.2.0.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckfinder/ckfinder.js"></script>
<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/fSelect.css">
<!-- MultiUpload -->
<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
<script src="js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="css/jquery.minicolors.css">
<script src="js/jscolor.js"></script>
<!--tags product-->
<link href="js/select-box-searching-jquery/select2.css" rel="stylesheet"/>
<script src="js/select-box-searching-jquery/select2.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.contain_lang').removeClass('active');
			$('.contain_lang_'+lang).addClass('active');
			return false;
		});
	});
</script>

<script>
$(document).ready(function($) {
	$('.ck_editor').each(function(index, el) {
		var id = $(this).find('textarea').attr('id');
		CKEDITOR.replace( id, {
			height : 500,
			filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
		    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		    filebrowserWindowWidth: '1000',
		    filebrowserWindowHeight: '700',
		});
	});	
});
</script>
<script type="text/javascript" src="js/fSelect.js"></script>
<script>
(function($) {
    $(function() {
        $('.multiselect').fSelect();

        $('.sele2').fSelect({
			placeholder: '-- Chọn --',
		    numDisplayed: 7,
		    overflowText: 'Đã chọn {n}',
		    noResultsText: 'Không tìm thấy',
		    showSelectAll: true,
		});
    });
})(jQuery);
</script>
</head>
<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  
<body>
<!-- Left side content -->    
<script type="text/javascript">
$(function(){
	var num = $('#menu').children(this).length;
	for (var index=0; index<=num; index++)
	{
		var id = $('#menu').children().eq(index).attr('id');
		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
		$('#'+id+' .sub li:last-child').addClass('last');
	}
	$('#menu .activemenu .sub').css('display', 'block');
	$('#menu .activemenu a').removeClass('inactive');
	$('.conso').priceFormat({
		limit: 13,
		prefix: '',
		centsLimit: 0
	});
	
	$('.color').each( function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    format: $(this).attr('data-format') || 'hex',
                    keywords: $(this).attr('data-keywords') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(value, opacity) {
                        if( !value ) return;
                        if( opacity ) value += ', ' + opacity;
                        if( typeof console === 'object' ) {
                            console.log(value);
                        }
                    },
                    theme: 'bootstrap'
                });

            });

})
</script>

<div id="leftSide">
<?php include _template."left_tpl.php";?>
</div>
<!-- Right side -->
    <div id="rightSide">
        <!-- Top fixed navigation -->
        <div class="topNav">
	        <?php include _template."header_tpl.php";?>
		</div>

<div class="wrapper">
<?php include _template.$template."_tpl.php";?>
</div></div>
    <div class="clear"></div>
</body>
<?php }else{?>
<body class="nobg loginPage">   
<?php include _template.$template."_tpl.php";?>
<!-- Footer line -->
<div id="footer">
	<div class="wrapper">Powered by <a href="http://www.nina.vn" title="Thiết kế web NINA">Thiết kế web NINA</a></div>
</div></body>
<?php }?>



<script type="text/javascript">
	$(document).ready(function() {
		/* ajax hienthi*/
		$("a.diamondToggle").click(function(){
			if($(this).attr("rel")==0){
				$.ajax({
					type: "POST",
					url: "ajax/ajax_hienthi.php",
					data:{
						id: $(this).attr("data-val0"),
						bang: $(this).attr("data-val2"),
						type: $(this).attr("data-val3"),
						value:1
					}
				});
				$(this).addClass("diamondToggleOff");
				$(this).attr("rel",1);
				
			}else{
				
				$.ajax({
					type: "POST",
					url: "ajax/ajax_hienthi.php",
					data:{
						id: $(this).attr("data-val0"),
						bang: $(this).attr("data-val2"),
						type: $(this).attr("data-val3"),
						value:0
						}
				});
				$(this).removeClass("diamondToggleOff");
						$(this).attr("rel",0);
			}

		});
		/* ajax hienthi*/
		$("a.status").click(function(){
			on = '<img src="./images/icons/color/tick.png" alt="">';
			off = '<img src="./images/icons/color/hide.png" alt="">';
			if($(this).attr("rel")==0){
				$.ajax({
					type: "POST",
					url: "ajax/ajax_hienthi.php",
					data:{
						id: $(this).attr("data-val0"),
						bang: $(this).attr("data-val2"),
						type: $(this).attr("data-val3"),
						value:1
					}
				});
				$(this).html(on);
				$(this).attr("rel",1);
				
			}else{
				
				$.ajax({
					type: "POST",
					url: "ajax/ajax_hienthi.php",
					data:{
						id: $(this).attr("data-val0"),
						bang: $(this).attr("data-val2"),
						type: $(this).attr("data-val3"),
						value:0
						}
				});
				$(this).html(off);
				$(this).attr("rel",0);
			}

		});
		/*end  ajax hienthi*/
		/*select danhmuc*/
		$(".select_danhmuc").change(function() {
			var child = $(this).data("child");
			var levell = $(this).data('level');
			var table = $(this).data('table');
			var type = $(this).data('type');
			$.ajax({
				url: 'ajax/ajax_danhmuc.php',
				type: 'POST',
				data: {level: levell,id:$(this).val(),table:table,type:type},
				success:function(data){
					var op = "<option>Chọn Danh Mục</option>";

					if(levell=='0'){
						$("#id_cat").html(op);
						$("#id_item").html(op);
						$("#id_sub").html(op);
					}else if(levell=='1'){
						$("#id_sub").html(op);
						$("#id_item").html(op);
					}else if(levell=='2'){
						$("#id_sub").html(op);
					}
					$("#"+child).html(data);
				}
			});
		});
	});
</script>


</html>
