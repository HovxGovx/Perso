<?php
class Dossier_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert_dossier($data)
    {
        $this->db->insert('dossier', $data);
        $this->db->join('demandeur', 'dossier.id_demandeur = demandeur.id_demandeur');
        $this->db->join('terrain', 'dossier.id_terrain = terrain.id_terrain');
        return $this->db->insert_id();
    }
    // Fonction pour obtenir le dernier numéro d'affaire pour un type et une année spécifiques
    public function getLastNumero($type_affaire, $year)
    {
        // Filtre par type d'affaire et année pour trouver le dernier numéro
        $this->db->select('num_affaire');
        $this->db->from('dossier');
        $this->db->where('type_affaire', $type_affaire);
        $this->db->like('num_affaire', '/' . $year, 'before');  // Vérifie que l'année est présente dans num_affaire
        $this->db->order_by('num_affaire', 'DESC');           // Trie pour obtenir le dernier numéro
        $this->db->limit(1);                                 // Limite à une seule entrée

        $query = $this->db->get();

        // Retourne le dernier numéro d'affaire sans le code ni le marqueur de date
        if ($query->num_rows() > 0) {
            $result = $query->row();
            // Extraire uniquement le numéro (par exemple, "004" de "GF-004-10/24")
            $numero = explode('-', $result->num_affaire)[1];
            return $numero;
        } else {
            return null;
        }
    }

    public function insert_demandeur_dossier($data)
    {
        $this->db->insert('demandeur_dossier', $data);
        //return $this->db->insert_id();
    }
    //Suppression de dossier
    public function supp_Dossier($id_dossier)
    {
        $this->db->set('Etat', 'Supprimer');
        $this->db->where('id_dossier', $id_dossier);
        $this->db->update('dossier');
    }
    public function envoye($id_dossi)
    {
        $this->db->set('Etat', 'Envoye');
        $this->db->where('id_dossier', $id_dossi);
        $this->db->update('dossier');
    }
    public function pourAvisSrd($iddDossier)
    {
        $this->db->set('Etat', 'A-CCDF-SRD');
        $this->db->where('id_dossier', $iddDossier);
        $this->db->update('dossier');
    }
	public function pourAvisCCDFSrd($iddDossier)
    {
        $this->db->set('Etat', 'A-SRD-CCDF');
        $this->db->where('id_dossier', $iddDossier);
        $this->db->update('dossier');
    }
	public function pourAvisSdc($iddDossier)
    {
        $this->db->set('Etat', 'A-CCDF-SDC');
        $this->db->where('id_dossier', $iddDossier);
        $this->db->update('dossier');
    }
	public function pourAvisSdcSrd($iddDossier)
    {
        $this->db->set('Etat', 'A-SRD-SDC');
        $this->db->where('id_dossier', $iddDossier);
        $this->db->update('dossier');
    }
    public function refus_Dossier($iddo)
    {
        $this->db->set('Etat', 'Refuse');
        $this->db->where('id_dossier', $iddo);
        $this->db->update('dossier');
    }
	public function convocation_Dossier($idDo,$dateDos)
    {
        $this->db->set('Etat', 'En attente de C.E.L');
		$this->db->set('date_convocation', $dateDos);
        $this->db->where('id_dossier', $idDo);
        $this->db->update('dossier');
    }
    public function get_total_rows()
    {
        return $this->db->count_all('dossier');
    }
	public function get_total_pouravisSRD($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_region', $id);
        $this->db->where('Etat', 'A-CCDF-SRD');
        $query = $this->db->get();
        return $query->num_rows();
    }
	public function get_total_pouravisEnvoiSRD($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_region', $id);
		$this->db->group_start();  // Ouvre un groupe de conditions

        $this->db->where('Etat', 'A-SRD-SDC');
        $this->db->or_where('Etat', 'A-SRD-CCDF');	
		$this->db->group_end();  // Ouvre un groupe de conditions

        $query = $this->db->get();

        return $query->num_rows();
    }
	public function get_total_pouravisRecuSRD($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_region', $id);
        $this->db->where('Etat', 'A-SDC-SRD');	

        $query = $this->db->get();

        return $query->num_rows();
    }
    public function get_total_pouravisCCDF($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $id);
        $this->db->where('Etat', 'Pour Avis CCDF');
        $query = $this->db->get();
        return $query->num_rows();
    }
	public function get_total_pouravisEnvoiCCDF($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $id);
		$this->db->group_start();  // Ouvre un groupe de conditions

        $this->db->where('Etat', 'A-CCDF-SDC');
        $this->db->or_where('Etat', 'A-CCDF-SRD');	
		$this->db->group_end();  // Ouvre un groupe de conditions

        $query = $this->db->get();

        return $query->num_rows();
    }
	public function get_total_pouravisRecuCCDF($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $id);
		$this->db->group_start();  // Ouvre un groupe de conditions
        $this->db->where('Etat', 'A-SDC-CCDF');
        $this->db->or_where('Etat', 'A-SRD-CCDF');	
		$this->db->group_end();  // Ouvre un groupe de conditions

        $query = $this->db->get();

        return $query->num_rows();
    }
	
	public function get_total_enattentecel($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $id);
        $this->db->where('Etat', 'En attente de C.E.L');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getDemande($IdDossier, $circons)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $circons);
        $this->db->where('id_dossier', $IdDossier);
        return $this->db->get()->result_array();
    }
    public function get_total_nouveldemande($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $id);
        $this->db->where('Etat', 'Nouvelle Demande');
        $query = $this->db->get();
        return $query->num_rows();
    }
	public function get_total_suivie($id)
    {
        $this->db->select('*');
        $this->db->from('dossier');
        $this->db->where('id_circonscription', $id);
        $this->db->group_start();  // Ouvre un groupe de conditions
		$this->db->where('Etat', 'Nouvelle Demande');
		$this->db->or_where('Etat', 'En attente de C.E.L');  // Ajoute la condition "OR"
		$this->db->group_end();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_all_dossiers()
    {
        return $this->db->get('dossier')->result_array();
    }
    public function get_all_dossier_guichet($id)
    {
        // Récupère uniquement les dossiers avec l'état "Nouvelle Demande" depuis la base de données
        $this->db->where('id_circonscription', $id);
        $this->db->where('Etat', 'Nouvelle Demande');
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossier_guichet_suivie($id)
    {
        // Récupère uniquement les dossiers avec l'état "Nouvelle Demande" depuis la base de données
        $this->db->where('id_circonscription', $id);
		$this->db->group_start();  // Ouvre un groupe de conditions
		$this->db->where('Etat', 'Nouvelle Demande');
		$this->db->or_where('Etat', 'En attente de C.E.L');  // Ajoute la condition "OR"
		$this->db->group_end();  
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossier_en_attente($id)
    {
        // Récupère uniquement les dossiers avec l'état "En attente de C.E.L" depuis la base de données
        $this->db->where('id_circonscription', $id);
        $this->db->where('Etat', 'En attente de C.E.L');
        return $this->db->get('dossier')->result_array();
    }
    public function get_all_dossiers_ccdf($id)
    {
		$this->db->select('*');
        $this->db->where('id_circonscription', $id);
        $this->db->where('Etat', 'Pour Avis CCDF');
        return $this->db->get('dossier')->result();
    }
	public function get_all_dossiers_SRD($id)
    {
		$this->db->select('*');
        $this->db->where('id_region', $id);
        $this->db->where('Etat', 'A-CCDF-SRD');
        return $this->db->get('dossier')->result();
    }
    public function get_all_dossiers_Envoi_Ccdf($iddossier)
    {
        $this->db->where('id_circonscription', $iddossier);
		$this->db->group_start();
        $this->db->where('Etat', 'A-CCDF-SDC');
        $this->db->or_where('Etat', 'A-CCDF-SRD');	
		$this->db->group_end();  
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossiers_Envoi_SRD($iddossier)
    {
        $this->db->where('id_region', $iddossier);
		$this->db->group_start();
        $this->db->where('Etat', 'A-SRD-SDC');
        $this->db->or_where('Etat', 'A-SRD-CCDF');	
		$this->db->group_end();  
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossiers_Recu_Ccdf($iddossier)
    {
        $this->db->where('id_circonscription', $iddossier);
		$this->db->group_start();
        $this->db->where('Etat', 'A-SDC-CCDF');
        $this->db->or_where('Etat', 'A-SRD-CCDF');	
		$this->db->group_end();
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossiers_Recu_SRD($idregis)
    {
        $this->db->where('id_region', $idregis);
        $this->db->where('Etat', 'A-SDC-SRD');
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossiers_Suivie_Ccdf($iddossier)
    {
        $this->db->where('id_circonscription', $iddossier);
		$this->db->group_start();
        $this->db->where('Etat', 'Pour Avis CCDF');
        $this->db->or_where('Etat', 'A-SDC-CCDF');
        $this->db->or_where('Etat', 'A-SRD-CCDF');	
		$this->db->or_where('Etat', 'A-CCDF-SDC');
        $this->db->or_where('Etat', 'A-CCDF-SRD');
		$this->db->group_end();
        return $this->db->get('dossier')->result_array();
    }
	public function get_all_dossiers_Suivie_SRD($idreg)
    {
        $this->db->where('id_region', $idreg);
		$this->db->group_start();
        $this->db->where('Etat', 'A-CCDF-SRD');
        $this->db->or_where('Etat', 'A-SRD-CCDF');
		$this->db->or_where('Etat', 'A-SRD-SDC');
		$this->db->or_where('Etat', 'A-SDC-SRD');
        $this->db->or_where('Etat', '');
		$this->db->group_end();
        return $this->db->get('dossier')->result_array();
    }
    public function get_all_dossiers_supp()
    {
        // Récupère uniquement les dossiers avec l'état "Supprimer" depuis la base de données pour le ccdf
        $this->db->where('Etat', 'Supprimer');
        return $this->db->get('dossier')->result_array();
    }
    public function create_dossier($data)
    {
        $this->db->insert('dossier', $data);
        return $this->db->insert_id();
    }
    public function cel($id_dossier)
    {
        $this->db->set('Etat', 'Pour Avis CCDF');
        $this->db->where('id_dossier', $id_dossier);
        $this->db->update('dossier');
    }
    // fonction permettant de recuperer que le(s) demandeur d'un dossier
    public function getDemandeursByDossierId($dossierid)
    {
        try {
            $this->db->select('*');
            $this->db->from('demandeur');
            $this->db->join('demandeur_dossier', 'demandeur.id_demandeur = demandeur_dossier.id_demandeur');
            $this->db->where('demandeur_dossier.id_dossier', $dossierid);

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result_array(); // Retourne un tableau de demandeurs
            } else {
                return []; // Aucun demandeur trouvé
            }
        } catch (Exception $e) {
            throw $e; // Propage l'erreur
        }
    }
    //fonction permettant de recuperer le terrain associe au dossier
    public function getTerrainByDossierId($dossierId)
    {
        try {
            $this->db->select('terrain.*');
            $this->db->from('terrain');
            $this->db->join('dossier', 'dossier.id_terrain = terrain.id_terrain');
            $this->db->where('dossier.id_dossier', $dossierId); // Condition pour associer le dossier

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_array(); // Retourne un tableau associatif pour le terrain
            } else {
                return null; // Aucun terrain trouvé
            }
        } catch (Exception $e) {
            throw $e; // Propage l'erreur
        }
    }

    public function getDetailsById($dossierid)
    {
        try {
            // On récupère les informations du dossier
            $this->db->select('dossier.*, terrain.*, demandeur.*');
            $this->db->from('dossier');
            $this->db->join('demandeur_dossier', 'dossier.id_dossier = demandeur_dossier.id_dossier');
            $this->db->join('demandeur', 'demandeur_dossier.demandeur_id = demandeur.demandeur_id');
            $this->db->join('terrain', 'dossier.id_terrain = terrain.id_terrain');
            $this->db->where('dossier.id_dossier', $dossierid);

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $results = $query->result_array();
                $data = [];

                // Extraire le terrain et les demandeurs
                $data['terrain'] = [];
                $data['demandeurs'] = [];

                foreach ($results as $row) {
                    // Ajoutez le terrain (il est supposé identique pour chaque ligne)
                    if (empty($data['terrain'])) {
                        $data['terrain'] = [
                            'id_terrain' => $row['id_terrain'],
                            'superficie' => $row['superficie'],
                            'num_titre' => $row['num_titre'],
                            'num_parcelle' => $row['num_parcelle'],
                            'section' => $row['section'],
                            'type_terrain' => $row['type_terrain'],
                        ];
                    }

                    // Ajoutez le demandeur
                    $data['demandeurs'][] = [
                        'id_demandeur' => $row['demandeur_id'],
                        'nom_demandeur' => $row['nom_demandeur'],
                        'prenom_demandeur' => $row['prenom_demandeur'],
                        'cin_demandeur' => $row['cin_demandeur'],
                        'telephone' => $row['telephone'],
                        'type_demandeur' => $row['type_demandeur'],
                    ];
                }

                return $data;
            } else {
                throw new Exception('Aucun dossier trouvé pour cet id.');
            }
        } catch (Exception $e) {
            // Propagez l'erreur
            throw $e;
        }
    }

    public function getPdfByDossierId($dossierId)
    {
        try {
            $dossierId = (int)$dossierId;
            // Use a query builder method to add the WHERE clause
            try {
                $this->db->select('*');
                $this->db->from('piecejointe');
                $this->db->where('id_dossier', $dossierId);

                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    return $query->result_array(); // Retourne un tableau de demandeurs
                } else {
                    return []; // Aucun demandeur trouvé
                }
            } catch (Exception $e) {
                throw $e; // Propage l'erreur
            }
        } catch (\Throwable $th) {
            // Propagez l'erreur
            throw $e;
        }
    }
    public function get_dossier_by_id($id_dossier)
    {
        return $this->db->where('id_dossier', $id_dossier)->get('dossier')->row_array();
    }
}
