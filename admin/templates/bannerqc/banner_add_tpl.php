<script type="text/javascript">   

  $(document).ready(function() {
    $('.chonngonngu li a').click(function(event) {
      var lang = $(this).attr('href');
      $('.chonngonngu li a').removeClass('active');
      $(this).addClass('active');
      $('.lang_hidden').removeClass('active');
      $('.lang_'+lang).addClass('active');
      return false;
    });
});
</script>
 <?php
          if(_width_thumb < 800){
            $rong = _width_thumb;
            $cao = _height_thumb;
          } else {
            $rong = 800;
            $cao = '';
          }
      ?>
<div class="wrapper">

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
          <li><a href="index.php?com=bannerqc&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main?></span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=bannerqc&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">


<!--phan ngon ngu-->
<div class="widget">
<?php
 if($config_multi_lang=='true') {?>
  <div class="title chonngonngu">
    <ul>
    <?php foreach ($config['lang'] as $key => $value) { ?>
      <li><a href="<?=$key?>" class="<?=$key==$config['lang_active']?'active':''?> tipS validate[required]" title="Chọn <?=$value?>"><?=$value?></a></li>
    <?php } ?>
    </ul>
  </div>
<?php } ?>

<?php foreach ($config['lang'] as $key => $value) { ?>
<div class="contain_lang_<?=$key?> contain_lang <?=$key==$config['lang_active']?'active':''?>">
  <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
    <h6>Nội dung <?=$value?></h6>
  </div>
  <div class="formRow" >
      <label>Tải banner :</label>
      <div class="formRight">
              <input type="file" id="file_<?=$key?>" name="file_<?=$key?>" />
        <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
        <div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
      </div>
      <div class="clear"></div>
    </div>
    <?php if($item['photo_'.$key]!=''){ ?>
    <div class="formRow">
      <label><?=$title_main?> Hiện Tại :</label>
      <div class="formRight">
      
      <div class="mt10">
        <img src="<?=_upload_hinhanh.$item['photo_'.$key]?>?v=<?=time()?>" alt="hinh anh" style="max-width: 700px;">
      </div>
      </div>
      <div class="clear"></div>
    </div>

    <?php } ?>

    
</div><!--lang-->
<?php } ?>


    <?php if($links_=='true'){?>
        <div class="formRow">
            <label>Link liên kết:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="link" value="<?=$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php }  ?>
      <?php if($config_hienthi=='true'){?>
        <div class="formRow">
          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
          </div>
          <div class="clear"></div>
        </div>
        <?php } ?>


      <div class="formRow">
      <div class="formRight">
              <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
      </div>
      <div class="clear"></div>
    </div>


</div>
<!--end phan ngon ngu-->


  

  
</form></div>