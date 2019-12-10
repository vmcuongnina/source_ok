
<div class="col-xs-12 col-md-7 col-sm-12 col-other col-other-l">
  <div class="title"><h3>Tin tức nổi bật</h3></div>
  <div class="line_other"></div>
  <div class="content">
      <?php
      $d->reset();
      $sql = "select * from #_baiviet where hienthi=1 and noibat=1 and type='tintuc' order by stt,id desc limit 0,4";
      $d->query($sql);
      $arr_tintuc_nb = $d->result_array();
      if(!empty($arr_tintuc_nb)){ ?>
        <div class="col-news-small">
          <?php foreach($arr_tintuc_nb as $k=>$vx){ ?>
                <div class="news-item">
                  <div class="img">
                    <a href="<?=$vx['tenkhongdau']?>" title="<?=$vx['ten_'.$lang]?>">
                      <img data-src="thumb/227x156/1/<?=_upload_baiviet_l.$vx['photo']?>" alt="<?=$vx['ten_'.$lang]?>" class="img-responsive lazy"/>
                    </a>
                  </div>
                  <div class="info">
                    <div class="date_create">
                      <p class="ngay"><?=date('d',$vx['ngaytao']);?></p>
                      <p class="thang">Tháng <?=date('m',$vx['ngaytao']);?></p>
                    </div>
                    <h4><a href="<?=$vx['tenkhongdau']?>" title="<?=$vx['ten_'.$lang]?>"><?=$vx['ten_'.$lang]?></a></h4>
                    <div class="clearfix"></div>
                    <div class="desc"><?=$vx['mota_'.$lang]?></div> 
                  </div>
                  <div class="clearfix"></div>
                </div>

            <?php } ?>
        </div>
      <?php } ?>
  </div>
</div>
<div class="col-xs-12 col-md-5 col-sm-12 col-other col-other-r">
    <div class="title"><h3>Video clip</h3></div>
    <div class="line_other"></div>
    <div class="content">
        <?php
          $d->reset();
          $sql="select * from #_video where hienthi=1 and type='video' order by stt asc, id desc";
          $d->query($sql);
          $video=$d->result_array();
      ?>
      <?php if(!empty($video)) { ?>
          <iframe id="ifr_video" src="https://www.youtube.com/embed/<?=youtobi($video[0]['links'])?>"></iframe>
          
          <select id="sel_vd" class="form-control">
            <?php for($i=0; $i<count($video); $i++){?>
                <option value="<?=youtobi($video[$i]['links'])?>"><?=$video[$i]['ten_'.$lang]?></option>
              <?php } ?>  
          </select> 
      <?php } ?>
    </div>

</div>
<div class="clearfix"></div>