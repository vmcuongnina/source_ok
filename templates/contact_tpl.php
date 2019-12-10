
<div class="sub_main">
	<div class="wrap_name">
      <div class="name"><h1><?=$title_detail?></h1></div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main">
    	<div class="left_lienhe col-md-5 col-sm-12 col-xs-12">
    		<div class="text"><?=stripcslashes($row_detail['noidung_'.$lang])?></div>

            
    	</div>
    	<div class="right_lienhe col-md-7 col-sm-12 col-xs-12">
    		<?php include _template.'form/form_contact.php'; ?>
    	</div>
    	<div class="clearfix"></div>

    	
     </div><!--content main-->
</div><!--end sub main-->

