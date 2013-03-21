<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicial extends CI_Controller{

	public function __construct(){

		parent::__construct();
		
	}

	public function index(){

		$this->load->view('inicial');
	
	}
	
	public function contato(){
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		
			$this -> load -> library('form_validation');
		
			$this -> form_validation -> set_rules('nome', $this -> lang -> line('label_form_field_name'), 'required|min_length[2]|xss_clean');
			$this -> form_validation -> set_rules('email', $this -> lang -> line('label_form_field_email'), 'required|valid_email|xss_clean');
			$this -> form_validation -> set_rules('mensagem', $this -> lang -> line('label_form_field_message'), 'required|min_length[2]|xss_clean');
		
			if( $this -> form_validation -> run() ){
		
				$nome = strip_tags($this -> input -> post('nome', TRUE));
				$email = strip_tags( $this -> input -> post('email', TRUE) );
				$mensagem = strip_tags($this -> input -> post('mensagem', TRUE));
		
				$emailContato = $this -> config -> item('email_contato');
				$site = $this -> config -> item('nome_site');
		
				$AddressEmailPrincipal = "$emailContato";
		
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: $site <$emailContato>\n";
				$headers .= "Return-path: $emailContato";
		
				$Subject = "[FALE CONOSCO] Contato de ".$nome;
		
				//Content
				$body = '<div style="width:400px; padding:10px; margin:auto; color:black; font-family:Verdana, Geneva, sans-serif; font-size:11px;">
				<p style="text-align:center; margin:0;"><img src="'.base_url('img/asccode.png').'" /></p>
				<h3 style="font-size:18px;"><strong>'.$nome.' entrou em contato:</strong></h3>
				<p>
				<strong>Nome:</strong> '.$nome.'<br />
				<strong>Email:</strong> '.$email.'<br />
				<strong>Mensagem:</strong> '.$mensagem.'<br />
				</p>
				</div>';
		
				@mail($AddressEmailPrincipal,$Subject,$body,$headers);
		
				$this -> session -> set_flashdata('feedback', 'success');
		
				redirect('', 'refresh');
		
			}else{
		
				$this -> index();
		
			}
		
		}else{
		
			show_404();
		
		}
		
	}

}

?>