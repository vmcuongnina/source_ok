<div class="sub_main">
     <div class="wrap_name">
        <div class="name"><h1><?=$title_detail?></h1></div>
        <div class="bong_name"></div>
      </div>
    <div class="content_main">
        <div class="box_fotorama">
            <div class="fotorama" data-arrows="true"  data-loop="true" data-autoplay="4000" data-fit="contain" data-allowfullscreen="true" data-stopautoplayontouch="false" data-width="800" data-nav="thumbs">
                <?php for($i=0,$count_ab=count($album_images);$i<$count_ab;$i++){?>
                <img src="<?=_upload_album_l.$album_images[$i]['photo']?>" alt="<?=$album_detail[0]['ten_'.$lang]?>">
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="text"><?=$album_detail['noidung_'.$lang]?></div>
    <?php include_once _template.'layout/module/share.php'; ?>
</div>