<div class="wrap_name">
  <div class="name_home">Cẩm nang <span>sức khỏe</span></div>
  <div class="bong_name"></div>
</div>
<?php  
$d->reset();
$sql = "select id,ten_$lang,tenkhongdau,photo,ngaytao,mota_$lang from #_baiviet where hienthi=1 and noibat=1 and type='camnang' order by stt,id desc limit 0,7";
$d->query($sql);
$arr_cnang = $d->result_array();
?>
<div class="col-xs-12 col-md-4 col-sm-12 col-other">
    <?php if(!empty($arr_cnang[0])){ ?>
      <div class="item_cnang news_big">
        <div class="img"><a href="<?=$arr_cnang[0]['tenkhongdau']?>"><img data-src="thumb/380x210/1/<?=_upload_baiviet_l.$arr_cnang[0]['photo']?>" class="img-responsive lazy" alt="<?=$arr_cnang[0]['ten_'.$lang]?>" /></a></div>
        <div class="name"><a href="<?=$arr_cnang[0]['tenkhongdau']?>" title="<?=$arr_cnang[0]['ten_'.$lang]?>"><?=$arr_cnang[0]['ten_'.$lang]?></a></div>
        <div class="des"><?=nl2br($arr_cnang[0]['mota_'.$lang])?></div>
      </div>
    <?php } ?>
</div>

<div class="col-xs-12 col-md-4 col-sm-12 col-other">
    <?php if(count($arr_cnang)>1){ ?>
      <?php  for($i=1; $i<4; $i++){ 
              if(!empty($arr_cnang[$i])){ ?>
                  <div class="item_cnang news_small">
                    <div class="img"><a href="<?=$arr_cnang[$i]['tenkhongdau']?>"><img data-src="thumb/133x97/1/<?=_upload_baiviet_l.$arr_cnang[$i]['photo']?>" class="img-responsive lazy" alt="<?=$arr_cnang[$i]['ten_'.$lang]?>" /></a></div>
                    <div class="info">
                      <div class="name"><a href="<?=$arr_cnang[$i]['tenkhongdau']?>" title="<?=$arr_cnang[$i]['ten_'.$lang]?>"><?=$arr_cnang[$i]['ten_'.$lang]?></a></div>
                      <div class="date"><?=date('d.m.Y',$arr_cnang[$i]['ngaytao'])?></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
              <?php } } ?>
    <?php } ?>
</div>

<div class="col-xs-12 col-md-4 col-sm-12 col-other">
  <?php if(count($arr_cnang)>4){ ?>
      <?php  for($i=4; $i<7; $i++){ 
              if(!empty($arr_cnang[$i])){ ?>
                  <div class="item_cnang news_small">
                    <div class="img"><a href="<?=$arr_cnang[$i]['tenkhongdau']?>"><img data-src="thumb/133x97/1/<?=_upload_baiviet_l.$arr_cnang[$i]['photo']?>" class="img-responsive lazy" alt="<?=$arr_cnang[$i]['ten_'.$lang]?>" /></a></div>
                    <div class="info">
                      <div class="name"><a href="<?=$arr_cnang[$i]['tenkhongdau']?>" title="<?=$arr_cnang[$i]['ten_'.$lang]?>"><?=$arr_cnang[$i]['ten_'.$lang]?></a></div>
                      <div class="date"><?=date('d.m.Y',$arr_cnang[$i]['ngaytao'])?></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
              <?php } } ?>
    <?php } ?>
</div>