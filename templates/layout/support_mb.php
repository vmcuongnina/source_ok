<style type="text/css">
.support-online {position: fixed; z-index: 9999; left: 0; bottom:0px;}
.support-content{display: block;}
.support-online .item-sp {position: relative; margin: 20px 10px; text-align: left; width: 40px; height: 40px; border-radius: 50%;}
.support-online i {width: 40px; height: 40px; color: #fff;  font-size: 20px; text-align: center; line-height: 1.9; position: relative; z-index: 999; }
.support-online .item-sp span {border-radius: 2px; text-align: center; background: #db0000; padding: 10px; min-width: 120px;display: none; margin-left: 8px; position: absolute; color: #ffffff; z-index: 999; top: 0px; left: 40px; transition: all 0.2s ease-in-out 0s; -moz-animation: headerAnimation 0.7s 1; -webkit-animation: headerAnimation 0.7s 1; -o-animation: headerAnimation 0.7s 1; animation: headerAnimation 0.7s 1; }
.support-online .item-sp:hover span {display: block; }
.support-online .item-sp {display: block; }
.support-online .item-sp span:before {content: ""; width: 0; height: 0; border-style: solid; border-width: 10px 10px 10px 0; border-color: transparent  #db0000 transparent transparent; position: absolute; left: -9px; top: 10px; }
.kenit-alo-circle-fill {width: 60px; height: 60px; top: -10px; position: absolute; -webkit-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -ms-transition: all 0.2s ease-in-out; -o-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out; -webkit-border-radius: 100%; -moz-border-radius: 100%; border-radius: 100%; border: 2px solid transparent; -webkit-transition: all .5s; -moz-transition: all .5s; -o-transition: all .5s; transition: all .5s; opacity: .75; right: -10px; }
.kenit-alo-circle {width: 50px; height: 50px; top: -5px; right: -5px; position: absolute; background-color: transparent; -webkit-border-radius: 100%; -moz-border-radius: 100%; border-radius: 100%; border: 2px solid rgba(30, 30, 30, 0.4); opacity: .1; opacity: .5; }
.support-online .btn-support {cursor: pointer; }
.support-online .item-sp p{margin: 0px;}
.support-online .item-sp span a
{
  line-height: normal;
  display: block;
  color: #fff;
  padding: 5px 0px;
  font-size: 15px;
}
.support-online .item-sp img
{
  margin-left: 5px;
  margin-top: 5px;
  position: relative;
  z-index: 11111;
  border-radius: 0 10px 10px 0;
}
.support-online .item-sp.btn-support{background: #db0000;}
.support-online .item-sp.call-now{background: #008000;}
.support-online .item-sp.zal{background: #0fa8e2;}
.support-online .item-sp.sms{background: #db0000;}
.support-online .item-sp.lfb{background: #4267b2;}
.support-online .item-sp.mess{background: #db0000;}
.support-online .item-sp.mapc{background: #ffa500;}
.alo_mau{background-color: #db0000;}
.alo_mau_fill{background-color: rgba(219, 0, 0, 0.45);}
.alo_mau1{background-color: #008000;}
.alo_mau1_fill{background-color: rgba(0, 128, 0, 0.45);}
.alo_mau2{background-color: #0fa8e2;}
.alo_mau2_fill{background-color: rgba(15, 168, 226, 0.45);}
@media(max-width: 1024px){
  .support-content{display: none;}
}
</style>
<?php
$arr_hl = array_map('trim', explode('-', $row_setting['hotline']));
$arr_zl = array_map('trim', explode('-', $row_setting['txt1']));
?>


<div class="support-online">
  <div class="support-content">
    <div class="item-sp call-now">
      <i class="fa fa-whatsapp"></i>
      <div class="animated infinite zoomIn kenit-alo-circle alo_mau1"></div>
      <div class="animated infinite pulse kenit-alo-circle-fill alo_mau1_fill"></div>
      <?php if(!empty($arr_hl)) { ?>
        <span>
          <?php foreach($arr_hl as $hll) { ?>
            <a target="blank" href="tel:<?=$hll?>">
              <p>gọi ngay</p>
            </a>
          <?php } ?>
        </span>
      <?php } ?>
    </div>
    <div class="item-sp zal">
      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAABNVBMVEUAAAAPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOL///8Amd0And4An98Lp+IAouAssuYAlNxbwutXwesJpeEEpOEAoOAnsOUeruQDo+AAmt76/f/2/P6C0fBLvekQquMAkdvu+f3X8Ptxy+5hxew6t+chrOQZrOTl9vzi9fvO7vqX2fN3ze9sye1nx+0hr+QAjdny+/7C6fiw4/aP1vKF0/BTv+pEu+g+uegytOYTpeLb8vuc3PR8z+8AgNXe8/vG6vi75fad0vCAyO1Yu+hMuOcPoN8fmt4Qlt2NjwQdAAAAJ3RSTlMA85i7+c6QGuXf3MKdbjnrxYBzYC8oDAfpx7GnjmdZVEgS7NeDdiCGRF/0AAACR0lEQVQ4y4XU5XbiQBiA4QkttEDdu/W175toSUgJUtxdilTW5f4vYSchi7SEPH/CObxnBCZD5h1c+IJ+jls/9WxuEUfHe0GY4f24trj7dAKvrJ4fvc22vLDA+tXrbg8c+Oa7DXC04tw5l5uwlIfYDsHFpR36wc2NvWFX76xwFdwd2jsJ8xPS/aJwg4Ve1jUS/X4iZLqVI2CjdBpyR+aWBbmFE+n8uBQjz3FNnJRX5AKA1lkQDY3uTHJh/K2gI94JM/+kj4W3LCwlm4oiSRJV7wVKDV7JIcoC+0g1c9U7ZMcO8elnNgMirWeVQrybyOV1FipyrxIKh1kZIOtWONYRaB4Hv1PWWoeIkozMN0EF2CbcNCxTnn/EwhOWfpQw9RCNFsqY/t7COAXgZsLWiFcqGM3GUH4ZYiwUK2YwdvcSwjQbkpuZeqDwVfbIIIabGkYfYl/imOKbOhY1Dd4T7/+wmxTVau+5qhex+6eKxQSbHTH7t4dfDRH8xGOHZcWQJCWZbCYzaIol2MgVxChiwgDwkk37By/n842Gruu5Bo2nsN3ujNpsbR3EUo2K5uHdAuBzOGNoGPcFQYhEJI0dFnkgGqyDfUICAJHcrzg+1rK1TK3ej4AoSaqqgqoBiAKvWW84uwt22ZNPypWwQk2C48m9AYvADqIz6yLyASOKsMQOsXDg5vM4vHbrdonNA2PuV0VwWec/JlMrzt2H8XXqOvvKMZm3v+q8j3lrZwuGOyCLHGxsz93gZ9fEydHleTBwwnHbgVPP/vwm/gGGlNWDeHz9cwAAAABJRU5ErkJggg==" alt="icon zalo" width="30">
      <div class="animated infinite zoomIn kenit-alo-circle alo_mau2"></div>
      <div class="animated infinite pulse kenit-alo-circle-fill alo_mau2_fill"></div>
      <?php if(!empty($arr_zl)) { ?>
        <span>
          <?php foreach($arr_zl as $hll) { ?>
            <a target="blank" href="https://zalo.me/<?=$hll?>">
              <p>nhắn qua Zalo</p>
            </a>
          <?php } ?>
        </span>
      <?php } ?>
    </div>
    
    <div class="item-sp sms">
      <i class="fa fa-comments"></i>
      <?php if(!empty($arr_hl)) { ?>
        <span>
          <?php foreach($arr_hl as $hll) { ?>
            <a target="blank" href="sms:<?=$hll?>">
              <p>nhắn tin sms</p>
            </a>
          <?php } ?>
        </span>
      <?php } ?>
    </div>
    <div class="item-sp lfb">
      <i class="fa fa-facebook-official" aria-hidden="true"></i>
      <span>
        <a href="<?=$row_setting['facebook']?>" target="_blank">
          <p>vào fanpage</p>
        </a>
      </span>
    </div>
    <div class="item-sp mapc">
      <i class="fa fa-map-marker"></i>
      <span>
        <a href="lien-he" target="_blank">
          <p>vị trí shop</p>
        </a>
      </span>
      
    </div>
  </div>
  <a class="item-sp btn-support">
    <div class="animated infinite zoomIn kenit-alo-circle alo_mau"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill alo_mau_fill"></div>
    <i class="fa fa-user" aria-hidden="true"></i>
  </a>
</div>
<script>
  $(document).ready(function(){
    $('a.btn-support').click(function(e){
      e.stopPropagation();
      $('.support-content').slideToggle();
    });
    $('.support-content').click(function(e){
      e.stopPropagation();
    });
    $(document).click(function(){
      $('.support-content').slideUp();
    });
  });
</script>