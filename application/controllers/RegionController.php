
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class RegionController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->library('layout');
        $this->load->model('Circonscription_model');
        $this->load->model('Region_model');
    }
 
    public function index()
    {
                $data['username'] = $this->session->userdata('username');
                $data['libelle'] = $this->session->userdata('libelle');
                $opt = $this->Region_model->get_list_region();    
               $this->layout->view('region_view', $data);
    }
 
    public function ajax_list()
    {
        
        $list = $this->Circonscription_model->get_datatables();
       
        $data = array();
       // $no = $_POST['start'];
        foreach ($list as $value) {
            //$no++;
            $row = array();
            $row[] = '<span class="text-tab-size-name">'.$value->nomregion.'</span>';
            $row[] = '<b><a class="text-tab-size-name" style="cursor:pointer;" onclick="modif_circonscription('."'".$value->idcirconscription."'".')">'.$value->libelle.'</a></b>';
            $row[]=  '<button style="align:center;margin-left:25%" class="btn btn-danger btn-mini" onclick="delete_circ('."'".$value->idcirconscription."'".')"><i class="glyphicon glyphicon-trash"></i> suppimer</button>';
            $data[]= $row;
        }
        
      
        $output = array(
                        //"draw" => $_POST['draw'],
                        "recordsTotal" => $this->Circonscription_model->count_all(),
                        "recordsFiltered" => $this->Circonscription_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        
        $data = $this->circonscriptionManager->get_by_id($id);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
       
        echo json_encode($data);
    }
 
   
    public function ajax_add()
    {
	
       $data = array(
                'libelle' => $this->input->post('circonscription'),
                'idregion'=>$this->input->post('region_id'),
                'indice' => $this->input->post('indice'));
       
        $insert = $this->Circonscription_model->save($data);
       
        echo json_encode(array("status" => TRUE));
        
      }
 
    public function ajax_update()
    {	
	
        $data = array(
               'LIBELLE' => $this->input->post('circonscription'),
               'idregion'=>$this->input->post('region_id'),

            );
       
		
        $this->Circonscription_model->update(array('idcirconscription' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->circonscriptionManager->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}
?>
