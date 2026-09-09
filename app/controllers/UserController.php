<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        $this->call->helper('url');
    }

    public function before_action()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect('/login');
        }
        if ($this->session->userdata('role') !== 'admin') {
            redirect('/products');
        }
    }

    public function create()
    {
        $user = [
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'username' => '',
            'role' => 'user',
        ];
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = [
                'firstname' => trim((string)($_POST['firstname'] ?? '')),
                'lastname' => trim((string)($_POST['lastname'] ?? '')),
                'email' => trim((string)($_POST['email'] ?? '')),
                'username' => trim((string)($_POST['username'] ?? '')),
                'role' => ($_POST['role'] ?? 'user') === 'admin' ? 'admin' : 'user',
            ];
            $password = (string)($_POST['password'] ?? '');

            if ($user['firstname'] === '' || $user['lastname'] === '' ||
                !filter_var($user['email'], FILTER_VALIDATE_EMAIL) ||
                $user['username'] === '' || strlen($password) < 8) {
                $error = 'Enter all details and a password with at least 8 characters.';
            } elseif ($this->UsersModel->find_by('username', $user['username']) ||
                $this->UsersModel->find_by('email', $user['email'])) {
                $error = 'That username or email is already in use.';
            } else {
                $user['password'] = password_hash($password, PASSWORD_DEFAULT);
                $this->UsersModel->insert($user);
                redirect('/products');
            }
        }

        $this->call->view('users/form', [
            'user' => $user,
            'error' => $error,
        ]);
    }
}
