<?php
namespace App\Controllers;

use Core\Controller;

class sessionController extends Controller {
    
    public function index() {
        $this->view('home');
    }
}