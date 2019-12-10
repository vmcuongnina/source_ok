<?php 
	/**
	 * NINA Framework
	 * Vertion 2.0
	 * Author NINA Co.,Ltd. (nina@nina.vn)
	 * Copyright (C) 08/2019 NINA Co.,Ltd. All rights reserved
	*/
	
	if(!defined('_lib')) die("Error");
	include_once _lib.'AntiSQLInjection.php';
	function nettuts_error_handler($number, $message, $file, $line, $vars)
	{
		if ( ($number !== E_NOTICE) && ($number < 2048) ) {
			die('a');
		}
	}
	//set_error_handler('nettuts_error_handler');
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	function get_http2(){
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		return $pageURL;
	}

	$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
	$site_key    = '6LfKMsIUAAAAAFM0Zo-LRWoxQnMBGiUZuvL-H5_T';
	$secret_key  = '6LfKMsIUAAAAAKLl1j6oDCUToBlbLYj0tHk_LQ5Y';
	
	$config_url=$_SERVER["SERVER_NAME"].'/source_ok';
	$config_http = $http = $page_http = get_http2();
	$config_file = $page_http.$config_url."/admin";
	$home_page = $page_http.$config_url;
	$_SESSION['ck'] = $page_http.$config_url.'/upload/';
	// $config['arrayDomainSSL'] = array("yourdomainssl.com.vn");
	$config['debug']=0;    #Bật chế độ debug dành cho developer
	$config['lang']="vi";
	$config_email="no-reply@tamangia.com";
	$config_pass="m7J4szuU";
	$config_ip="210.211.108.101";
	$config['lang']= array('vi'=>'Tiếng việt');
	$config['lang_active']= 'vi';
	$config['salt']='@#$fd_!34^';
	$config['login_name'] = $config_url;
	$config['login']['attempt'] = 5;
	$config['login']['delay'] = 15;

	$config['database']['debug'] = $config['debug'];	
	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'root';
	$config['database']['password'] = '';
	$config['database']['database'] = 'source_ok';
	$config['database']['refix'] = 'table_';

	error_reporting($config['debug']);
?>