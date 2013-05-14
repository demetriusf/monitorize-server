<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

require_once (APPPATH . '/libraries/REST_Controller.php');

class User extends REST_Controller {
	
	public function user_op_put() {
		
		$email = $this->put ( 'email' );
		$pwd = $this->put ( 'pwd' );
		
		if (valid_email ( $email ) && ! empty ( $pwd )) {
			
			$this->db->insert ( 'users', array ('email' => $email, 'pwd' => $pwd ) );
			
			if ($this->db->affected_rows () == 1)
				$this->response ( array ('feedback' => 'true' ), 200 );
			else
				$this->response ( array ('feedback' => 'false' ), 200 );
		
		} else {
			
			$this->response ( array ('feedback' => 'false' ), 200 );
		
		}
	
	}

}

?>