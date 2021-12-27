<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Libs {
	var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}
	
    function dmyhis2ymdhis($datetime)
	{
		if(in_array($datetime,array('','00-00-0000 00:00:00','0000-00-00 00:00:00'))){
			return '';
		}
		if($datetime!=''){
			$arrDatetime = explode(' ',$datetime);
			$arrDate = explode('-',$arrDatetime[0]);
			$datetime = (isset($arrDate[2]) && isset($arrDate[1])?$arrDate[2].'-'.$arrDate[1].'-'.$arrDate[0]:'').(isset($arrDatetime[1])?' '.$arrDatetime[1]:'');
		}
		return $datetime;
	}
}