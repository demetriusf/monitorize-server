<?php

class UserDao extends CI_Model  {

	public function __construct(){
		
		parent::__construct();
		
	}
	
	public function getUserIdByToken($token){
		
		$token_magic_key = get_token_magic_key();
		
		$realToken = str_replace($token_magic_key, '', $token);
		
		$consultaUser = $this -> db -> get_where( 'users', array( "MD5(email)"=>$realToken ) );
		
		if( $this -> db -> affected_rows() == 1 ){
			
			return $consultaUser -> row(0) -> id;	
			
		}
		
		return FALSE;
		
	}


}


?>