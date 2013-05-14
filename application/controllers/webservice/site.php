<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

require_once (APPPATH . "/libraries/REST_Controller.php");

class Site extends REST_Controller {
	
	public function site_op_put() {
		
		$jsonSite = $this->put ( 'site' );
		$jsonUserToken = $this->put ( 'loginUserToken' );
		print_r ( $jsonSite );
		$idUser = 0;
		$name = $jsonSite ['name'];
		$endereco = $jsonSite ['endereco'];
		$receiveAndroidNotification = ( boolean ) $jsonSite ['receiveAndroidNotification'];
		$optPing = ( boolean ) $jsonSite ['optPing'];
		
		$token_magic_key = get_token_magic_key ();
		
		$realToken = str_replace ( $token_magic_key, '', $jsonUserToken );
		
		$consultaUser = $this->db->get_where ( 'users', array ("MD5(email)" => $realToken ), 1 );
		
		if (! empty ( $name ) && (filter_var ( $endereco, FILTER_VALIDATE_URL ) !== FALSE || filter_var ( $endereco, FILTER_VALIDATE_IP ) !== FALSE) && $this->db->affected_rows () == 1) {
			
			$idUser = $consultaUser->row ( 0 )->id;
			
			$linhas = $this->db->select ( "COUNT(*) as total" )->from ( "sites" )->where ( array ("id_user" => $idUser, "endereco" => $endereco ) )->get ();
			$total = $linhas->row ( 0 )->total;
			
			if ($total == "0") {
				
				$this->db->insert ( 'sites', array ('id_user' => $idUser, 'name' => $name, 'endereco' => $endereco, 'receiveAndroidNotification' => $receiveAndroidNotification, 'optPing' => $optPing ) );
				
				if ($this->db->affected_rows () == 1) {
					
					$this->response ( array ('feedback' => 'true' ), 200 );
				
				} else {
					
					$this->response ( array ('feedback' => 'false' ), 200 );
				
				}
			
			} else { // Já existe esse site.
				
				$this->response ( array ('feedback' => 'false' ), 200 );
			
			}
		
		} else {
			
			$this->response ( array ('feedback' => 'false' ), 200 );
		
		}
	
	}
	
	public function site_op_post() {
		
		$jsonSite = $this->post ( 'site' );
		$jsonUserToken = $this->post ( 'loginUserToken' );
		
		$idUser = 0;
		$idSite = $jsonSite ['id'];
		$name = $jsonSite ['name'];
		$endereco = $jsonSite ['endereco'];
		$receiveAndroidNotification = ( boolean ) $jsonSite ['receiveAndroidNotification'];
		$optPing = ( boolean ) $jsonSite ['optPing'];
		
		$token_magic_key = get_token_magic_key ();
		
		$realToken = str_replace ( $token_magic_key, '', $jsonUserToken );
		
		$consultaUser = $this->db->get_where ( 'users', array ("MD5(email)" => $realToken ), 1 );
		
		if (! empty ( $name ) && (filter_var ( $endereco, FILTER_VALIDATE_URL ) !== FALSE || filter_var ( $endereco, FILTER_VALIDATE_IP ) !== FALSE) && $this->db->affected_rows () == 1 && ! empty ( $idSite )) {
			
			$idUser = $consultaUser->row ( 0 )->id;
			
			$linhas = $this->db->select ( "COUNT(*) as total" )->from ( "sites" )->where ( array ("id_user" => $idUser, "endereco" => $endereco, "id !=" => $idSite ) )->get ();
			$total = $linhas->row ( 0 )->total;
			
			if ($total == "0") {
				
				$this->db->where ( array ("id" => $idSite ) )->update ( 'sites', array ('id_user' => $idUser, 'name' => $name, 'endereco' => $endereco, 'receiveAndroidNotification' => $receiveAndroidNotification, 'optPing' => $optPing ) );
				
				if ($this->db->affected_rows () == 1) {
					
					$this->response ( array ('feedback' => 'true' ), 200 );
				
				} else {
					
					$this->response ( array ('feedback' => 'false' ), 200 );
				
				}
			
			} else { // Existe outro com o mesmo link para o msm usuário.
				
				$this->response ( array ('feedback' => 'false' ), 200 );
			
			}
		
		} else {
			
			$this->response ( array ('feedback' => 'false' ), 200 );
		
		}
	
	}
	
	public function site_op_get() {
		
		$loginUserToken = addslashes ( $this->get ( 'loginUserToken' ) );
		
		$identifier = addslashes ( $this->get ( 'identifier' ) );
		
		$token_magic_key = get_token_magic_key ();
		
		$realToken = str_replace ( $token_magic_key, '', $loginUserToken );
		
		$consulta = $this->db->select ( "sites.id, sites.name, sites.endereco, sites.receiveAndroidNotification, sites.optPing", 1 )->from ( "sites" )->join ( 'users', 'sites.id_user=users.id' );
		
		$sites = array ();
		
		if (! empty ( $identifier )) { // Catch the site by identifier
			
			$sites = $consulta->where ( array ('MD5(users.email)' => $realToken, 'MD5(sites.id)' => $identifier ) )->get ()->row ( 0 );
			
			if ($sites->receiveAndroidNotification == "1") {
				
				$sites->receiveAndroidNotification = "true";
			
			}
			
			if ($sites->optPing == "1") {
				
				$sites->optPing = "true";
			
			}
		
		} else {
			
			$sites = $consulta->where ( array ('MD5(users.email)' => $realToken ) )->get ()->result ();
			
			foreach ( $sites as $ind => $site ) {
				
				if ($site->receiveAndroidNotification == "1") {
					
					$site->receiveAndroidNotification = "true";
				
				}
				
				if ($site->optPing == "1") {
					
					$site->optPing = "true";
				
				}
			
			}
		
		}
		
		$this->response ( $sites, 200 );
	
	}
	
	public function site_op_delete() {
		
		$identifier = $this->get ( 'identifier' );
		
		$this->db->delete ( 'sites', array ('MD5(id)' => $identifier ) );
		
		if ($this->db->affected_rows () == 1) {
			
			$this->response ( array ('feedback' => 'true' ), 200 );
		
		} else {
			
			$this->response ( array ('feedback' => 'false' ), 200 );
		
		}
	
	}

}
