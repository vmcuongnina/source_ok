<div class="col-xs-12 col-md-4 col-sm-12 col-other">
      <div class="title"><h3>chứng nhận sản phẩm</h3></div>
      <div class="line_other"></div>
      <div class="content">
          <?php
              $d->reset();
              $sql= "select ten_$lang as ten,link,photo_vi from #_photo where hienthi=1 and type='gcn' order by stt,id desc";
              $d->query($sql);
              $gcn = $d->result_array();
          ?>
          <div class="wrap">
            <div class="swiper-gcn">
                <div class="swiper-wrapper">
                <?php for($j=0,$count_ch=count($gcn);$j<$count_ch;$j++){?>
                  <div class="swiper-slide">
                    <a class="fcb" data-fancybox="gcn" data-type="image" href="<?=_upload_hinhanh_l.$gcn[$j]['photo_vi']?>"><img class="img-responsive img_gcn lazy" alt="<?=$gcn[$j]['ten']?>" data-src="<?=_upload_hinhanh_l.$gcn[$j]['photo_vi']?>"/></a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
      </div><!-- end content -->

  </div>

<div class="col-xs-12 col-md-4 col-sm-12 col-other">
  <div class="title"><h3>cảm nhận khách hàng</h3></div>
  <div class="line_other"></div>
  <div class="content">
    <?php
        $d->reset();
        $sql= "select ten_$lang as ten,link,photo_vi from #_photo where hienthi=1 and type='img_kh' order by stt,id desc";
        $d->query($sql);
        $img_kh = $d->result_array();
    ?>
    <div class="wrap">
      <div class="swiper-gcn">
          <div class="swiper-wrapper">
          <?php for($j=0,$count_ch=count($img_kh);$j<$count_ch;$j++){?>
            <div class="swiper-slide">
              <a class="fcb" data-fancybox="img_kh" data-type="image" href="<?=_upload_hinhanh_l.$img_kh[$j]['photo_vi']?>"><img class="img-responsive img_gcn lazy" alt="<?=$img_kh[$j]['ten']?>" data-src="<?=_upload_hinhanh_l.$img_kh[$j]['photo_vi']?>"/></a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div><!-- end content-news-->

</div>



  <div class="col-xs-12 col-md-4 col-sm-12 col-other">

      <div class="title"><h3>Video tiêu biểu</h3></div>
      <div class="line_other"></div>
      <div class="content">
          <?php
            $d->reset();
            $sql="select * from #_video where hienthi=1 and type='video' order by stt asc, id desc";
            $d->query($sql);
            $video=$d->result_array();
        ?>
        <?php if(!empty($video)) { ?>
            
        
            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-thumbheight="80" data-thumbwidth="120">
                <?php for($i=0; $i<count($video); $i++){?>
                    <a href="http://youtube.com/watch?v=<?=youtobi($video[$i]['links'])?>">
                        <img src="https://img.youtube.com/vi/<?=youtobi($video[$i]['links'])?>/0.jpg" alt="<?=$video[$i]['ten_'.$lang]?>">
                    </a>
                <?php } ?>  
            </div>
        <?php } ?>
      </div><!-- end content -->

  </div>