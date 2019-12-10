<script language="javascript" type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
  function doEnter(e) {
      //See notes about 'which' and 'key'
      if (e.keyCode == 13) {
          do_search();
      }
  }
  function doEnter2(e) {
      //See notes about 'which' and 'key'
      if (e.keyCode == 13) {
          do_search2();
      }
  }
  function do_search() {
      var b = $("#name_tk").val();
      return b ? (window.location.href = "tim-kiem.html&keywords=" + b, !0) : (alert("Nhập từ khóa tìm kiếm"), document.getElementById("name_tk").focus(), !1)
  }

  function do_search2() {
      var a = $("#name_tk2").val();
      return a ? (window.location.href = "tim-kiem.html&keywords=" + a, !0) : (alert("Nhập từ khóa tìm kiếm"), document.getElementById("name_tk2").focus(), !1)
  }
</script>
<script type="text/javascript" src="js/jquery.mmenu.all.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

      $("body").on('click', '.buy', function() {
        $(".header-overlay").show();
         var id_pro = $(this).attr('data-id');
         $.ajax({
              url: 'ajax/add_cart.php',
              type: 'post',
              data: {id_pro:id_pro,sl:1},
              success: function(data){
                $(".header-overlay").fadeOut(500);
                location.href='gio-hang';
              }
        })
      });
      $("#btn_buy").click(function(){
            $(".header-overlay").show();
            var size = $("#size_pro").val();
            var color = $("#color_pro").val();
            var sl = $("#qty").val();
            $.ajax({
                url: 'ajax/add_cart.php',
                type: 'post',
                data: {id_pro:id_pro,size:size,color:color,sl:sl},
                processData: false,
                success: function(data){
                  $(".header-overlay").fadeOut(500);
                  location.href='gio-hang';
                }
            })
        });

      // $(window).scroll(function() {
      //   if($(window).scrollTop() > 100) {
      //     $('#back-to-top').fadeIn();
      //   } else {
      //     $('#back-to-top').fadeOut();
      //   }
      // });
      $('#back-to-top').click(function() {
        $('html, body').animate({scrollTop:0},500);
      });

      $("nav#menu_mb").mmenu({
          offCanvas: {
              position: "left"
          }
      })

      $(".fcb").fancybox({
        margin : [44,0,22,0],
        thumbs : {
          autoStart : true,
          axis      : 'x'
        }
      });

      new Swiper(".swiper-dmsp", {
          // prevButton: '.prev_doitac',
          // nextButton: '.next_doitac',
          slidesPerView: 4,
          loop: false,
          autoplay: 3e3,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          spaceBetween: 26,
          breakpoints: {
              320: {
                slidesPerView: 1,
              },
              480: {
                slidesPerView: 2,
                spaceBetween: 10,
              },
              700: {
                slidesPerView: 2,
              },
              800: {
                slidesPerView: 3,
                spaceBetween: 15,
              },
              992: {
                slidesPerView: 3,
                spaceBetween: 15,
              },
              1024: {
                slidesPerView: 4,
                spaceBetween: 15,
              },
          },

      });

      new Swiper(".swiper-gcn", {
          // navigation: {
          //   nextEl: '.next_why',
          //   prevEl: '.prev_why',
          // },
          slidesPerView: 1,
          loop: false,
          autoplay:{
            delay: 3500,
          },
          spaceBetween: 0,
      });

      new Swiper(".swiper-dv", {
          // navigation: {
          //   nextEl: '.next_ch',
          //   prevEl: '.prev_ch',
          // },
          slidesPerView: 4,
          loop: false,
          autoplay:{
            delay: 3500,
          },
          spaceBetween: 28,
          breakpoints: {
              480: {
                slidesPerView: 2,
                spaceBetween: 10,
              },
              640: {
                slidesPerView: 3,
                spaceBetween: 10,
              },
              768: {
                slidesPerView: 3,
                spaceBetween: 15,
              },
              992: {
                slidesPerView: 3,
                spaceBetween: 15,
              },
              1024: {
                slidesPerView: 3,
                spaceBetween: 20,
              },
          }
      });

      new Swiper(".swiper-sp", {
          slidesPerView: 4,
          loop: false,
          autoplay: 3e3,
          spaceBetween: 30,
          breakpoints: {
              320: {
                slidesPerView: 2,
                spaceBetween: 14,
              },
              480: {
                slidesPerView: 2,
                spaceBetween: 14,
              },
              768: {
                slidesPerView: 2,
                spaceBetween: 15,
              },
              992: {
                slidesPerView: 3,
                spaceBetween: 15,
              },
              1024: {
                slidesPerView: 3,
                spaceBetween: 20,
              },
          }
      });
      
      $(".col-news-small").slick({
          accessibility: true,
          slidesToShow: 2,
          vertical: true,
          verticalSwiping: true,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          arrows: false,
          centerMode: false,
          dots: false,
          draggable: true,
          pauseOnHover: false,
      });
  });
</script>

<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/lazyload.min.js"></script>
<script type="text/javascript">
  $().ready(function(){
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy",
        // ... more custom settings?
    });
  })
</script>

