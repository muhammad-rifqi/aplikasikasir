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

	function ymd2dMonthySimple($datetime)
	{
		if(in_array($datetime,array('','0000-00-00 00:00:00','0000-00-00','00-00-0000'))){
			return '';
		}
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].' '.$this->num2NameMonthSimple($arr_date[1]).' '.$arr_date[0];
		}
		return $datetime;
	}

	function ymdhis2dMonthy($datetime)
	{
		if(in_array($datetime,array('','0000-00-00 00:00:00','0000-00-00','00-00-0000'))){
			return '';
		}
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].' '.$this->num2NameMonth($arr_date[1]).' '.$arr_date[0];
		}
		return $datetime;
	}

	function num2NameMonth($num)
	{
		$num = $this->lpad($num,2,'0');
		switch($num)
		{
			case '01': return 'Januari'; break;
			case '02': return 'Februari'; break;
			case '03': return 'Maret'; break;
			case '04': return 'April'; break;
			case '05': return 'Mei'; break;
			case '06': return 'Juni'; break;
			case '07': return 'Juli'; break;
			case '08': return 'Agustus'; break;
			case '09': return 'September'; break;
			case '10': return 'Oktober'; break;
			case '11': return 'November'; break;
			case '12': return 'Desember'; break;
			default : return ''; break;
		}
	}

	function num2NameMonthSimple($num)
	{
		$num = $this->lpad($num,2,'0');
		switch($num)
		{
			case '01': return 'Jan'; break;
			case '02': return 'Feb'; break;
			case '03': return 'Mar'; break;
			case '04': return 'Apr'; break;
			case '05': return 'Mei'; break;
			case '06': return 'Jun'; break;
			case '07': return 'Jul'; break;
			case '08': return 'Ags'; break;
			case '09': return 'Sep'; break;
			case '10': return 'Okt'; break;
			case '11': return 'Nov'; break;
			case '12': return 'Des'; break;
			default : return ''; break;
		}
	}

	function lpad($string,$digit,$char=' ')
	{
		return str_pad($string,$digit,$char,STR_PAD_LEFT);
	}
	
}