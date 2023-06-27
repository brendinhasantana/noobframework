<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Nota;
use App\Models\User;
use Core\Request;
use Exception;

class sessionController extends Controller
{

    public function index(Request $request)
    {

        $user = new User();

        $targetUser = $user->find(conditions: ["email" => $request->post('email'), "pwd" => $request->post('password')]);
        $notas = new Nota();


        if (!isset($targetUser[0])) {
            echo "Email ou senha errados!";
            $this->view('login');
        } else {
            $notasUser = $notas->find(conditions: ["user_id" => $targetUser[0]['id']]);
            $this->view('home', ['user' => $targetUser[0], 'notas' => $notasUser]);
        }
    }

    public function gravarNota(Request $request)
    {
        $nota = new Nota();
        $nota->gravar(['text' => $request->post('text'), 'user_id' => $request->post('user_id')]);

        $notasUser = $nota->find(conditions: ["user_id" => $request->post('user_id')]);
        $user = new User();
        $targetUser = $user->find(conditions: ["id" => $request->post('user_id')]);

        $this->view('home', ['user' => $targetUser[0], 'notas' => $notasUser]);
    }

    public function gravarUser(Request $request)
    {
        $user = new User();
        $user->gravar(['name' => $request->post('name'), 'email' => $request->post('email'), 'pwd' => $request->post('password')]);

        $this->redirect('/');
    }
}