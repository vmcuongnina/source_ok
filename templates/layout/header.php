<div id="header" class="clearfix" style="background: url(<?=_upload_hinhanh_l.$bgbanner['photo_'.$lang]?>) no-repeat center top;">
  <div id="banner">
    <div class="inner">
      <?php if(!$_GET['id']){ ?>
      <h1 class="vcard"><?php if($title_bar!='') echo $title_bar; else echo $row_setting['title']; ?></h1>
      <?php } ?>
        <div class="logo">
          <a href=""><img src="<?=_upload_hinhanh_l.$logo['thumb_'.$lang]?>" alt="<?=$row_setting['ten_'.$lang]?>" class="mw100"/></a>
        </div>
        <div class="company"><img src="<?=_upload_hinhanh_l.$banner['thumb_'.$lang]?>" alt="<?=$row_setting['ten_'.$lang]?>" class="mw100"/></div>

        <div class="hotline">
          <?php for($i=0; $i<count($arr_hl);$i++){ ?>
            <p>
              <span class="num"><?=$arr_hl[$i]['facebook']?></span>
              <span class="name"><?=$arr_hl[$i]['ten']?></span>
            </p>
          <?php } ?>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
</div>