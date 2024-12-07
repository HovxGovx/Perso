<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  

  
class Main extends CI_Controller { 

	 public function __construct()
		{
			parent::__construct();
			$this->load->model('Responsable_model');
			$this->load->library('session');
		} 

    public function index()
		{
        $this->login();  
		}
		
    public function login()
	{
			$this->load->view('login_view');  
	}
	
	public function login_action() 
	
	{  
        $this->load->helper('security');  
        $this->load->library('form_validation');  
  
        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');  
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');  
  
        if ($this->form_validation->run())   
        {  
            $data = array(  
                'username' => $this->input->post('username'),
                'currently_logged_in' => 1
                );    
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$resp = array(
			'login'=>$username,
			'mdp'=>$password,
		);
		
		$user = $this->login_model->roleuser($resp);
		$respo = $user[0];
		$respon = $respo->id_role;
		
		$this->session->set_flashdata('role', $respon);
            $this->session->set_userdata($data);
            redirect('Main/data1');  
			
        }   
        else {  
            $this->load->view('login_view');  
        }  
    }  
	//    controlle connexion
    public function data1()  
    {  
		$this->load->model('Responsable_model');
		$this->load->model('Dossier_model');
		$this->load->model('login_model');
        if ($this->session->userdata('currently_logged_in'))   
        {  
			$role = $this->session->flashdata('role');

			if ($role==1){
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_ccdf', $data);
            $this->load->view('aprc_ccdf',$data);  
			$this->load->view('layout/footer',$data);
			
			}
			elseif ($role==2){
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_ccdf', $data);
            $this->load->view('aprc_ccdf',$data);  
			$this->load->view('layout/footer',$data);
			
            }elseif ($role==3){
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_ccdf', $data);
            $this->load->view('aprc_ccdf',$data);  
			$this->load->view('layout/footer',$data);
			}
			elseif ($role==4){
				
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_ccdf', $data);
            $this->load->view('aprc_ccdf',$data);  
			$this->load->view('layout/footer',$data);
			}
			elseif ($role==5){
				
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_guichet', $data);
            $this->load->view('aprc_guichet',$data);  
			$this->load->view('layout/footer',$data);
			}
			elseif ($role==6){
				
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header', $data);
            $this->load->view('data1',$data);  
			$this->load->view('layout/footer',$data);
			}
		}else 
	{  
        redirect('Main/invalid');  
     }  
    }  
	// Acceder aux acceuille sans probleme.
	public function guichet(){
		$this->load->model('Responsable_model');
		$this->load->model('Dossier_model');
		$this->load->model('login_model');
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_guichet', $data);
            $this->load->view('aprc_guichet',$data);  
			$this->load->view('layout/footer',$data);
	}
	public function ccdf(){
		$this->load->model('Responsable_model');
		$this->load->model('Dossier_model');
		$this->load->model('login_model');
			$data['username'] = $this->session->userdata('username');
			$data['totalresp'] = $this->Responsable_model->get_total_rows();
			$data['totaldossier']= $this->Dossier_model->get_total_rows();
			
			$this->load->view('layout/header_ccdf', $data);
            $this->load->view('aprc_ccdf',$data);  
			$this->load->view('layout/footer',$data);
	}


    public function invalid()  
    {  
        $this->load->view('invalid');  
    }  
	
	public function validation()  
    {  
        $this->load->model('login_model');  
  
        if ($this->login_model->log_in_correctly())  
        {  
            return true;  
			
        } 
		else
			{
			
            $this->form_validation->set_message('validation', 'Hamarino ny anarana na ny teny miafina.');  
            return false;  
        }  
    } 

	public function profil($data){
		
		$this->load->view('profil');
	}
  
    public function logout()  
    {  
        $this->session->sess_destroy(); 
		redirect('main');
       // $this->load->view('login_view');  
    }  
	public function prof(){
		$data['username'] = $this->session->userdata('username'); 
		
		$this->load->view('layout/header');
		$this->load->view('profil',$data);
		$this->laod->view('layout/footer');
	}
	

    public function display_total_rows() {
		
        $data['totalresp'] = $this->Responsable_model->get_total_rows(); // Récupérer le nombre total de lignes
		
        $this->load->view('data1', $data); // Charger la vue avec les données
    }
	
	// Dans votre contrôleur ou modèle approprié
	public function getPseudoSessionActive() {
    // Chargez la bibliothèque de session de CodeIgniter
    $this->load->library('session');

    // Récupérez l'identifiant de session
    $session_id = $this->session->userdata('user_id');

    // Chargez le modèle responsable
    $this->load->model('Responsable_model');

    // Récupérez le pseudo du responsable en utilisant l'identifiant de session
    $pseudo = $this->Responsable_model->getPseudoBySessionId($session_id);

    return $pseudo;
}

	
}
?>

  
