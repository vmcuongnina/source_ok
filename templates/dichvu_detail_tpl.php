<div class="sub_main clearfix">
    <div class="wrap_name">
      <div class="name"><h1><?=$title_detail?></h1></div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main">
        <div class="text">
            <?=check_ssl_content($row_detail['noidung_'.$lang])?>
            <?php include_once _template.'layout/module/share.php'; ?>
            <div class="fb-comments" data-href="<?=getCurrentPageURL_CANO()?>" data-width="100%" data-numposts="5"></div>
        </div>
    </div>
</div>
<?php if(!empty($tintuc)){ ?>
  <div class="list_bvlq">
    <div class="name_bvlq"><?=$title_other?></div>
    <ul>
      <?php foreach($tintuc as $bv_khac){ ?>
        <li><a href="<?=$bv_khac['tenkhongdau']?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> <?=$bv_khac['ten_'.$lang]?></a></li>
      <?php } ?>
    </ul>
  </div>
<?php } ?>