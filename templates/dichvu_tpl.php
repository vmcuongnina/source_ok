<div class="sub_main">
    <div class="wrap_name">
      <div class="name"><h1><?=$title_detail?></h1></div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main">
        <div class="row">
        <?php  if(!empty($tintuc)){?>
            <?php foreach ($tintuc as $key => $value) { ?>
                <div class="col-dv col-md-3 col-sm-4 col-xs-6">
                    <div class="item_dv">
                        <div class="img"><a href="<?=$value['tenkhongdau']?>"><img src="thumb/350x235/1/<?=_upload_baiviet_l.$value['photo']?>" alt="<?=$value['ten']?>"></a></div>
                        <div class="info">
                          <div class="name"><h3><a href="<?=$value['tenkhongdau']?>"><?=$value['ten_'.$lang]?></a></h3></div>
                          <div class="des"><?=$value['mota_'.$lang]?></div>
                          <div class="view"><a href="<?=$value['tenkhongdau']?>">XEM THÊM</a></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php } ?>
        </div>

        <div class="wrap"><div class="auto"><?=$paging?></div></div>
    </div>
</div><!--end sub main-->