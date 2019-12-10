<div class="logo"> <a href="#" target="_blank" onclick="return false;"> <img src="images/logo.png"  alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span>Trang chủ</span></a></li>
  

  <li class="categories_li <?php if($_GET['com']=='info') echo ' activemenu' ?>" id="menu_tt"><a href="" title="" class="exp"><span>Trang tĩnh</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='gioithieu') echo ' class="this"' ?>><a href="index.php?com=info&act=capnhat&type=gioithieu">Giới thiệu</a></li>
       <!-- <li<?php if($_GET['type']=='tuyendung') echo ' class="this"' ?>><a href="index.php?com=info&act=capnhat&type=tuyendung">Tuyển dụng</a></li> -->
       <!-- <li<?php if($_GET['type']=='des_dknt') echo ' class="this"' ?>><a href="index.php?com=info&act=capnhat&type=des_dknt">Quy đổi kích thước</a></li> -->
       <li<?php if($_GET['type']=='des_why') echo ' class="this"' ?>><a href="index.php?com=info&act=capnhat&type=des_why">Mô tả đăng ký nhận tin</a></li>
    </ul>
  </li>

  <li class="categories_li <?php if($_GET['com']=='product' || $_GET['com']=='order' || $_GET['com']=='excel') echo ' activemenu' ?>" id="menu2"><a href="" title="" class="exp"><span>Sản phẩm</span><strong></strong></a>
    <ul class="sub">
      
      <li<?php if($_GET['act']=='man_list'&& $_GET['type']=='product') echo ' class="this"' ?>><a href="index.php?com=product&act=man_list&type=product">Quản lý danh mục 1</a></li>
      <li<?php if($_GET['act']=='man_cat'&& $_GET['type']=='product') echo ' class="this"' ?>><a href="index.php?com=product&act=man_cat&type=product">Quản lý danh mục 2</a></li>
      <!-- <li<?php if($_GET['act']=='man_item'&& $_GET['type']=='product') echo ' class="this"' ?>><a href="index.php?com=product&act=man_item&type=product">Quản lý danh mục 3</a></li> -->
      <!-- <li<?php if($_GET['act']=='man_sub'&& $_GET['type']=='product') echo ' class="this"' ?>><a href="index.php?com=product&act=man_sub&type=product">Quản lý danh mục 4</a></li> -->
      <li<?php if($_GET['act']=='man' && $_GET['type']=='product') echo ' class="this"' ?>><a href="index.php?com=product&act=man&type=product">Quản lý sản phẩm</a></li>
      <li<?php if($_GET['com']=='order') echo ' class="this"' ?>><a href="index.php?com=order&act=man">Quản lý đơn hàng</a></li>
    </ul>
  </li>

  <!-- <li class="categories_li <?php if($_GET['com']=='coupon') echo ' activemenu' ?>" id="menu_mgg"><a href="" title="" class="exp"><span>Mã giảm giá</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='coupon') echo ' class="this"' ?>><a href="index.php?com=coupon&act=man">Quản lý mã giảm giá</a></li>
    </ul>
  </li> -->

  <li class="categories_li <?php if($_GET['com']=='httt') echo ' activemenu' ?>" id="menu_httt"><a href="" title="" class="exp"><span>Hình thức thanh toán</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='httt') echo ' class="this"' ?>><a href="index.php?com=httt&act=man">Hình thức thanh toán</a></li>
    </ul>
  </li> 

  <!-- <li class="categories_li <?php if($_GET['com']=='thuoctinh') echo ' activemenu' ?>" id="menu_attr"><a href="" title="" class="exp"><span>Thuộc tính sản phẩm</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='thuoctinh' && $_GET['type']=='mucgia') echo ' class="this"' ?>><a href="index.php?com=thuoctinh&act=man&type=mucgia">Khoảng giá bộ lọc</a></li>
      <li<?php if($_GET['com']=='thuoctinh' && $_GET['type']=='sex') echo ' class="this"' ?>><a href="index.php?com=thuoctinh&act=man&type=sex">Giới tính</a></li>
      <li<?php if($_GET['com']=='thuoctinh' && $_GET['type']=='chatlieu') echo ' class="this"' ?>><a href="index.php?com=thuoctinh&act=man&type=chatlieu">Chất liệu</a></li>
      <li<?php if($_GET['com']=='thuoctinh' && $_GET['type']=='size') echo ' class="this"' ?>><a href="index.php?com=thuoctinh&act=man&type=size">Size</a></li>
      <li<?php if($_GET['com']=='thuoctinh' && $_GET['type']=='mausac') echo ' class="this"' ?>><a href="index.php?com=thuoctinh&act=man&type=mausac">Màu sắc</a></li>
    </ul>
  </li> -->

  <li class="categories_li <?php if($_GET['com']=='tags' && $_GET['type']=='tags') echo ' activemenu' ?>" id="menu_tags"><a href="" title="" class="exp"><span>Quản lý Tags</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='tags') echo ' class="this"' ?>><a href="index.php?com=tags&act=man&type=tags">Tags</a></li>
    </ul>
  </li>


  <li class="categories_li <?php if($_GET['com']=='baiviet') echo ' activemenu' ?>" id="menu_bv"><a href="" title="" class="exp"><span>Bài viết</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='camnang') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man_list&type=camnang">Danh mục cẩm nang sức khỏe</a></li>
      <li<?php if($_GET['type']=='camnang') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=camnang">Cẩm nang sức khỏe</a></li>
      <!-- <li<?php if($_GET['type']=='tintuc') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=tintuc">Tin tức </a></li> -->
      
      <li<?php if($_GET['type']=='visao') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=visao">Vì sao chọn chúng tôi</a></li>
      <li<?php if($_GET['type']=='chinhsach') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=chinhsach">Chính sách</a></li>
    </ul>
  </li>


  <!-- <li class="categories_li <?php if($_GET['com']=='alt') echo ' activemenu' ?>" id="menu_alt"><a href="" title="" class="exp"><span>Quản lý địa điểm</span><strong></strong></a>
      <ul class="sub">
        <li <?php if($_GET['com']=='alt' && $_GET['act']=='man_list') echo ' class="this"' ?>><a href="index.php?com=alt&act=man_list&type=alt">Quản lý tỉnh thành</a></li>
        <li <?php if($_GET['com']=='alt' && $_GET['act']=='man_cat') echo ' class="this"' ?>><a href="index.php?com=alt&act=man_cat&type=alt">Quản lý quận huyện</a></li>
        <li <?php if($_GET['com']=='alt' && $_GET['act']=='man_item') echo ' class="this"' ?>><a href="index.php?com=alt&act=man_item&type=alt">Quản lý phường xã</a></li>
        <li <?php if($_GET['com']=='alt' && $_GET['act']=='man') echo ' class="this"' ?>><a href="index.php?com=alt&act=man&type=alt">Quản lý đường</a></li>
      </ul>

  </li> -->
  
  

  <li class="marketing_li<?php if($_GET['com']=='yahoo' || $_GET['com']=='lkweb') echo ' activemenu' ?>" id="menu6"><a href="#" title="" class="exp"><span>Mạng xã hội</span><strong></strong></a>
    <ul class="sub">
      <!-- <li<?php if($_GET['type']=='hl') echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=hl" title="">Hotline Header</a></li> -->
      <li<?php if($_GET['type']=='mxh') echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=mxh" title="">Mạng xã hội</a></li>
      <!-- <li <?php if($_GET['type']=='lkweb3') echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=lkweb3" title="">Hỗ trợ online</a></li> -->
    </ul>
  </li>

  <!-- <li class="gallery_li<?php if($_GET['com']=='album') echo ' activemenu' ?>" id="menualbum"><a href="#" title="" class="exp"><span>Bộ sưu tập</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='album') echo ' class="this"' ?>><a href="index.php?com=album&act=man&type=album" title="">Bộ sưu tập</a></li>
    </ul>
  </li> -->

  <li class="gallery_li<?php if($_GET['com']=='photo' || $_GET['com']=='bannerqc' || $_GET['com']=='background') echo ' activemenu' ?>" id="menu7"><a href="#" title="" class="exp"><span>Hình Ảnh - Slider</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='favicon') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=favicon" title="">Favicon</a></li>

      <li<?php if($_GET['type']=='logo') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=logo" title="">Logo</a></li>

      <!-- <li<?php if($_GET['type']=='logo_dongdau') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=logo_dongdau" title="">Logo đóng dấu</a></li> -->
      
      <!-- <li<?php if($_GET['type']=='banner') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=banner" title="">Banner</a></li> -->
      
      <!-- <li<?php if($_GET['type']=='bocongthuong' && $_GET['com']=='bannerqc') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=bocongthuong" title="">Logo bộ công thương</a></li> -->

      <li<?php if($_GET['type']=='slider') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slider" title="">Hình ảnh slider</a></li>
      
      <li<?php if($_GET['type']=='bgbanner') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=bgbanner" title="">Background chứng nhận - video</a></li>

      <!-- <li<?php if($_GET['type']=='bgemail') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=bgemail" title="">Background Đăng ký nhận tin</a></li> -->
      
      <li<?php if($_GET['type']=='bgfooter') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=bgfooter" title="">Background Footer</a></li>

      
      <li<?php if($_GET['type']=='qc') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=qc" title="">Banner quảng cáo 1</a></li>
      <li<?php if($_GET['type']=='qc2') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=qc2" title="">Banner quảng cáo 2</a></li>

      <li<?php if($_GET['type']=='gcn') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=gcn" title="">Chứng nhận</a></li>
      <li<?php if($_GET['type']=='img_kh') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=img_kh" title="">Cảm nhận khách hàng</a></li>

      <!-- <li<?php if($_GET['type']=='slide_pro') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slide_pro" title="">Banner danh mục sản phẩm</a></li> -->
      
      <!-- <li<?php if($_GET['type']=='partner') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=partner" title="">Đối tác</a></li> -->
    </ul>
  </li>

  <li class="marketing_li<?php if($_GET['com']=='video') echo ' activemenu' ?>" id="menu_video"><a href="#" title="" class="exp"><span>Quản lý video</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['type']=='video') echo ' class="this"' ?>><a href="index.php?com=video&act=man&type=video" title="">Video</a></li>
    </ul>
  </li>

  <li class="template_li<?php if($_GET['com']=='setting' || $_GET['com']=='newsletter' || $_GET['com']=='company' || $_GET['com']=='lang') echo ' activemenu' ?>" id="menu5"><a href="#" title="" class="exp"><span>Thông tin công ty</span><strong></strong></a>
    <ul class="sub">

      <li<?php if($_GET['type']=='lienhe') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=lienhe" title="">Liên hệ</a></li>
      <li<?php if($_GET['type']=='footer') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=footer" title="">Footer</a></li>
      <li<?php if($_GET['com']=='setting') echo ' class="this"' ?>><a href="index.php?com=setting&act=capnhat" title="">Cấu hình chung</a></li>
      <li<?php if($_GET['com']=='newsletter') echo ' class="this"' ?>><a href="index.php?com=newsletter&act=man" title="">Đăng ký nhận tin</a></li>
      <!-- <li<?php if($_GET['com']=='lang') echo ' class="this"' ?>><a href="index.php?com=lang&act=man&type=lang" title="">Define ngôn ngữ</a></li> -->
    </ul>
  </li>
</ul>