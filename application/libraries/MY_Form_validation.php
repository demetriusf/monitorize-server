<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Form_validation extends CI_Form_validation{

	public function __construct($rules = array()){

		parent::__construct($rules);
		
	}
	
	/**
	 * valid_br_phone_number
	 *
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	public function valid_br_phone_number($str)
	{
		
		return (boolean) preg_match('/^\([0-9]{2}\)[0-9]{8,9}$/', $str);
						
	}
	
	/**
	 * valid_br_date
	 *
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	public function valid_br_date($str){
		
		return (boolean) preg_match('/^((0[1-9])|(1[0-9])|(2[0-9])|(3[0|1]))\/(0[1-9]|1[0-2])\/[0-9]{4}$/', $str);		
		
	}
	
}