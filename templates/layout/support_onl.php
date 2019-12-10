<style>
.support-online {
    position: fixed;
    z-index: 999;
    left: 0;
    bottom:0px;
}
.support-online a {
    position: relative;
    margin: 20px 20px;
    text-align: left;
    width: 40px;
    height: 40px;
}
.support-online i {
    width: 40px;
    height: 40px;
    background: #43a1f3;
    color: #fff;
    border-radius: 100%;
    font-size: 20px;
    text-align: center;
    line-height: 1.9;
    position: relative;
    z-index: 999;
}
.support-online a span {
    border-radius: 2px;
    text-align: center;
    background: rgb(103, 182, 52);
    padding: 9px;
    display: none;
    width: 180px;
    margin-left: 10px;
    position: absolute;
    color: #ffffff;
    z-index: 999;
    top: 0px;
    left: 40px;
    transition: all 0.2s ease-in-out 0s;
    -moz-animation: headerAnimation 0.7s 1;
    -webkit-animation: headerAnimation 0.7s 1;
    -o-animation: headerAnimation 0.7s 1;
    animation: headerAnimation 0.7s 1;
}
.support-online a:hover span {
    display: block;
}
.support-online a {
    display: block;
}
.support-online a span:before {
    content: "";
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 10px 10px 10px 0;
    border-color: transparent  rgb(103, 182, 52) transparent transparent;
    position: absolute;
    left: -10px;
    top: 10px;
}
.kenit-alo-circle-fill {
    width: 60px;
    height: 60px;
    top: -10px;
    position: absolute;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
    background-color: rgba(0, 175, 242, 0.5);
    opacity: .75;
    right: -10px;
}
.kenit-alo-circle {
    width: 50px;
    height: 50px;
    top: -5px;
    right: -5px;
    position: absolute;
    background-color: transparent;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid rgba(30, 30, 30, 0.4);
    opacity: .1;
    border-color: #0089B9;
    opacity: .5;
}
.support-online .btn-support {
    cursor: pointer;
}
.sms i{background: red}
.call-now i{background: green}
.mes i{background: orange}
</style>

<div class="support-online">
  <div class="support-content" style="display: block;">
    <a href="tel:<?=$row_setting['hotline']?>" class="call-now" rel="nofollow">
      <i class="fa fa-whatsapp"></i>
          <div class="animated infinite zoomIn kenit-alo-circle"></div>
          <div class="animated infinite pulse kenit-alo-circle-fill"></div>
        <span>Hotline: <?=$row_setting['hotline']?></span>
    </a>
    <a class="mes" href="lien-he">
      <i class="fa fa-map-marker"></i>
      <span>Chỉ đường</span>
    </a>
    <a class="zalo" href="https://zalo.me/<?=$row_setting['txt1']?>" target="_blank">
      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAABNVBMVEUAAAAPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOIPqOL///8Amd0And4An98Lp+IAouAssuYAlNxbwutXwesJpeEEpOEAoOAnsOUeruQDo+AAmt76/f/2/P6C0fBLvekQquMAkdvu+f3X8Ptxy+5hxew6t+chrOQZrOTl9vzi9fvO7vqX2fN3ze9sye1nx+0hr+QAjdny+/7C6fiw4/aP1vKF0/BTv+pEu+g+uegytOYTpeLb8vuc3PR8z+8AgNXe8/vG6vi75fad0vCAyO1Yu+hMuOcPoN8fmt4Qlt2NjwQdAAAAJ3RSTlMA85i7+c6QGuXf3MKdbjnrxYBzYC8oDAfpx7GnjmdZVEgS7NeDdiCGRF/0AAACR0lEQVQ4y4XU5XbiQBiA4QkttEDdu/W175toSUgJUtxdilTW5f4vYSchi7SEPH/CObxnBCZD5h1c+IJ+jls/9WxuEUfHe0GY4f24trj7dAKvrJ4fvc22vLDA+tXrbg8c+Oa7DXC04tw5l5uwlIfYDsHFpR36wc2NvWFX76xwFdwd2jsJ8xPS/aJwg4Ve1jUS/X4iZLqVI2CjdBpyR+aWBbmFE+n8uBQjz3FNnJRX5AKA1lkQDY3uTHJh/K2gI94JM/+kj4W3LCwlm4oiSRJV7wVKDV7JIcoC+0g1c9U7ZMcO8elnNgMirWeVQrybyOV1FipyrxIKh1kZIOtWONYRaB4Hv1PWWoeIkozMN0EF2CbcNCxTnn/EwhOWfpQw9RCNFsqY/t7COAXgZsLWiFcqGM3GUH4ZYiwUK2YwdvcSwjQbkpuZeqDwVfbIIIabGkYfYl/imOKbOhY1Dd4T7/+wmxTVau+5qhex+6eKxQSbHTH7t4dfDRH8xGOHZcWQJCWZbCYzaIol2MgVxChiwgDwkk37By/n842Gruu5Bo2nsN3ujNpsbR3EUo2K5uHdAuBzOGNoGPcFQYhEJI0dFnkgGqyDfUICAJHcrzg+1rK1TK3ej4AoSaqqgqoBiAKvWW84uwt22ZNPypWwQk2C48m9AYvADqIz6yLyASOKsMQOsXDg5vM4vHbrdonNA2PuV0VwWec/JlMrzt2H8XXqOvvKMZm3v+q8j3lrZwuGOyCLHGxsz93gZ9fEydHleTBwwnHbgVPP/vwm/gGGlNWDeHz9cwAAAABJRU5ErkJggg==" alt="icon zalo">
      <span>Zalo: <?=$row_setting['txt1']?></span>
    </a>
    <a class="sms" href="sms:0902997668">
      <i class="fa fa-comments"></i>
      <span>SMS: <?=$row_setting['hotline']?></span>
    </a>
  </div>
  <a class="btn-support">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i class="fa fa-user-circle" aria-hidden="true"></i>
  </a>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $('.support-content').hide();
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