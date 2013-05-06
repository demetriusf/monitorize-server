<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_cron extends CI_Controller{
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	public function index(){
		
		set_time_limit(7200); // 2 horas
		
		$selTodosDevices = $this -> db -> get_where('sites', array('optPing'=>'1') );
		
		$android_devices_id = array();
		
		if( $this -> db ->affected_rows() > 0 ){
			
			foreach( $selTodosDevices->result() as $sites ){
					
				$errorNo = 0;
				$errorStr = "";
				
				$sites->endereco = str_replace('http://', '', $sites->endereco);
				
				$fp = @fsockopen( $sites->endereco, 80, $errorNo, $errorStr, 2 );			
								
				if( !$fp ){ // Erro
					
					if( $sites->receiveAndroidNotification == 1 ){
						
						$devices = $this -> db -> get_where('gcm_keys', array('id_user'=> $sites->id_user) );
						
						if( $this -> db -> affected_rows() > 0 ){
							
							foreach( $devices->result() as $device ){
								
								$android_devices_id[] = $device->regId;								
								
							}
							
							
						}
						
												
					}					
					
				}
				
			}			
			
		}
		
		$android_devices_id = array_unique($android_devices_id);
		
		$url = 'https://android.googleapis.com/gcm/send';
		
		$fields = array(
				'registration_ids' => $android_devices_id,
				'data' => array("message"=>"Seu teste de ping falhou. Seu site está offline ou lento!"),
		);
		
		$headers = array(
				'Authorization: key=AIzaSyBXw3owjLk1gUDjIxKidsGW3S1DaOn7JKM',
				'Content-Type: application/json'
		);
		
		// Open connection
		$ch = curl_init();
		
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
		
			// Envia e-mail para o suporte.
			mail('suporte.siteswatch@asccode.com', 'Error Cronjob', 'Ocorreu um erro na função CURL do script demo de cronjob!');
			
		}
		
		curl_close($ch);		
		
	}
	
}