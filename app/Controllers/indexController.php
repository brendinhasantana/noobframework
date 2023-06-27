<?php
namespace App\Controllers;

use Core\Controller;

class indexController extends Controller {
    
    public function index() {
        $this->view('login');
    }

    public function cadastrar()
    {
        $this->view('cadastrar');
    }
}