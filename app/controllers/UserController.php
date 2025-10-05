<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
        $this->call->library('Session');
    }

    // Function show
    public function show(){
        // Get current page (default 1)
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        // Get search query (optional)
        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 13; // number of users per page

        // Call model's pagination method
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Pagination Links
        $this->pagination->set_options([
            'first_link' => '<span class="w-10 h-10 flex items-center justify-center text-white font-bold text-xl">⏮</span>',
            'last_link'  => '<span class="w-10 h-10 flex items-center justify-center text-white font-bold text-xl">⏭</span>',
            'next_link'  => '<span class="w-10 h-10 flex items-center justify-center text-white font-bold text-xl">→</span>',
            'prev_link'  => '<span class="w-10 h-10 flex items-center justify-center text-white font-bold text-xl">←</span>',
            'page_delimiter' => '&page='
        ]);
        
        $this->pagination->set_theme('lei-custom'); // themes: bootstrap, tailwind, custom
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('users/show').'?q='.$q);

        // Send data to view
        $data['page'] = $this->pagination->paginate();
        $data['current_role'] = $this->session->userdata('role') ?? 'user';
        $this->call->view('students/show', $data);
    }
    //

    // Function create
    public function create() {
        if($this->io->method() == 'post'){
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );
            if($this->UserModel->insert($data)){
                redirect('users/show');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('students/create');
        }
    }
    //
    
    // Function update
    public function update($id) {
        $data['user'] = $this->UserModel->find($id);
        if($this->io->method() == 'post'){
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $status = $this->io->post('status');
            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email,
                'status' => $status
            );
            if($this->UserModel->update($id, $data)){
                redirect('users/show');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('students/update', $data);
        }
    }
    //

    // Function delete
    public function delete($id){
        if($this->UserModel->delete($id)){
            redirect('users/show');
        } else {
            echo 'Something went wrong';
        }
    }
    //

    // Function login
    public function login() {
        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            $user = $this->UserModel->login($username, $password);
            if ($user) {
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('username', $user['username']);
                $this->session->set_userdata('role', $user['role']);
                redirect('users/show');
            } else {
                $data['error'] = 'Invalid username or password';
                $this->call->view('user_auth/login', $data);
            }
        } else {
            $this->call->view('user_auth/login');
        }
    }
    //

    // Function register
    public function register() {
        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $role = $this->io->post('role') ?? 'user';

            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];

            if ($this->UserModel->register($data)) {
                redirect('login');
            } else {
                $data['error'] = 'Registration failed. Please try again.';
                $this->call->view('user_auth/register', $data);
            }
        } else {
            $this->call->view('user_auth/register');
        }
    }
    //
    
    // Function logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
    //
}
