<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Demo_cron extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct ();
	
	}
	
	public function index() {
		
		set_time_limit ( 7200 ); // 2 horas
		
		$messages = array ();
		
		$selTodosDevices = $this->db->get_where ( 'sites', array ('optPing' => '1' ) );
		
		if ($this->db->affected_rows () > 0) {
			
			$resURL = curl_init ();
			curl_setopt ( $resURL, CURLOPT_BINARYTRANSFER, 1 );
			curl_setopt ( $resURL, CURLOPT_FAILONERROR, 1 );
			curl_setopt ( $resURL, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $resURL, CURLOPT_FOLLOWLOCATION, 1 );
			
			foreach ( $selTodosDevices->result () as $sites ) {
				
				$errorNo = 0;
				$errorStr = "";
				
				$android_devices_id = array ();
				
				if (! $this->ping ( $sites->endereco, $resURL )) { // Erro
					
					if ($sites->receiveAndroidNotification == 1) {
						
						$devices = $this->db->get_where ( 'gcm_keys', array ('id_user' => $sites->id_user ) );
						
						if ($this->db->affected_rows () > 0) {
							
							foreach ( $devices->result () as $device ) {
								
								$android_devices_id [] = $device->regId;
							
							}
							
							$messages [] = array ($android_devices_id, $sites->name );
						}
					
					}
				
				}
			
			}
			
			curl_close ( $resURL );
		
		}
		
		$this->sendMesage ( $messages );
	
	}
	
	private function ping($url, $resource) {
		
		curl_setopt ( $resource, CURLOPT_URL, $url );
		curl_exec ( $resource );
		
		$intReturnCode = curl_getinfo ( $resource, CURLINFO_HTTP_CODE );
		
		return ! ($intReturnCode != 200 && $intReturnCode != 302 && $intReturnCode != 304 && $intReturnCode != 301);
	
	}
	
	private function sendMesage($messages) {
		
		$url = 'https://android.googleapis.com/gcm/send';
		
		$headers = array ('Authorization: key=AIzaSyBXw3owjLk1gUDjIxKidsGW3S1DaOn7JKM', 'Content-Type: application/json' );
		
		// Open connection
		$ch = curl_init ();
		
		// Set the url, number of POST vars, POST data
		curl_setopt ( $ch, CURLOPT_URL, $url );
		
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		
		// Disabling SSL Certificate support temporarly
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		
		foreach ( $messages as $k => $message ) {
			
			$fields = array ('registration_ids' => $message [0], 'data' => array ("message" => "O ping falhou para o site " . $message [1] ) );
			
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode ( $fields ) ); // json or
			                                                             // build_query
			                                                             
			// Execute post
			$result = curl_exec ( $ch );
		
		}
		
		curl_close ( $ch );
	
	}

}