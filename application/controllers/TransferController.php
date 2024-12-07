<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class TransferController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('layout');
		$this->load->model('Transfer_model');
		$this->load->model('Dossier_model');

	}
	public function generate_pdf_srd($pdf_dataS) {
        // Charger la bibliothèque DOMPDF
        $this->load->library('Dompdf_lib');
		// var_dump($pdf_dataS);exit;
        $html = $this->load->view('pdf_template', $pdf_dataS, true);

        // Charger le contenu HTML dans DOMPDF
        $this->dompdf_lib->dompdf->loadHtml($html);

        // (Optionnel) Configurer le format du papier et l'orientation
        $this->dompdf_lib->dompdf->setPaper('A4', 'portrait');

        // Rendre le PDF
        $this->dompdf_lib->dompdf->render();

        // Sortie du PDF (affichage ou téléchargement)
        $this->dompdf_lib->dompdf->stream("exemple.pdf", array("Attachment" => false));
        // Pour forcer le téléchargement, utilisez: "Attachment" => true
    }
	// ! CCDF
	public function ajouterDonneesAvis(){
		$id_dossi = $this->input->post('id_dossier');
		try {
            // Récupération des demandeurs
            $piecesjointesdossiersYY = $this->Dossier_model->getPdfByDossierId($id_dossi);
            // Récupération des demandeurs
            $demandeursYY = $this->Dossier_model->getDemandeursByDossierId($id_dossi);
            // Récupération du terrain
            $terrainYY = $this->Dossier_model->getTerrainByDossierId($id_dossi);
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            $this->output->set_status_header(500);
            echo json_encode(['error' => $error]);
        }
		$data_avis = array(
			'avis' => $this->input->post('avis2'),
			'obs' => $this->input->post('obs'),
			'auteur' => $this->input->post('auteur'),
			'Mod_Attr' => $this->input->post('ModAttr'),
			'prix' => $this->input->post('prix'),
			'id_dossier' => $id_dossi
		);
		$id_avis = $this->Transfer_model->insert_avis($data_avis);
		//$NUM = $id_avis%1000;
		/// Définir la locale en français
		setlocale(LC_TIME, 'fr_FR.UTF-8');
		// // Obtenir la date actuelle
		// $date = new DateTime();
		// $datee = strftime('%A %d %B %Y', $date->getTimestamp());

		if (($data_avis['avis'] == 4)) {
			// ! changer l'Etat du dossier en Refuser
			$this->load->model('Dossier_model');
			$this->Dossier_model->refus($id_dossi);
		} elseif (($data_avis['avis'] == 3)) {
			// ! changer l'Etat du dossier en Accepter
			$this->load->model('Dossier_model');
			$this->Dossier_model->acceptation($id_dossi);
		} else {
			// recuperation de libelle du circonscription pour etre utiliser pour le ccdf dans pathplan et numero bordereau
			$lib =$this->session->userdata('libelle');
			$datees = date('Y-m-d');
			$data_transF = array(
				'id_dossier' => $id_dossi,
				'id_avis' => $id_avis,
				'auteur' => $this->input->post('auteur'),
				'destinataire' => $this->input->post('destinataire'),
				'date_trans' => $datees,
				'path_plan' => "N°" . $id_avis . "/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-". $lib,
				'bordereau' => "N°" . $id_avis . "/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-". $lib,
			);
			//enregistrer les donnees du transfert
			$this->load->model('Transfer_model');
			$this->Transfer_model->insert_transF($data_transF);
			
			$pdf_data = [
				'avis' => $data_avis['avis'],
				'Mod_Attr' => $data_avis['Mod_Attr'],
				'obs' => $data_avis['obs'],
				'bordereau' =>  $id_avis . "/24-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-". $lib,
				'prix' => $data_avis['prix'],
				'destinataire' => $this->input->post('destinataire'),
				'date_trans' => $datees,
				'piecejointes' => $piecesjointesdossiersYY,
				'demandeur' => $demandeursYY,
				'terrain' => $terrainYY,
				'num_affaire' =>$this->input->post('num_affaireYY')
				// Add other necessary data
			];
			// var_dump($pdf_data);exit;
			// ! changer l'Etat du dossier en Envoyer par CCDF
			if ($data_transF['destinataire'] == "SRD") {
				// ! changer l'Etat du dossier en Envoyer par CCDF pour SRD
				$this->load->model('Dossier_model');
				$this->Dossier_model->pourAvisSrd($id_dossi);
				return $this->generate_pdf_srd($pdf_data);
			}elseif($data_transF['destinataire'] == "SDC"){
				// ! changer l'Etat du dossier en Envoyer par CCDF pour SDC
				$this->load->model('Dossier_model');
				$this->Dossier_model->pourAvisSdc($id_dossi);
				return $this->generate_pdf_sdc($pdf_data);
			}else{
				$this->load->model('Dossier_model');exit;
			}
			
		}
		
		// var_dump($pdf_data);exit;
		// Generate PDF
		
        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['pouravisccdf'] = $this->Dossier_model->get_all_dossiers_ccdf();
        $data['allDossier'] = $this->Dossier_model->get_all_dossier_guichet($this->session->userdata('id_circonscription'));
        $this->layout->view('View_dossier_ccdf', $data);
	}
	// ! SRD
	public function ajouterDonneesAvisSRD(){
		$id_dossi = $this->input->post('id_dossier');
		try {
            // Récupération des demandeurs
            $piecesjointesdossiersYY = $this->Dossier_model->getPdfByDossierId($id_dossi);
            // Récupération des demandeurs
            $demandeursYY = $this->Dossier_model->getDemandeursByDossierId($id_dossi);
            // Récupération du terrain
            $terrainYY = $this->Dossier_model->getTerrainByDossierId($id_dossi);
            
        } catch (Exception $e) {
            $error = $e->getMessage();
            $this->output->set_status_header(500);
            echo json_encode(['error' => $error]);
        }
		$data_avis = array(
			'avis' => $this->input->post('avis2'),
			'obs' => $this->input->post('obs'),
			'auteur' => $this->input->post('auteur'),
			'Mod_Attr' => $this->input->post('ModAttr'),
			'prix' => $this->input->post('prix'),
			'id_dossier' => $id_dossi
		);
		$id_avis = $this->Transfer_model->insert_avis($data_avis);
		//$NUM = $id_avis%1000;
		/// Définir la locale en français
		setlocale(LC_TIME, 'fr_FR.UTF-8');
		// // Obtenir la date actuelle
		// $date = new DateTime();
		// $datee = strftime('%A %d %B %Y', $date->getTimestamp());

		if (($data_avis['avis'] == 4)) {
			// ! changer l'Etat du dossier en Refuser
			$this->load->model('Dossier_model');
			$this->Dossier_model->refus($id_dossi);
		} elseif (($data_avis['avis'] == 3)) {
			// ! changer l'Etat du dossier en Accepter
			$this->load->model('Dossier_model');
			$this->Dossier_model->acceptation($id_dossi);
		} else {
			// recuperation de libelle du circonscription pour etre utiliser pour le ccdf dans pathplan et numero bordereau
			$lib =$this->session->userdata('libelle');
			$datees = date('Y-m-d');
			$data_transF = array(
				'id_dossier' => $id_dossi,
				'id_avis' => $id_avis,
				'auteur' => $this->input->post('auteur'),
				'destinataire' => $this->input->post('destinataire'),
				'date_trans' => $datees,
				'path_plan' => "N°" . $id_avis . "/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-". $lib,
				'bordereau' => "N°" . $id_avis . "/23-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-". $lib,
			);
			//enregistrer les donnees du transfert
			$this->load->model('Transfer_model');
			$this->Transfer_model->insert_transF($data_transF);
			
			$pdf_data = [
				'avis' => $data_avis['avis'],
				'Mod_Attr' => $data_avis['Mod_Attr'],
				'obs' => $data_avis['obs'],
				'bordereau' =>  $id_avis . "/24-MATP/SG/DGSF/DDPF/SDC/SRD/CIDROMA-". $lib,
				'prix' => $data_avis['prix'],
				'destinataire' => $this->input->post('destinataire'),
				'date_trans' => $datees,
				'piecejointes' => $piecesjointesdossiersYY,
				'demandeur' => $demandeursYY,
				'terrain' => $terrainYY,
				'num_affaire' =>$this->input->post('num_affaireYY')
				// Add other necessary data
			];
			// var_dump($pdf_data);exit;
			// ! changer l'Etat du dossier en Envoyer par CCDF
			if ($data_transF['destinataire'] == "CCDF") {
				// ! changer l'Etat du dossier en Envoyer par SRD pour CCDF
				$this->load->model('Dossier_model');
				$this->Dossier_model->pourAvisCCDFSrd($id_dossi);
				return $this->generate_pdf_srd($pdf_data);
			}elseif($data_transF['destinataire'] == "SDC"){
				// ! changer l'Etat du dossier en Envoyer par SRD pour SDC
				$this->load->model('Dossier_model');
				$this->Dossier_model->pourAvisSdcSrd($id_dossi);
				return $this->generate_pdf_sdc($pdf_data);
			}else{
				$this->load->model('Dossier_model');exit;
			}
			
		}
		
		// var_dump($pdf_data);exit;
		// Generate PDF
		
        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['pouravisccdf'] = $this->Dossier_model->get_all_dossiers_ccdf();
        $data['allDossier'] = $this->Dossier_model->get_all_dossier_guichet($this->session->userdata('id_circonscription'));
        $this->layout->view('View_dossier_srd', $data);
	}
	public function afficherEnvoi()
	{
		$data['username'] = $this->session->userdata('username');
		$data['dossierenvoi'] = $this->Transfer_model->get_all_envoi_ccdf($this->session->userdata('id_responsable'));
		$this->layout->view('View_envoi_ccdf', $data);
	}
	public function getEnvoiCcdf()
	{
		$this->load->model('Transfer_model');
		$d = $this->Transfer_model->get_all_envoi_ccdf($this->session->userdata('id_responsable'));
		echo json_encode($d);
	}
	public function getAvis($id_avis)
	{
		$this->load->model('Transfer_model');
		$de = $this->Transfer_model->get_avis($id_avis);
		echo json_encode($de);
	}
}
