<?php
require_once APPPATH . 'libraries\dompdf\autoload.inc.php';

use Dompdf\Dompdf;

class Dompdf_lib {
    public $dompdf;
    public function __construct() {
        $this->dompdf = new Dompdf();
    }
}

