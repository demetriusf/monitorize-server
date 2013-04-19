<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."/libraries/REST_Controller.php");

class Gcm extends REST_Controller{

	public function gcm_op_put(){ // Register Android Device
		
		$regId =  $this -> put('regId') ;	
		$loginUserToken =  $this -> put('loginUserToken');	
		
		if( !empty($regId) && !empty( $loginUserToken )  ){

			$regId = addslashes($regId);
			$loginUserToken = addslashes($loginUserToken);
			
			$this -> db-> insert("gcm_keys", array("regId"=>$regId, "loginUserToken"=>$loginUserToken));
			
			if( $this -> db -> affected_rows() == 1 ){
				
				$this -> response(array("feedback"=>"true"), NULL);				
				
			}else{
				
				$this -> response(array("feedback"=>"false"), NULL);				
				
			}
			
		}else{
			
			$this -> response(array("feedback"=>"false"), NULL);
			
		}
		
	}
	
	public function gcm_op_delete(){ // Remove Android Device
	
	
	
	}	
	
}

?>