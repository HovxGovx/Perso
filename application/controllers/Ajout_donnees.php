<?php
class Ajout_donnees extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dossier_model');
        $this->load->model('Responsable_model');
        if (!$this->session->userdata('currently_logged_in')) {
            redirect('main');
        }
    }

    public function index()
    {
        $data['username'] = $this->session->userdata('username');
        $data['libelle'] = $this->session->userdata('libelle');
        $data['nomregregion'] = $this->session->userdata('nomregion');
        $this->layout->view('dossier_add', $data);
    }
    // ! Endpoint pour obtenir le dernier numéro d'affaire pour un code pays et l'année
    public function getLastNumero()
    {
        // Récupérer les données postées par AJAX (code et année)
        $type_affaire = $this->input->post('code');  // Exemple : 'FN' ou 'GF'
        $year = $this->input->post('year');          // Exemple : '24' pour 2024
        $this->load->model('Dossier_model');
        // Utiliser le modèle pour obtenir le dernier numéro d'affaire
        $lastNumero = $this->Dossier_model->getLastNumero($type_affaire, $year);

        // Préparer la réponse JSON
        $response = array(
            'lastNumero' => $lastNumero ? $lastNumero : '0000'  // Définit '000' s'il n'y a pas de numéro précédent
        );

        // Envoyer la réponse JSON
        echo json_encode($response);
    }
    public function add_data_empt()
    {
        $idDemandeurs = $this->request->getPost('idDemandeurs'); // tableau si plusieurs demandeurs

        $data_terrain_empt = array(
            // Récupérer chaque donnée individuellement
            'localisation' => $this->request->getPost('Circonscription') . "-" . $this->request->getPost('localisation'),
            'canton' => $this->request->getPost('canton'),
            'num_parcelle' => $this->request->getPost('num_parcelle'),
            'section' => $this->request->getPost('section'),
            'type_terrain' => $this->request->getPost('type_terrain'),
            'nom_propriete' => $this->request->getPost('nom_propriete'),
            'num_titre' => $this->request->getPost('num_titre'),
            'superficie' => $this->request->getPost('superficie'),
            'empiettement' => $this->request->getPost('empiettement'),
            'id_region' => $this->session->userdata('id_region')
        );
        $this->load->model('Terrain_model');
        $terrain_id = $this->Terrain_model->insert_terrain($data_terrain);
    }
    // ! Endpoint pour ajouter les donnees du nouvelle demande sans empietement
    public function add_data()
    {
        $demandeurs_ids = $this->input->post('demandeur_id[]');
        $circonscription = $this->input->post('circonscription');
        $district = $this->input->post('district');
        $commune = $this->input->post('commune');
        $fokontany = $this->input->post('fokotany');
        $empiet = $this->input->post('reperage');
        $data_terrain = array(
            'superficie' => $this->input->post('superficie'),
            'num_titre' => $this->input->post('num_titre'),
            'num_parcelle' => $this->input->post('num_parcelle'),
            'section' => $this->input->post('section'),
            'type_terrain' => $this->input->post('type_terrain'),
            'nom_propriete' => $this->input->post('nom_propriete'),
            'canton' => $this->input->post('canton'),
            'localisation' => $circonscription . "-" . $district . "-" . $commune . "-" . $fokontany,
            'id_region' => $this->session->userdata('id_region'),
            'empiettement' => false
        );
        $this->load->model('Terrain_model');
        $terrain_id = $this->Terrain_model->insert_terrain($data_terrain);
        // Récupérer les données du formulaire pour le dossier
        if (!($empiet)) {
            $data['username'] = $this->session->userdata('username');
            $data['libelle'] = $this->session->userdata('libelle');
            $data['nomregregion'] = $this->session->userdata('nomregion');
            $this->load->view('dossier_add', $data);
        } else {
            $data_dossier = array(
                'id_terrain' => $terrain_id,
                'objetfiche' => $this->input->post('ObjetFicheInput'),
                'date_demande' => $this->input->post('date_demande'),
                'nature_demande' => $this->input->post('nature_demande'),
                'description' => $this->input->post('description'),
                'type_affaire' => $this->input->post('type_affaire'),
                'num_affaire' => $this->input->post('num_affaire'),
                'Etat' => "Nouvelle Demande",
                'id_responsable' => $this->session->userdata('id_responsable'),
                'id_circonscription' => $this->session->userdata('id_circonscription'),
                'id_region' => $this->session->userdata('id_region'),
                'empietement' => $this->input->post('reperage'),
            );
            $this->load->model('Dossier_model');
            $dossier_id = $this->Dossier_model->insert_dossier($data_dossier);
            for ($i = 0; $i < count($demandeurs_ids); $i++) {
                $data_demandeur = array(
                    'id_demandeur' => $demandeurs_ids[$i],
                    'id_dossier' => $dossier_id
                );
                // Tu peux insérer dans la base de données
                $this->Dossier_model->insert_demandeur_dossier($data_demandeur);
            }
            // Télécharger la pièce jointe
            // Configurer l'upload
            $config['upload_path'] = './assets/uploads/nouvelledemande/';
            $config['allowed_types'] = 'pdf|doc|docx|jpg|png';
            $config['max_size'] = 0; // Pas de limite de taille de fichier

            // Charger la bibliothèque d'upload avec la configuration
            $this->load->library('upload', $config);
            // Récupérer les fichiers envoyés
            $files = $_FILES['userfile'];

            // Compter le nombre de fichiers
            $fileCount = count($files['name']);
            $uploadSuccess = true;

            // Traiter chaque fichier
            for ($i = 0; $i < $fileCount; $i++) {
                // Préparer chaque fichier pour l'upload
                $_FILES['userfile'] = array(
                    'name' => $files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                );

                // Initialiser la librairie d'upload pour le fichier actuel
                $this->upload->initialize($config);

                // Tenter l'upload du fichier
                if ($this->upload->do_upload('userfile')) {
                    // Récupérer les informations du fichier uploadé
                    $fileData = $this->upload->data();
                    // Préparer les données à insérer
                    $data_piecejointe = array(
                        'id_dossier' => $dossier_id,
                        'path_plan' => $fileData['file_name'] // Utiliser le nom du fichier téléchargé
                    );

                    // Insérer chaque pièce jointe dans la base de données
                    $this->load->model('Piecejointe_model');

                    $piecejointe_id = $this->Piecejointe_model->insert_piecejointe($data_piecejointe);
                } else {
                    // Si une erreur se produit, la variable $uploadSuccess devient false
                    $uploadSuccess = false;
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                }
            }
            redirect('Main/data1');
        }
    }
    public function success($demandeur_id, $dossier_id, $terrain_id)
    {
        // Afficher la page de succès avec les IDs des données ajoutées si nécessaire
        $this->load->view('success', array('demandeur_id' => $demandeur_id, 'dossier_id' => $dossier_id, 'terrain_id' => $terrain_id));
    }

    public function view_all_dossiers()
    {
        // Récupère tous les dossiers depuis le modèle
        $data['dossiers'] = $this->Dossier_model->get_all_dossiers();
        // Charge la vue pour afficher les dossiers
        $data['username'] = $this->session->userdata('username');

        $this->load->view('layout/header', $data);
        $this->load->view('view_all_dossiers', $data);
        $this->load->view('layout/footer');
    }

    public function ccdfDossier()
    {
        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['username'] = $this->session->userdata('username');
        $this->load->view('layout/header_ccdf', $data);
        $this->load->view('dossier_ccdf', $data);
        $this->load->view('layout/footer');
    }
    public function display_total_rows()
    {
        $total_rows = $this->Dossier_model->get_total_rows();
    }
}
