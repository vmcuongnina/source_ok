<div class="icon_home"></div>
<div class="title_main title_main2"><span>dịch vụ của chúng tôi</span></div>
<div class="slogan"><?=$row_setting['slogan_'.$lang]?></div>
<div class="list_dv">
  <?php
  $d->reset();
  $sql = "select id,ten_$lang as ten, mota_$lang as mota, photo, tenkhongdau from #_baiviet where hienthi=1 and noibat=0 and type='dichvu' order by stt,id desc";
  $d->query($sql);
  $arr_dv = $d->result_array();
  if(!empty($arr_dv)){ ?>
    <ul class="ul_home" id="itemContainer_dv">
    <?php foreach($arr_dv as $dv){ ?>
     
          <li class="item_dv">
            <div class="img"><a href="<?=$dv['tenkhongdau']?>"><img src="thumb/362x266/1/<?=_upload_baiviet_l.$dv['photo']?>" alt="<?=$dv['ten']?>"></a></div>
            <div class="info">
              <div class="name"><a href="<?=$dv['tenkhongdau']?>"><?=$dv['ten']?></a></div>
              <div class="des"><?=$dv['mota']?></div>
              <div class="view"><a href="<?=$dv['tenkhongdau']?>">XEM THÊM</a></div>
            </div>
          </li>
      
    <?php } ?>
    </ul>

    <div class="paging"><div class="holder holder_dv"></div></div>
  <?php } ?>
</div>