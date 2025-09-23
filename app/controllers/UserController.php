<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
    }

    // Function for show.php
    public function show(){

        // Get current page (default 1)
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        // Get search query
        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10; // number of users per page

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

        $this->pagination->set_theme('lei-custom'); // custom pagination theme - scheme/libraries/Pagination.php
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('users/show').'?q='.$q);

        // Send data to view
        $data['page'] = $this->pagination->paginate();
        $this->call->view('show', $data);
    }
    //

    // Function Create
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
            $this->call->view('create');
        }
    }
    //
    
    // Function Update
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
            $this->call->view('update', $data);
        }
    }
    //

    // Function Delete
    public function delete($id){
        if($this->UserModel->delete($id)){
            redirect('users/show');
        } else {
            echo 'Something went wrong';
        }
    }
    //
}