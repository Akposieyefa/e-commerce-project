<?php
namespace app\config;
/**
 * class Funtions
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\config
 *
 */

 class Functions
 {
 	
 	public function strip_zeros_from_date($marked_string="") {
		//first remove the marked zeros
		$no_zeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*0','',$no_zeros);
		return $cleaned_string;
	}

	public function redirect_to($location = NULL) {
		if($location != NULL){
			header("Location: {$location}");
			exit;
		}
	}

	public function redirect($location=Null){
		if($location!=Null){
			echo "<script>
					window.location='{$location}'
				</script>";	
		}else{
			echo 'error location';
		}
		 
	}

	public function output_message($message="") {
	
		if(!empty($message)){
		return "<p class=\"message\">{$message}</p>";
		}else{
			return "";
		}
	}

	public function date_toText($datetime=""){
		$nicetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $nicetime);	
	}

	public function __autoload($class_name) {
		$class_name = strtolower($class_name);
		$path = LIB_PATH.DS."{$class_name}.php";
		if(file_exists($path)){
			require_once($path);
		}else{
			die("The file {$class_name}.php could not be found.");
		}
					
	}

	public function getIp()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
 
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	 
	    return $ip;
	}

	public function json($status, $message, $data = array())
	{
		$data = array("status" => $status, "message" => $message, "data" => $data);
		print_r(json_encode($data));
		die;
	}

	public function trackId($str='',$length=3)
	{

	    $str_result = $str;

	    $length = (int)$length;

	    // Shuffle the $str_result and returns substring
	    // of specified length
	    return substr($str_result, 
	                       0, $length);

	}

	public function convert_space_in_str_to_dash($string){
		$str_count = substr_count($string, ' ');
		if($str_count > 0){
			return str_replace(" ","-",$string);
		}else{
			return $string;
		}	
	}

	public function url_string($string)
	{
		return $this->convert_space_in_str_to_dash($string);
	}

 }
?>