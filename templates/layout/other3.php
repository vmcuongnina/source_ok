<div class="col-xs-12 col-md-5 col-sm-12 col-other">
  <div class="title"><h3>Ý kiến khách hàng</h3></div>
  <div class="line_other"></div>
  <div class="content news">
      <?php
      $d->reset();
      $sql = "select ten_$lang,id,tenkhongdau,photo,mota_$lang from #_baiviet where hienthi=1 and type='ykien' order by stt,id desc";
      $d->query($sql);
      $arr_ykien = $d->result_array(); 
      if(!empty($arr_ykien)){
      ?>
        
        <div class="slick_yk">
          <?php foreach($arr_ykien as $k=>$vx){ ?>
            <div>
                <div class="item_ykien">
                  <div class="img"><img src="thumb/134x134/2/<?=_upload_baiviet_l.$vx['photo']?>" alt="<?=$vx['ten_'.$lang]?>" class="img-responsive"/></div>
                  <div class="info">
                    <div class="desc"><?=nl2br($vx['mota_'.$lang])?></div> 
                    <div class="line"></div>
                    <div class="name"><?=$vx['ten_'.$lang]?></div>
                  </div>
                  <div class="clearfix"></div>
                </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
  </div>
</div>



  <div class="col-xs-12 col-md-7 col-sm-12 col-other">
      <div class="title"><h3>Đặt dịch vụ nhanh</h3></div>
      <div class="line_other"></div>
      <div class="txt_other">Nhập thông tin của bạn và gửi yêu cầu cho chúng tôi ! Phi Long Hải sẽ phản hồi sớm và nhanh nhất cho bạn</div>
      <div class="content">
          <form method="post" name="frm" id="frm" action="lien-he" enctype="multipart/form-data">
            <div class="frm_contact2">
              <div class="wrap">
                <input name="ten" type="text"  id="ten" size="50" required="required" placeholder="<?=_hovaten?>"/>
                <input name="diachi" type="text" size="50" id="diachi" required="required" placeholder="<?=_diachi?>"/>
                <input name="dienthoai" type="text" id="dienthoai" size="50" required="required" placeholder="<?=_dienthoai?>"/>
              <input name="email" type="email"  size="50" id="email" required="required" placeholder="Email"/>
              </div>
              <textarea name="noidung" cols="50" rows="6" placeholder="<?=_noidung?>"></textarea>
              <div class="btn_action">
                <input type="submit" value="GỬI" class="btn btn-success" name="sub_dv">
              </div>
              
              </div>
          </form>
      </div>
  </div>
