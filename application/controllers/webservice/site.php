<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');

require_once(APPPATH."/libraries/REST_Controller.php");

class Site extends REST_Controller{
	
	public function site_op_put(){
		
		$jsonSite = $this -> put('site'); 
		$jsonUserToken = $this -> put('loginUserToken');
		
		$idUser = 0;
		$name = $jsonSite['name'];
		$url =  $jsonSite['url'];
		$receiveNotification = (boolean) $jsonSite['receiveNotification']; 
		$optPing = (boolean) $jsonSite['optPing'];
		
		$token_magic_key = get_token_magic_key();
		
		$realToken = str_replace($token_magic_key, '', $jsonUserToken);
		
		$consultaUser = $this -> db -> get_where( 'users', array( "MD5(email)"=>$realToken ), 1 );
		
		if( !empty($name) && filter_var($url, FILTER_VALIDATE_URL) !== FALSE && $this -> db -> affected_rows() == 1 ){
			
			$idUser = $consultaUser->row(0)->id;				
					
			$this -> db -> insert('sites', array('id_user'=>$idUser, 'name'=> $name,'url' => $url, 'receiveNotification'=>$receiveNotification, 'optPing'=>$optPing) );

			if( $this -> db -> affected_rows() == 1 ){
				
				$this -> response(array('feedback'=>'true') , 200);				
				
			}else{
				
				$this -> response(array('feedback'=>'false') , 200);
					
			}
			
					
		}else{
					
			$this -> response(array('feedback'=>'false'), 200);
					
		}
					
	}	
	
	
}
