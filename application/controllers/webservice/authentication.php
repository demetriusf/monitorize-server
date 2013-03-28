<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."/libraries/REST_Controller.php");

class Authentication extends REST_Controller {

	
	public function user_post(){
		
		$email = addslashes($this -> post('email'));
		$pwd = addslashes($this -> post('pwd'));
		
		if( valid_email($email)  && !empty($pwd) ){
		
			$this -> db -> get_where('users', array("email"=>$email, "pwd"=> $pwd) );
					
			if($this -> db -> affected_rows() == 1)
				$this->response(array('feedback'=>'true'), 200);
			else
				$this->response(array('feedback'=> 'false'), 200);
		
		}else{
		
			$this->response(array('feedback'=> 'false'), 200);
		
		}		
		
	}	

	
}

?>