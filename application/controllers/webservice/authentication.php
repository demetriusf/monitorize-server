<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."/libraries/REST_Controller.php");

class Authentication extends REST_Controller {

	public function user_post(){
		
		$emailInMD5 = addslashes($this -> post('email'));
		$pwdInMD5 = addslashes($this -> post('pwd'));
		
		if( !empty($emailInMD5)  && !empty($pwdInMD5) ){
		
			$this -> db -> get_where('users', array("MD5(email)"=>$emailInMD5, "MD5(pwd)"=> $pwdInMD5) );
			
			if($this -> db -> affected_rows() == 1){
				
				$key_token = get_token_magic_key();
				
				$token = $key_token.$emailInMD5;
				
				$this->response(array('feedback'=>$token), 200);
								
			}else{
				
				$this->response(array('feedback'=> ''), 200);
				
			}
		
		}else{
		
			$this->response(array('feedback'=> 'a'), 200);
		
		}		
		
	}	
	
}

?>