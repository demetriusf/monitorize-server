<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

require_once (APPPATH . "/libraries/REST_Controller.php");

class Gcm extends REST_Controller {
	
	public function __construct() {
		
		parent::__construct ();
	
	}
	
	public function gcm_op_put() { // Register Android Device
		
		$regId = $this->put ( 'regId' );
		$loginUserToken = $this->put ( 'loginUserToken' );
		
		if (! empty ( $regId ) && ! empty ( $loginUserToken )) {
			
			$regId = addslashes ( $regId );
			$loginUserToken = addslashes ( $loginUserToken );
			
			$idUser = $this->UserDao->getUserIdByToken ( $loginUserToken );
			
			if (! empty ( $idUser )) {
				
				$contentValues = array ("regId" => $regId, "id_user" => $idUser );
				
				$this->db->get_where ( "gcm_keys", $contentValues );
				
				if ($this->db->affected_rows () == 0) {
					
					// Delete other devices first
					$this->db->delete ( "gcm_keys", array ("regId" => $regId ) );
					
					$this->db->insert ( "gcm_keys", array ("regId" => $regId, "id_user" => $idUser ) );
					
					if ($this->db->affected_rows () == 1) {
						
						$this->response ( array ("feedback" => "true" ), NULL );
					
					} else {
						
						$this->response ( array ("feedback" => "false" ), NULL );
					
					}
				
				} else {
					
					$this->response ( array ("feedback" => "true" ), NULL );
				
				}
			} else {
				
				$this->response ( array ("feedback" => "false" ), NULL );
			
			}
		
		} else {
			
			$this->response ( array ("feedback" => "false" ), NULL );
		
		}
	
	}
	
	public function gcm_op_delete() { // Remove Android Device
		
		$regId = $this->get ( 'regId' );
		
		if (! empty ( $regId )) {
			
			$regId = addslashes ( $regId );
			
			$this->db->delete ( "gcm_keys", array ("regId" => $regId ) );
			
			if ($this->db->affected_rows () == 1) {
				
				$this->response ( array ("feedback" => "true" ), NULL );
			
			} else {
				
				$this->response ( array ("feedback" => "false" ), NULL );
			
			}
		
		} else {
			
			$this->response ( array ("feedback" => "false" ), NULL );
		
		}
	
	}

}

?>