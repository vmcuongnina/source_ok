<?php
	function get_product_name($pid){
		global $d, $row,$lang;
		$sql = "select ten_$lang from #_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten_'.$lang];
	}
	function get_col_pro($pid,$key){
		global $d, $row;
		$sql = "select $key from table_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row[$key];
	}
	function get_price_by_size($pid,$size=''){
		global $d, $row;
		$d->reset();
		if(!empty($size)){
			$sql = "select giacu,giaban from table_size where id_product='$pid' and size='$size'";
			$d->query($sql);
			$row = $d->fetch_array();
		}else{
			$sql = "select giacu,giaban from table_product where id='".$pid."'";
			$d->query($sql);
			$row = $d->fetch_array();
		}
		return $row;
	}
	function get_price($pid,$key='giaban'){
		global $d, $row;
		$sql = "select $key from table_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row[$key];
	}
		
	function get_thumb($pid){
		global $d, $row;
		$sql = "select photo from table_product where id='".$pid."' ";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['photo'];
	}
	function remove_product($pid,$thongtin=''){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['md5']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function remove_pro_thanh($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
		redirect('thanh-toan.html');
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$size=$_SESSION['cart'][$i]['size'];
			$row_price = get_price_by_size($pid,$size);
			$price=$row_price['giaban'];
			$sum+=$price*$q;
		}
		return $sum;
	}
	function count_total_item_cart(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
		
			$q=$_SESSION['cart'][$i]['qty'];
			
			$sum+=$q;
		}
		return $sum;
	}
	function addtocart($pid,$q,$size,$color){
		if($pid<1 or $q<1) return;
		
		if(is_array($_SESSION['cart'])){
			if(product_exists($pid,$q,$size,$color)) return 0;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['size']=$size;
			$_SESSION['cart'][$max]['color']=$color;
			$_SESSION['cart'][$max]['md5']=md5($pid.$size.$color);
			return count($_SESSION['cart']);
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['size']=$size;
			$_SESSION['cart'][0]['color']=$color;
			$_SESSION['cart'][0]['md5']=md5($pid.$size.$color);
			return count($_SESSION['cart']);
		}
	}
	function product_exists($pid,$q,$size,$color){
		$pid=intval($pid);
		$md5 = md5($pid.$size.$color);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($md5==$_SESSION['cart'][$i]['md5']){
				$_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty'] + $q;
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>