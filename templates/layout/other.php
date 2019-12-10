<div class="col-xs-12 col-md-8 col-sm-12 col-other-l">
  <div class="name_home">
    <div class="wrap"><span>tin tức - sự kiện</span></div>
  </div>
  <div class="line_other"></div>
  <div class="content news">
    <div class="row">
    <?php
      $d->reset();
      $sql = "select * from #_baiviet where hienthi=1 and noibat=1 and type='tintuc' order by stt,id desc limit 0,4";
      $d->query($sql);
      $arr_tintuc_nb = $d->result_array();
      if(isset($arr_tintuc_nb[0])){
        $mx = $arr_tintuc_nb[0];
        ?>
        <div class="big-news col-md-6 col-sm-12 col-xs-12">
          <div class="news-thumbnail">
            <a href="<?=$mx['tenkhongdau']?>" title="<?=$mx['ten_'.$lang]?>">
              <img data-src="thumb/360x250/1/<?=_upload_baiviet_l.$mx['photo']?>" class="img-responsive lazy" alt="<?=$mx['ten_'.$lang]?>" />
            </a>
          </div>
          <div class="news-desc">
            <h4><a href="<?=$mx['tenkhongdau']?>" title="<?=$mx['ten_'.$lang]?>"><?=$mx['ten_'.$lang]?></a></h4>
            <div class="desc">
              <?=$mx['mota_'.$lang]?>
              <div class="clear"></div>
            </div>
            <!-- <div class="view-more"><a href="<?=$mx['tenkhongdau']?>">XEM THÊM</a></div> -->
          </div>
          <div class="clear"></div>
        </div><!-- end big-news-->

        <div class="list-news-small col-md-6 col-sm-12 col-xs-12">
          <?php
          $i=0;
            foreach($arr_tintuc_nb as $k=>$vx){
              if($k){
                $i++;
                ?>
                <div class="small-item">
                    <a href="<?=$vx['tenkhongdau']?>" title="<?=$vx['ten_'.$lang]?>">
                    <img data-src="thumb/150x100/1/<?=_upload_baiviet_l.$vx['photo']?>" alt="<?=$vx['ten_'.$lang]?>" class="img-responsive lazy"/>
                  </a>
                  <div class="info">
                    <h4><a href="<?=$vx['tenkhongdau']?>" title="<?=$vx['ten_'.$lang]?>"><?=$vx['ten_'.$lang]?></a></h4>
                    <div class="desc"><?=$vx['mota_'.$lang]?></div> 
                    <!-- <div class="date_create">(<?=date('d-m-Y H:i',$vx['ngaytao']);?>)</div> -->
                  </div>
                  <div class="clearfix"></div>
                </div>

                <?php
                if($i%2==0){
                  echo '<div class="clear"></div>';
                }
              }
            }
          ?>
        </div>
        <?php
      }

    ?>

    </div>
  </div><!-- end content-news-->

</div>



  <div class="col-xs-12 col-md-4 col-sm-12 col-other-r">

      <div class="name_home">
        <div class="wrap"><span>video clip</span></div>
      </div>
      <div class="line_other"></div>
      <div class="content">
          <?php
            $d->reset();
            $sql="select * from #_video where hienthi=1 and type='video' order by stt asc, id desc";
            $d->query($sql);
            $video=$d->result_array();
        ?>
        <?php if(!empty($video)) { ?>
            
        
            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-thumbheight="75" data-thumbwidth="120">
                <?php for($i=0; $i<count($video); $i++){?>
                    <a href="http://youtube.com/watch?v=<?=youtobi($video[$i]['links'])?>">
                        <img src="https://img.youtube.com/vi/<?=youtobi($video[$i]['links'])?>/0.jpg" alt="<?=$video[$i]['ten_'.$lang]?>">
                    </a>
                <?php } ?>  
            </div>
        <?php } ?>
      </div><!-- end content -->

  </div>

  <div class="clear"></div>
