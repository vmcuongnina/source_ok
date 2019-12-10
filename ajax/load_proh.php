<?php
	session_start();
	error_reporting(0);

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];
	
	@define ( '_lib' , '../libraries/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";;
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
    
	$d = new database($config['database']);
	$fel = $d->escape_str($_POST['fel']);
	$d->reset();
    $sql = "select ten_$lang as ten,id,tenkhongdau,photo,giaban,giacu,name_$lang as name from #_product where type='product' and hienthi=1 and $fel=1 order by stt,id desc";
    $d->query($sql);
    $arr_spnb = $d->result_array();
    if(!empty($arr_spnb)){ ?>
        <div class="swiper-proh">
            <div class="swiper-wrapper">
                <?php foreach($arr_spnb as $spnb){ ?>
                    <div class="swiper-slide">
                      <div class="item_dv">
                        <div class="img">
                          <a href="<?=$spnb['tenkhongdau']?>">
                            <img class="img-responsive" src="thumb/270x270/2/<?=_upload_product_l.$spnb['photo']?>" alt="<?=$spnb['ten']?>"><div class="icon"></div>
                            <?php if($spnb['giacu']>0){ ?><div class="sale"><?=get_sale($spnb['giacu'],$spnb['giaban'])?></div><?php } ?>
                          </a>
                          <div class="buy" data-id="<?=$spnb['id']?>"><a href="javascript:void(0);">Thêm vào giỏ hàng</a></div>
                        </div>
                        <div class="info">
                          <div class="name"><h3><a href="<?=$spnb['tenkhongdau']?>"><?=$spnb['ten']?></a></h3></div>
                          <div class="price">
                            <span class="giaban"><?php if($spnb['giaban']>0) echo number_format($spnb['giaban'],0,',','.').'đ';else echo 'Liên hệ'; ?></span>
                            <?php if($spnb['giacu']>0){ ?><span class="giacu"><?=number_format($spnb['giacu'],0,',','.').'đ'; ?></span><?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } 
	die();
?>