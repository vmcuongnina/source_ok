<?php 
	session_start();
	@define ( '_lib' , '../../libraries/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	check_role_admin($_SESSION['login']['role']);

	if (isset($_POST["level"])) {
		 $level = $_POST["level"];
		 $table = $_POST["table"];
		$id=$_POST["id"];
		 $type = $_POST["type"];
		switch ($level) {
			case '0':{
				$id_temp= "id_list";
				break;
			}
			case '1':{
				$id_temp= "id_cat";
				break;
			}
			case '2':{
				$id_temp= "id_item";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		
		$sql="select * from ".$table." where $id_temp=".$id." and type='".$type."'  order by stt ";
		$stmt=$d->query($sql);
		$result = $d->result_array();
		$str='
			<option>Chọn danh mục</option>			
			';
		foreach ($result as $key => $row) {
			if($row["id"]==(int)@$id_select)
				$selected="selected";
			else 
				$selected="";

			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';	
		}
		echo  $str;		
	}
?>
