<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');

require_once(APPPATH."/libraries/REST_Controller.php");

class Site extends REST_Controller{
	
	public function site_op_put(){
		
		$idUser = $this -> put('idUser');
		$name = $this -> put('name');
		$url = $this -> put('url');
		$receiveNotification = (boolean) $this -> put('receiveNotification');
		$optPing = (boolean) $this -> put('optPing');
		
		if( !empty($name) && filter_var($url, FILTER_VALIDATE_URL) !== FALSE ){

			
			
			$this -> db -> insert('sites', array('id_user'=>$idUser, 'name'=> $name,'url' => $url, 'receiveNotification'=>$receiveNotification, 'optPing'=>$optPing) );
			
			$this -> response(array('feedback'=>'true') , 200);			
			
		}else{
			
			$this -> response(array('feedback'=>'false'), 200);
			
		}
		
		
	}	
	
	
}
