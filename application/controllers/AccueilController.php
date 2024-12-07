<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccueilController extends CI_Controller {

    public function index()
    {
        // Vérifiez si une session est active
        if ($this->session->userdata('logged_in')) {
            // Redirigez vers l'accueil
            redirect('Main/data1');
        } else {
            // Redirigez vers la page de connexion
            redirect('Main/login');
        }
    }
}
