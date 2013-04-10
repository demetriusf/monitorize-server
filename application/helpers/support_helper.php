<?php

if(!function_exists('get_token_magic_key')){
	
	function get_token_magic_key(){
		
		$instance = &get_instance();
		
		return md5($instance->config -> item('token_magic_key'));
		
	}
	
}