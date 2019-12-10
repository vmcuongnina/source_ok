<?php 
	session_start();
	error_reporting(0);
	@define ( '_lib' , './libraries/');
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	include_once _lib."file_requick.php";
	$d = new database($config['database']);

	
	function urlElement($url, $pri) {
		global $config_http,$config_url; 
		$url = $config_http.$config_url.$url;
		$str_sitemap='<url>'; 
		$str_sitemap.='<loc>'.$url.'</loc>'; 
		$str_sitemap.='<changefreq>weekly</changefreq>'; 
		$str_sitemap.='<priority>'.$pri.'</priority>';
		$str_sitemap.='</url>';
		echo $str_sitemap;
	} 
	function CreateXML2($tbl='',$type='',$priority=1){
		global $d;
		if($tbl=='') return false;
		
		$d->reset();
		$sql = "SELECT tenkhongdau FROM table_$tbl where type='".$type."' and hienthi=1 order by ngaytao desc";
		$d->query($sql);
		$result_data = $d->result_array();
		foreach ($result_data as $key => $v) { 
			urlElement('/'.$v['tenkhongdau'],$priority);
		}	
	}

	header("Content-Type: application/xml; charset=utf-8"); 
	echo '<?xml version="1.0" encoding="UTF-8"?>'; 
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 

	urlElement('','1.0'); 
	foreach ($data as $k => $v) {
		$priority = $v['field']=='id' ? "1.0" : "0.8";
		if($v['field']=='id'){
			urlElement('/'.$v['com'],'1.0'); 
		}
		if($v['tbl']!='info'){
			CreateXML2($v['tbl'],$v['type'],$priority);
		}
	}
	
	urlElement('/khuyen-mai','1.0'); 
	urlElement('/bo-suu-tap','1.0'); 
	urlElement('/lien-he','1.0'); 

	echo '</urlset>'; 
?>