<?php if($template=='product_detail'){ ?>
  <script type="text/javascript" src="js/magiczoomplus.js"></script> 
  <script type="text/javascript" src="js/temp/js_tab.js"></script>
  <script type="text/javascript">
    $().ready(function(){
         var owl = $("#owl_img_detail");
          owl.owlCarousel({
            rtl:false,
            loop:false,
            margin:1,
            dots:false,
            nav:false,
            responsive:{
              0:{
                items:4
              },
              600:{
                items:5
              },
              1000:{
                items:6
              }
            }
          });
          $(".next_sub_detail").click(function(){
            owl.trigger('next.owl');
          });
          $(".prev_sub_detail").click(function(){
            owl.trigger('prev.owl');
          });

        $('#minus').click(function(event) {
           var number = $('.sl').val();
           if(number > 1) number = parseInt(number) - 1;
           else number = 1;
           $('.sl').val(number);
           return false;
         });
          $('#plus').click(function(event) {
           var number = $('.sl').val();
           number = parseInt(number) + 1;
           $('.sl').val(number);
           return false;
         });

          $(".color-option button").click(function(){
              if($(this).hasClass('active')){

              }else{
                  $(".color-option button").removeClass('active');
                  $(this).addClass('active');
                  var size = $(this).attr("data-val");
                  $("input#color_pro").val(size);
              }
          })

          $(".size-option button").click(function(){
        
              if($(this).hasClass('active')){

              }else{
                // $(".header-overlay").show();
                $(".size-option button").removeClass('active');
                $(this).addClass('active');
                var size = $(this).attr("data-val");
                $("input#size_pro").val(size);
                var id_pro = $("#id_pro").val();
                $.ajax({
                    url: 'ajax/size_change.php',
                    type: 'post',
                    data: {id_pro:id_pro,size:size},
                    success: function(data){
                      var obj = jQuery.parseJSON(data);
                      $(".price_now").text(obj.giaban);
                      $(".price_old span.num").text(obj.giacu);
                      $(".price_old span.off").text(obj.off);
                      if(!obj.giacu){
                        $(".price_old").hide();
                      }else{
                        $(".price_old").show();
                      }
                      // $(".header-overlay").fadeOut(500);
                    }
                })
              }
          })

          $("#btn_buy").click(function(){
              $(".header-overlay").fadeIn(500);
              var id_pro = $("#id_pro").val();
              var size = $("#size_pro").val();
              var color = $("#color_pro").val();
              var sl = $("#qty").val();
              $.ajax({
                  url: 'ajax/add_cart.php',
                  type: 'post',
                  data: {id_pro:id_pro,size:size,color:color,sl:sl},
                  success: function(data){
                    $(".header-overlay").fadeOut(500);
                    location.href='gio-hang';
                  }
              })
          });

    })
   
  </script>

  
<?php } ?>


<?php if($com=='dang-ky' || $com=='thanh-toan'){ ?>
<script type="text/javascript">
  $('#tinhthanh').change(function(event) {
    $('#quanhuyen').load('ajax/load_quanhuyen.php',{id:$(this).val()});
  });
</script>
<?php } ?>

<?php if($com=='gio-hang'){ ?>
  <script type="text/javascript" src="js/temp/js_giohang.js"></script>
<?php } ?>

<?php if($com=='thanh-toan'){?>
  <script type="text/javascript">
    
    var id = $('.radio input[name=httt]:checked').val();
    $('.radio input[name=httt]').click(function() {
      id = $(this).val();
      $('div.content_httt').removeClass('active');
      $('#httt'+id).addClass('active');
    });
  </script>
<?php } ?>

<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".nivo").nivoSlider({
        effect: "random",
        controlNav: false,
        controlNavThumbs: !1,
        pauseOnHover: !1,
        directionNav: true,
        pauseTime: 4000,
        prevText: "",
        nextText: ""
    });

    fixed_menu();
    $(window).scroll(function() {
        fixed_menu();
    });
    $(window).resize(function() {
        fixed_menu();
    })

    function fixed_menu() {
        $maxhei = $("#header").height();
        if ($(this).scrollTop() > $maxhei) {
          $('#menu').addClass('fixed');
        }else{
          $('#menu').removeClass('fixed');
        }
    }
});
</script>
<?php if($template=='index' || $template=='video' || $template=='album_detail'){ ?>
<script type="text/javascript" src="js/fotorama.js"></script>
<?php } ?>


<?php if($template=='index'){ ?>
<script type="text/javascript">
  $().ready(function(){
      $(".cats a").click(function() {
        if($(this).hasClass('active')){

        }else{
          $(".header-overlay").show();
          $(this).parent().find('a').removeClass('active');
          $(this).addClass('active');
          let id_list = $(this).attr('data-list');
          let id_cat = $(this).attr('data-cat');
          $.ajax({
              url: 'ajax/load_pro.php',
              type: 'post',
              data: {id_list:id_list,id_cat:id_cat,type_bar:'product'},
              success: function(data){
                $(".header-overlay").fadeOut(500);
                $("#show_list_"+id_list).html(data);
                $('html, body').animate({ scrollTop: $('#show_list_'+id_list).offset().top - 70 }, 200);
              }
          })
        }
      });

  })
</script>
<?php } ?>