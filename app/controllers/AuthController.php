<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
    }

    public function login()
    {
        if ($this->session->userdata('authenticated')) {
            redirect('/products');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identity = trim((string)($_POST['identity'] ?? ''));
            $password = (string)($_POST['password'] ?? '');
            $user = $this->UsersModel->find_by('username', $identity);

            if (!$user) {
                $user = $this->UsersModel->find_by('email', $identity);
            }

            if ($user && !empty($user['password']) && password_verify($password, $user['password'])) {
                $this->session->regenerate_on_login(true);
                $this->session->set_userdata([
                    'authenticated' => true,
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'] ?? 'user',
                ]);
                redirect('/products');
            }

            $error = 'The username or password is incorrect.';
        }

        $this->call->view('login_view', ['error' => $error]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }
}